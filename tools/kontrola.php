<?php
/**
 * Kontrola sestaveného webu ve složce public/ – spouští se po `php build.php`, před nasazením.
 *
 *   php tools/kontrola.php
 *
 * Hlídá: párování značek, duplicitní id, právě jeden <h1>, alt a rozměry obrázků, prázdné odkazy a nadpisy,
 * atribut lang, titulek a popis, canonical a hreflang (musí vést na existující stránky), vnitřní odkazy včetně
 * kotev, úplnost sitemap.xml, shodné klíče v src/texty/*.php a českou diakritiku v jiných jazykových verzích,
 * obrázek pro sdílení (og:image, og:locale, twitter:card) a stránky 404 všech jazyků (noindex, bez canonical).
 * Končí kódem 1, když něco najde. Čisté PHP bez závislostí, stejně jako generátor.
 */

declare(strict_types=1);

const KOREN = __DIR__ . '/..';
const VEREJNE = KOREN . '/public';
// česká slova, která do cizojazyčného textu patří (citace hlášek systému apod.)
const POVOLENA_CESKA_SLOVA = ['právě'];

$web = require KOREN . '/src/web.php';
$jazyky = array_keys($web['jazyky']);
$nalezy = [];
$nalez = static function (string $kde, string $co) use (&$nalezy): void {
    $nalezy[] = "$kde: $co";
};

if (!is_dir(VEREJNE)) {
    fwrite(STDERR, "Složka public/ neexistuje – nejdřív spusťte php build.php.\n");
    exit(1);
}

// --- texty rozhraní: všechny jazyky musí mít stejné klíče
$klice = static function (array $pole, string $predpona = '') use (&$klice): array {
    $vysledek = [];
    foreach ($pole as $k => $v) {
        $vysledek[] = $predpona . $k;
        if (is_array($v)) {
            $vysledek = array_merge($vysledek, $klice($v, "$predpona$k."));
        }
    }

    return $vysledek;
};
$zdroj = $klice(require KOREN . '/src/texty/cs.php');
foreach (array_diff($jazyky, ['cs']) as $j) {
    $jine = $klice(require KOREN . "/src/texty/$j.php");
    foreach (array_diff($zdroj, $jine) as $k) {
        $nalez("src/texty/$j.php", "chybí klíč $k");
    }
    foreach (array_diff($jine, $zdroj) as $k) {
        $nalez("src/texty/$j.php", "klíč navíc $k");
    }
}

// --- soubory webu
$soubory = [];
$stranky = [];
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(VEREJNE, FilesystemIterator::SKIP_DOTS)) as $soubor) {
    $cesta = substr((string) $soubor, strlen(VEREJNE));
    $soubory[$cesta] = true;
    // kořenový index.html je jen přesměrování bez kostry stránky
    if (str_ends_with($cesta, '.html') && $cesta !== '/index.html') {
        $stranky[] = $cesta;
    }
}
sort($stranky);
// stránky 404: kořenová (výchozí jazyk) a jedna pro každý jazyk – vybírá je static/.htaccess
$stranky404 = ['/404.html', ...array_map(static fn (string $j): string => "/$j/404.html", $jazyky)];
foreach (array_diff($stranky404, $stranky) as $chybi) {
    $nalez($chybi, 'chybí stránka 404');
}
$htaccess = is_file(VEREJNE . '/.htaccess') ? (string) file_get_contents(VEREJNE . '/.htaccess') : '';
if (!str_contains($htaccess, 'ErrorDocument 404 /404.html')) {
    $nalez('.htaccess', 'chybí ErrorDocument 404 /404.html');
}
foreach ($jazyky as $j) {
    if (!str_contains($htaccess, "RewriteRule ^404\\.html$ /$j/404.html [L]")) {
        $nalez('.htaccess', "chybí výběr stránky 404 pro /$j/");
    }
}
$existuje = static function (string $adresa) use ($soubory): bool {
    $adresa = rawurldecode($adresa);

    return isset($soubory[str_ends_with($adresa, '/') ? $adresa . 'index.html' : $adresa]);
};

