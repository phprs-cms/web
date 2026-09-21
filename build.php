<?php
/**
 * Generátor webu phprs.eu.
 *
 * Čisté PHP bez závislostí – stejně jako phpRS. Ze zdrojů ve složce src/ a z příručky v repozitáři CMS
 * (docs/prirucka) složí statický web do složky public/.
 *
 *   php build.php                  sestaví web
 *   PHPRS_CMS=/cesta php build.php použije jiné umístění repozitáře CMS (výchozí ../phprs3)
 */

declare(strict_types=1);

require __DIR__ . '/src/Markdown.php';

const KOREN = __DIR__;
const VYSTUP = KOREN . '/public';
// BEZ_SNIMKU=1: sestavení bez pracovních snímků obrazovek (dokud nejsou finální, na veřejný web nepatří)
define('BEZ_SNIMKU', getenv('BEZ_SNIMKU') === '1');

$cms = rtrim(getenv('PHPRS_CMS') ?: KOREN . '/../phprs3', '/');
$web = require KOREN . '/src/web.php';
if (is_file($cms . '/system/bootstrap.php') && preg_match("/const PHPRS_VERSION = '([^']+)'/", (string) file_get_contents($cms . '/system/bootstrap.php'), $m)) {
    $web['verze'] = $m[1];
}

function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Zapíše soubor do public/ a založí potřebné složky. */
function zapis(string $cesta, string $obsah): void
{
    $soubor = VYSTUP . '/' . ltrim($cesta, '/');
    if (!is_dir(dirname($soubor))) {
        mkdir(dirname($soubor), 0775, true);
    }
    file_put_contents($soubor, $obsah);
}

function kopiruj(string $odkud, string $kam): void
{
    if (is_dir($odkud)) {
        foreach (array_diff((array) scandir($odkud), ['.', '..', '.DS_Store']) as $polozka) {
            kopiruj("$odkud/$polozka", "$kam/$polozka");
        }

        return;
    }
    if (!is_dir(dirname($kam))) {
        mkdir(dirname($kam), 0775, true);
    }
    copy($odkud, $kam);
}

function smaz(string $cesta): void
{
    if (is_dir($cesta) && !is_link($cesta)) {
        foreach (array_diff((array) scandir($cesta), ['.', '..']) as $polozka) {
            smaz("$cesta/$polozka");
        }
        rmdir($cesta);
    } elseif (file_exists($cesta)) {
        unlink($cesta);
    }
}

/** Vykreslí šablonu ze src/sablony/ s proměnnými. */
function sablona(string $nazev, array $data): string
{
    extract($data, EXTR_SKIP);
    ob_start();
    require KOREN . "/src/sablony/$nazev.php";

    return (string) ob_get_clean();
}

/** Obrázek ze složky assets/img s rozměry (kvůli poskakování stránky); chybějící soubor sestavení nezastaví. */
function obrazek(string $soubor, string $alt, string $trida = '', bool $lazy = true): string
{
    $cesta = KOREN . '/assets/img/' . $soubor;
    if (BEZ_SNIMKU && str_starts_with($soubor, 'snimky/')) {
        return '';
    }
    if (!is_file($cesta)) {
        fwrite(STDERR, "Chybí obrázek assets/img/$soubor\n");

        return '';
    }
    [$sirka, $vyska] = (array) getimagesize($cesta);

    return '<img src="/assets/img/' . e($soubor) . '" alt="' . e($alt) . '" width="' . (int) $sirka . '" height="' . (int) $vyska . '"'
        . ($trida !== '' ? ' class="' . e($trida) . '"' : '') . ($lazy ? ' loading="lazy" decoding="async"' : ' fetchpriority="high"') . '>';
}

/** Logo vložené přímo do stránky, aby jeho barvy řídily proměnné CSS (světlý a tmavý režim). */
function logo(string $cms): string
{
    $svg = (string) file_get_contents(is_file("$cms/image/phprs-logo.svg") ? "$cms/image/phprs-logo.svg" : KOREN . '/assets/img/phprs-logo.svg');
    $svg = str_replace('fill="#0f1424"', 'fill="var(--logo-php)"', $svg);
    $posledni = strrpos($svg, 'fill="#2b5be3"');

    return $posledni === false ? $svg : substr_replace($svg, 'fill="var(--logo-rs)"', $posledni, strlen('fill="#2b5be3"'));
}

// ---------------------------------------------------------------------------------------------------------------------