$neparove = ['meta', 'link', 'img', 'br', 'hr', 'input', 'source'];
$idNaStrance = [];
$html = [];
foreach ($stranky as $s) {
    $html[$s] = $h = (string) file_get_contents(VEREJNE . $s);
    $je404 = in_array($s, $stranky404, true);

    // párování značek (bez obsahu <pre>, <script>, <style> a vloženého SVG)
    $kostra = (string) preg_replace('#<(script|style|pre|svg)\b[^>]*>.*?</\1>#s', '', $h);
    preg_match_all('#<(/?)([a-zA-Z][a-zA-Z0-9]*)\b[^>]*>#', $kostra, $znacky, PREG_SET_ORDER);
    $otevrene = [];
    foreach ($znacky as [, $konec, $nazev]) {
        $nazev = strtolower($nazev);
        if (in_array($nazev, $neparove, true)) {
            continue;
        }
        if ($konec === '') {
            $otevrene[] = $nazev;
        } elseif (($posledni = array_pop($otevrene)) !== $nazev) {
            $nalez($s, "nesedí značky: čekal jsem </$posledni>, je tu </$nazev>");
            $otevrene = [];
            break;
        }
    }
    if ($otevrene !== []) {
        $nalez($s, 'neuzavřené značky: ' . implode(', ', $otevrene));
    }

    preg_match_all('#\sid="([^"]*)"#', $h, $m);
    $idNaStrance[$s] = array_count_values($m[1]);
    foreach ($idNaStrance[$s] as $id => $kolikrat) {
        if ($kolikrat > 1) {
            $nalez($s, "id \"$id\" je na stránce {$kolikrat}×");
        }
    }
    if (($pocet = preg_match_all('#<h1\b#', $h)) !== 1) {
        $nalez($s, "počet <h1>: $pocet");
    }
    preg_match_all('#<img\b[^>]*>#', $h, $m);
    foreach ($m[0] as $img) {
        if (!preg_match('#\salt="[^"]+"#', $img)) {
            $nalez($s, "obrázek bez alt: $img");
        }
        if (!preg_match('#\swidth="\d+"#', $img) || !preg_match('#\sheight="\d+"#', $img)) {
            $nalez($s, "obrázek bez rozměrů: $img");
        }
    }
    if (preg_match('#<a\b[^>]*>\s*</a>|<h[1-6]\b[^>]*>\s*</h[1-6]>#', $h, $m)) {
        $nalez($s, "prázdný prvek: $m[0]");
    }

    $ocekavany = preg_match('#^/([a-z]{2})/#', $s, $m) ? $m[1] : $web['vychozi_jazyk'];
    if (!preg_match('#<html lang="' . $ocekavany . '"#', $h)) {
        $nalez($s, "atribut lang není \"$ocekavany\"");
    }
    if (!preg_match('#<title>[^<]+</title>#', $h)) {
        $nalez($s, 'chybí <title>');
    }
    // obrázek pro sdílení: absolutní adresa existujícího souboru, rozměry podle skutečnosti
    if (!preg_match('#<meta property="og:image" content="([^"]+)"#', $h, $m)) {
        $nalez($s, 'chybí og:image');
    } elseif (!str_starts_with($m[1], $web['adresa'] . '/') || !$existuje(substr($m[1], strlen($web['adresa'])))) {
        $nalez($s, "og:image nevede na existující soubor webu: $m[1]");
    } else {
        $rozmery = getimagesize(VEREJNE . substr($m[1], strlen($web['adresa'])));
        if ($rozmery === false || !str_contains($h, '<meta property="og:image:width" content="' . $rozmery[0] . '">') || !str_contains($h, '<meta property="og:image:height" content="' . $rozmery[1] . '">')) {
            $nalez($s, 'og:image:width / og:image:height neodpovídají obrázku');
        }
    }
    foreach (['<meta property="og:image:alt" content="' => 'og:image:alt', '<meta property="og:locale" content="' . ($web['og_locale'][$ocekavany] ?? '?') . '"' => 'og:locale', '<meta name="twitter:card" content="summary_large_image"' => 'twitter:card'] as $hledam => $co) {
        if (!str_contains($h, $hledam)) {
            $nalez($s, "chybí nebo nesedí $co");
        }
    }
    if ($je404) {
        if (!preg_match('#<meta name="robots" content="noindex"#', $h)) {
            $nalez($s, 'stránka 404 není noindex');
        }
        if (preg_match('#<link rel="(canonical|alternate)"|<meta property="og:url"#', $h)) {
            $nalez($s, 'stránka 404 nemá mít canonical, hreflang ani og:url');
        }
        foreach ($jazyky as $j) {
            if (!preg_match('#<a href="/' . $j . '/" lang="' . $j . '"#', $h)) {
                $nalez($s, "stránka 404 nevede na úvod /$j/");
            }
        }
        continue;
    }
    if (!preg_match('#<meta name="description" content="[^"]{20,}"#', $h)) {
        $nalez($s, 'chybí nebo je příliš krátký meta description');
    }
    if (!preg_match('#<link rel="canonical" href="([^"]+)"#', $h, $m)) {
        $nalez($s, 'chybí canonical');
    } elseif ($m[1] !== $web['adresa'] . substr($s, 0, -strlen('index.html'))) {
        $nalez($s, "canonical nevede na tuto stránku: $m[1]");
    }
    preg_match_all('#<link rel="alternate" hreflang="([^"]+)" href="([^"]+)"#', $h, $m, PREG_SET_ORDER);
    foreach (array_diff([...$jazyky, 'x-default'], array_column($m, 1)) as $chybi) {
        $nalez($s, "chybí hreflang $chybi");
    }
    foreach ($m as [, $kod, $adresa]) {
        if (!$existuje(substr($adresa, strlen($web['adresa'])))) {
            $nalez($s, "hreflang $kod vede na neexistující $adresa");
        }
    }
}

// --- vnitřní odkazy a kotvy
$odkazu = 0;
$rozbitych = 0;
foreach ($html as $s => $h) {
    preg_match_all('#\s(?:href|src)="([^"]+)"#', $h, $m);
    foreach ($m[1] as $adresa) {
        $adresa = html_entity_decode($adresa, ENT_QUOTES);
        if (preg_match('#^(https?:|mailto:|data:)#', $adresa)) {
            continue;
        }
        $odkazu++;
        [$cesta, $kotva] = array_pad(explode('#', $adresa, 2), 2, '');
        $cesta = (string) preg_replace('#\?.*$#', '', $cesta);
        if ($cesta !== '' && $cesta[0] !== '/') {
            $nalez($s, "relativní odkaz $adresa (web používá adresy od kořene)");
            $rozbitych++;
            continue;
        }
        $cil = $cesta === '' ? $s : rawurldecode(str_ends_with($cesta, '/') ? $cesta . 'index.html' : $cesta);
        if (!isset($soubory[$cil])) {
            $nalez($s, "rozbitý odkaz $adresa");
            $rozbitych++;
        } elseif ($kotva !== '' && isset($idNaStrance[$cil]) && !isset($idNaStrance[$cil][$kotva])) {
            $nalez($s, "rozbitá kotva $adresa");
            $rozbitych++;
        }
    }
}

// --- sitemap.xml: každá stránka právě jednou, nic navíc
preg_match_all('#<loc>([^<]+)</loc>#', (string) file_get_contents(VEREJNE . '/sitemap.xml'), $m);
$vMape = array_map(static fn (string $loc): string => substr($loc, strlen($web['adresa'])), $m[1]);
foreach ($vMape as $adresa) {
    if (!$existuje($adresa)) {
        $nalez('sitemap.xml', "neexistující adresa $adresa");
    }
}
foreach ($stranky as $s) {
    if (!in_array($s, $stranky404, true) && !in_array(substr($s, 0, -strlen('index.html')), $vMape, true)) {
        $nalez('sitemap.xml', "chybí $s");
    }
}
if (count($vMape) !== count(array_unique($vMape))) {
    $nalez('sitemap.xml', 'některá adresa je tu víckrát');
}
if (!str_contains((string) file_get_contents(VEREJNE . '/robots.txt'), "Sitemap: {$web['adresa']}/sitemap.xml")) {
    $nalez('robots.txt', 'chybí odkaz na sitemap.xml');
}

// --- čeština v jiných jazykových verzích (písmena, která angličtina ani němčina nemají)
foreach ($html as $s => $h) {
    if (!preg_match('#^/([a-z]{2})/#', $s, $m) || $m[1] === 'cs') {
        continue;
    }
    $h = (string) preg_replace('#<a\b[^>]*\slang="cs"[^>]*>.*?</a>|<(script|style)\b.*?</\1>#s', '', $h); // přepínač jazyků
    preg_match_all('#\s(?:alt|title|content|aria-label|placeholder)="([^"]*)"#', $h, $atributy);
    $text = html_entity_decode(strip_tags($h) . ' ' . implode(' ', $atributy[1]));
    if (preg_match_all('#[^\s„“"()]*[řěůťďňŘĚŮŤĎŇ][^\s„“"()]*#u', $text, $slova)) {
        $ceska = array_diff(array_unique($slova[0]), POVOLENA_CESKA_SLOVA);
        if ($ceska !== []) {
            $nalez($s, 'česká slova: ' . implode(', ', $ceska));
        }
    }
}

echo $nalezy === [] ? '' : implode("\n", $nalezy) . "\n";
echo count($stranky) . " stránek, $odkazu vnitřních odkazů, rozbitých $rozbitych, nálezů " . count($nalezy) . "\n";
exit($nalezy === [] ? 0 : 1);