// obsah public/ se maže, složka zůstává - běžící náhledový server by jinak přišel o svůj kořen
if (!is_dir(VYSTUP)) {
    mkdir(VYSTUP, 0775, true);
}
foreach (array_diff((array) scandir(VYSTUP), ['.', '..']) as $polozka) {
    smaz(VYSTUP . '/' . $polozka);
}
kopiruj(KOREN . '/assets', VYSTUP . '/assets');
if (BEZ_SNIMKU) {
    smaz(VYSTUP . '/assets/img/snimky');
}
kopiruj(KOREN . '/static', VYSTUP);
if (!is_dir(VYSTUP . '/assets/img')) {
    mkdir(VYSTUP . '/assets/img', 0775, true);
}
foreach (['phprs-znacka.svg', 'phprs-znacka-32.png', 'phprs-znacka-180.png', 'phprs-logo.svg', 'phprs-logo-tmavy.svg'] as $obrazek) {
    if (is_file("$cms/image/$obrazek")) {
        copy("$cms/image/$obrazek", VYSTUP . "/assets/img/$obrazek");
    }
}

$otisk = substr(md5((string) file_get_contents(KOREN . '/assets/web.css') . file_get_contents(KOREN . '/assets/web.js')), 0, 8);
$logo = logo($cms);
$osnova = json_decode((string) file_get_contents("$cms/docs/prirucka/osnova.json"), true, 16, JSON_THROW_ON_ERROR);
$mapa = [];
$pocet = 0;

// texty všech jazyků předem - přepínač jazyků potřebuje znát adresu téže stránky v ostatních jazycích
$texty = [];
foreach (array_keys($web['jazyky']) as $jazyk) {
    $texty[$jazyk] = require KOREN . "/src/texty/$jazyk.php";
}

/** Adresa produktové stránky v daném jazyce ('' = úvod). */
$adresaStranky = static function (string $jazyk, string $adresa) use ($texty): string {
    return "/$jazyk/" . ($adresa === '' ? '' : ($texty[$jazyk]['adresy'][$adresa] ?? $adresa) . '/');
};
/** Adresa stránky příručky: části cesty se překládají podle osnova.json ("adresy"), soubory se jmenují ve všech jazycích stejně. */
$adresaPrirucky = static function (string $jazyk, string $cesta) use ($texty, $osnova): string {
    $zaklad = "/$jazyk/" . $texty[$jazyk]['adresa_dokumentace'] . '/';
    if ($cesta === 'index') {
        return $zaklad;
    }
    $preklad = $osnova['adresy'][$jazyk] ?? [];

    return $zaklad . implode('/', array_map(static fn (string $c): string => $preklad[$c] ?? $c, explode('/', $cesta))) . '/';
};

foreach ($web['jazyky'] as $jazyk => $nazevJazyka) {
    $t = $texty[$jazyk];
    $spolecne = ['web' => $web, 't' => $t, 'jazyk' => $jazyk, 'otisk' => $otisk, 'logo' => $logo];

    // produktové stránky: src/stranky/<jazyk>/<adresa>.php, index.php = úvod
    foreach ($web['stranky'] as $adresa) {
        $soubor = KOREN . "/src/stranky/$jazyk/" . ($adresa === '' ? 'index' : $adresa) . '.php';
        if (!is_file($soubor)) {
            continue;
        }
        $stranka = ['titulek' => '', 'popis' => '', 'trida' => ''];
        ob_start();
        (static function () use ($soubor, &$stranka, $web, $t, $jazyk): void {
            require $soubor;
        })();
        $obsah = (string) ob_get_clean();
        $url = $adresaStranky($jazyk, $adresa);
        $jinde = [];
        foreach (array_keys($web['jazyky']) as $j) {
            if (is_file(KOREN . "/src/stranky/$j/" . ($adresa === '' ? 'index' : $adresa) . '.php')) {
                $jinde[$j] = $adresaStranky($j, $adresa);
            }
        }
        zapis($url . 'index.html', sablona('stranka', $spolecne + ['stranka' => $stranka, 'obsah' => $obsah, 'url' => $url, 'adresa' => $adresa, 'jinde' => $jinde]));
        $mapa[] = $url;
        $pocet++;
    }

    // příručka z repozitáře CMS
    $koren = "$cms/docs/prirucka/$jazyk";
    if (!is_dir($koren)) {
        continue;
    }
    $zaklad = $adresaPrirucky($jazyk, 'index');
    $odkaz = static function (string $cil, string $zdroj) use ($jazyk, $adresaPrirucky): string {
        if (preg_match('#^(https?:|mailto:|/|\#)#', $cil)) {
            return $cil;
        }
        [$cesta, $kotva] = array_pad(explode('#', $cil, 2), 2, '');
        $casti = $zdroj === 'index' ? [] : array_slice(explode('/', $zdroj), 0, -1);
        foreach (explode('/', (string) preg_replace('/\.md$/', '', $cesta)) as $cast) {
            if ($cast === '..') {
                array_pop($casti);
            } elseif ($cast !== '.' && $cast !== '') {
                $casti[] = $cast;
            }
        }

        return $adresaPrirucky($jazyk, $casti === [] || $casti === ['index'] ? 'index' : implode('/', $casti)) . ($kotva !== '' ? "#$kotva" : '');
    };

    // nejdřív všechny stránky převést (kvůli titulkům v navigaci), potom vykreslit
    $stranky = [];
    $poradi = ['index'];
    foreach ($osnova['kapitoly'] as $kapitola) {
        $poradi = array_merge($poradi, $kapitola['stranky']);
    }
    foreach ($poradi as $cesta) {
        if (!is_file("$koren/$cesta.md")) {
            fwrite(STDERR, "Příručka ($jazyk): chybí $cesta.md\n");
            continue;
        }
        $md = new Markdown(static fn (string $cil): string => $odkaz($cil, $cesta));
        $html = $md->preved((string) file_get_contents("$koren/$cesta.md"));
        $stranky[$cesta] = ['titulek' => $md->titulek, 'html' => $html, 'nadpisy' => $md->nadpisy, 'url' => $adresaPrirucky($jazyk, $cesta), 'oddily' => $md->oddily];
    }
    $navigace = [];
    foreach ($osnova['kapitoly'] as $kapitola) {
        $polozky = [];
        foreach ($kapitola['stranky'] as $cesta) {
            if (isset($stranky[$cesta])) {
                $polozky[] = ['titulek' => $stranky[$cesta]['titulek'], 'url' => $stranky[$cesta]['url']];
            }
        }
        if ($polozky !== []) {
            $navigace[] = ['nazev' => $kapitola['nazev'][$jazyk] ?? $kapitola['slug'], 'stranky' => $polozky];
        }
    }
    $rada = array_keys($stranky);
    $hledani = [];
    foreach ($rada as $i => $cesta) {
        $s = $stranky[$cesta];
        $doc = sablona('dokumentace', $spolecne + [
            'doc' => $s,
            'navigace' => $navigace,
            'predchozi' => $i > 0 ? $stranky[$rada[$i - 1]] : null,
            'dalsi' => isset($rada[$i + 1]) ? $stranky[$rada[$i + 1]] : null,
            'zaklad' => $zaklad,
        ]);
        $jinde = [];
        foreach (array_keys($web['jazyky']) as $j) {
            if (is_dir("$cms/docs/prirucka/$j")) {
                $jinde[$j] = $adresaPrirucky($j, is_file("$cms/docs/prirucka/$j/$cesta.md") ? $cesta : 'index');
            }
        }
        $stranka = ['titulek' => $s['titulek'] . ' – ' . $t['dokumentace'], 'popis' => mb_substr(trim(strip_tags($s['oddily'][0]['text'] ?? '')), 0, 160), 'trida' => 'je-dokumentace'];
        zapis($s['url'] . 'index.html', sablona('stranka', $spolecne + ['stranka' => $stranka, 'obsah' => $doc, 'url' => $s['url'], 'adresa' => 'dokumentace', 'jinde' => $jinde]));
        $mapa[] = $s['url'];
        $pocet++;
        foreach ($s['oddily'] as $oddil) {
            $hledani[] = ['s' => $s['titulek'], 'n' => $oddil['nadpis'], 'u' => $s['url'] . ($oddil['id'] !== '' ? '#' . $oddil['id'] : ''), 't' => $oddil['text']];
        }
    }
    zapis($zaklad . 'hledani.json', json_encode($hledani, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR));
}

// stránka 404 ve výchozím jazyce
$t = $texty[$web['vychozi_jazyk']];
zapis('404.html', sablona('stranka', ['jinde' => [], 'web' => $web, 't' => $t, 'jazyk' => $web['vychozi_jazyk'], 'otisk' => $otisk, 'logo' => $logo, 'url' => '/404.html', 'adresa' => '404',
    'stranka' => ['titulek' => $t['nenalezeno'], 'popis' => '', 'trida' => ''],
    'obsah' => '<section class="zahlavi"><div class="obal"><h1>' . e($t['nenalezeno']) . '</h1><p class="perex">' . e($t['nenalezeno_text']) . '</p><p class="tlacitka"><a class="tl" href="/' . $web['vychozi_jazyk'] . '/">' . e($t['nenalezeno_domu']) . '</a></p></div></section>']));

// kořen webu: na hostingu rozhoduje .htaccess podle jazyka prohlížeče, tenhle soubor je záloha bez něj
$vychozi = $web['vychozi_jazyk'];
zapis('index.html', '<!doctype html><html lang="' . $vychozi . '"><meta charset="utf-8"><title>phpRS</title><meta http-equiv="refresh" content="0; url=/' . $vychozi . '/"><link rel="canonical" href="' . $web['adresa'] . '/' . $vychozi . '/"><p><a href="/' . $vychozi . '/">phpRS</a></p></html>' . "\n");

$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($mapa as $url) {
    $sitemap .= '<url><loc>' . e($web['adresa'] . $url) . "</loc></url>\n";
}
zapis('sitemap.xml', $sitemap . "</urlset>\n");
zapis('robots.txt', "User-agent: *\nAllow: /\n\nSitemap: {$web['adresa']}/sitemap.xml\n");

echo "Hotovo: $pocet stránek, verze {$web['verze']}, výstup v public/\n";
