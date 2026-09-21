<?php
/**
 * Kostra každé stránky.
 *
 * @var array $web @var array $t @var string $jazyk @var string $otisk @var string $logo
 * @var array{titulek:string,popis:string,trida:string,neindexovat?:bool} $stranka (neindexovat: stránka 404 – bez kanonické adresy) @var string $obsah @var string $url @var string $adresa
 * @var array<string,string> $jinde adresa téže stránky v ostatních jazycích (kód jazyka => adresa); u stránky 404 úvody – plní jen přepínač jazyků, hreflang se u ní nevypisuje
 */
$titulek = $stranka['titulek'] === '' ? 'phpRS' : $stranka['titulek'] . ' – phpRS';
$neindexovat = $stranka['neindexovat'] ?? false;
/** Adresa stránky z nabídky nebo patičky v jazyce této stránky. */
$cil = static fn (string $kam): string => "/$jazyk/" . ($kam === 'dokumentace' ? $t['adresa_dokumentace'] : ($t['adresy'][$kam] ?? $kam)) . '/';
?>
<!doctype html>
<html lang="<?= e($jazyk) ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulek) ?></title>
<?php if ($stranka['popis'] !== ''): ?>
<meta name="description" content="<?= e($stranka['popis']) ?>">
<?php endif ?>
<?php if ($neindexovat): ?>
<meta name="robots" content="noindex">
<?php else: ?>
<link rel="canonical" href="<?= e($web['adresa'] . $url) ?>">
<?php endif ?>
<?php if (!$neindexovat && count($jinde) > 1): ?>
<?php foreach ($jinde as $kod => $adresaJinde): ?>
<link rel="alternate" hreflang="<?= e($kod) ?>" href="<?= e($web['adresa'] . $adresaJinde) ?>">
<?php endforeach ?>
<link rel="alternate" hreflang="x-default" href="<?= e($web['adresa'] . ($jinde[$web['vychozi_jazyk']] ?? $url)) ?>">
<?php endif ?>
<meta property="og:title" content="<?= e($titulek) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="phpRS">
<?php if ($stranka['popis'] !== ''): ?>
<meta property="og:description" content="<?= e($stranka['popis']) ?>">
<?php endif ?>
<?php if (!$neindexovat): ?>
<meta property="og:url" content="<?= e($web['adresa'] . $url) ?>">
<?php endif ?>
<meta property="og:locale" content="<?= e($web['og_locale'][$jazyk]) ?>">
<?php foreach ($neindexovat ? [] : array_diff_key($jinde, [$jazyk => true]) as $kod => $adresaJinde): ?>
<meta property="og:locale:alternate" content="<?= e($web['og_locale'][$kod]) ?>">
<?php endforeach ?>
<meta property="og:image" content="<?= e($web['adresa'] . $web['sdileni']['soubor']) ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="<?= (int) $web['sdileni']['sirka'] ?>">
<meta property="og:image:height" content="<?= (int) $web['sdileni']['vyska'] ?>">
<meta property="og:image:alt" content="<?= e($t['sdileni_alt']) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="color-scheme" content="light dark">
<link rel="icon" href="/assets/img/phprs-znacka.svg" type="image/svg+xml">
<link rel="icon" href="/assets/img/phprs-znacka-32.png" sizes="32x32" type="image/png">
<link rel="apple-touch-icon" href="/assets/img/phprs-znacka-180.png">
<link rel="stylesheet" href="/assets/web.css?v=<?= e($otisk) ?>">
<script src="/assets/web.js?v=<?= e($otisk) ?>" defer></script>
<script src="/assets/rezim.js?v=<?= e($otisk) ?>"></script>
</head>
<body class="<?= e($stranka['trida']) ?>">
<a class="preskocit" href="#obsah"><?= e($t['preskocit']) ?></a>
<header class="hlavicka">
	<div class="obal hlavicka-radek">
		<a class="logo" href="/<?= e($jazyk) ?>/" aria-label="phpRS"><?= $logo ?></a>
		<button class="menu-tl" type="button" aria-expanded="false" aria-controls="menu" data-menu><?= e($t['menu_tlacitko']) ?></button>
		<nav class="menu" id="menu" aria-label="<?= e($t['hlavni_navigace']) ?>">
<?php foreach ($t['menu'] as $kam => $popisek): ?>
			<a href="<?= e($cil($kam)) ?>"<?= $adresa === $kam ? ' aria-current="page"' : '' ?>><?= e($popisek) ?></a>
<?php endforeach ?>
			<a class="tl tl-maly" href="<?= e($cil('stahnout')) ?>"<?= $adresa === 'stahnout' ? ' aria-current="page"' : '' ?>><?= e($t['stahnout']) ?></a>
<?php if (count($jinde) > 1): ?>
			<span class="jazyky" role="group" aria-label="<?= e($t['jazyk_webu']) ?>">
<?php foreach ($jinde as $kod => $adresaJinde): ?>
				<a href="<?= e($adresaJinde) ?>" lang="<?= e($kod) ?>" hreflang="<?= e($kod) ?>" title="<?= e($web['jazyky'][$kod]) ?>"<?= $kod === $jazyk ? ' aria-current="true"' : '' ?>><?= e(strtoupper($kod)) ?></a>
<?php endforeach ?>
			</span>
<?php endif ?>
<?php // režim: podle systému → světlý → tmavý. Výchozí popisek platí bez uložené volby, ostatní si web.js vezme z data-atributů; ikonu volí CSS podle data-theme na <html> (nastavuje ho rezim.js už v hlavičce, takže neproblikne) ?>
			<button class="rezim" type="button" data-rezim data-stav="auto" aria-label="<?= e($t['rezim']['auto']) ?>" title="<?= e($t['rezim']['auto']) ?>" data-popis-auto="<?= e($t['rezim']['auto']) ?>" data-popis-light="<?= e($t['rezim']['light']) ?>" data-popis-dark="<?= e($t['rezim']['dark']) ?>">
				<svg class="rezim-auto" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 3a9 9 0 1 0 0 18V3Z"/><circle cx="12" cy="12" r="8.25" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
				<svg class="rezim-light" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"><circle cx="12" cy="12" r="4.25"/><path d="M12 2.5v2.25M12 19.25v2.25M2.5 12h2.25M19.25 12h2.25M5.28 5.28l1.6 1.6M17.12 17.12l1.6 1.6M5.28 18.72l1.6-1.6M17.12 6.88l1.6-1.6"/></svg>
				<svg class="rezim-dark" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"><path d="M20.5 14.2A8.75 8.75 0 0 1 9.8 3.5a8.75 8.75 0 1 0 10.7 10.7Z"/></svg>
			</button>
		</nav>
	</div>
</header>
<main id="obsah">
<?= $obsah ?>
</main>
<footer class="paticka">
	<div class="obal">
		<div class="podpora-pruh">
			<div>
				<strong><?= e($t['podpora_nadpis']) ?></strong>
				<span><?= e($t['podpora_text']) ?></span>
			</div>
			<a class="tl tl-svetly" href="<?= e($web['sponsors']) ?>" rel="noopener"><?= e($t['podpora_tlacitko']) ?></a>
		</div>
		<div class="paticka-mrizka">
			<div class="paticka-o">
				<a class="logo" href="/<?= e($jazyk) ?>/" aria-label="phpRS"><?= $logo ?></a>
				<p><?= e($t['paticka_veta']) ?></p>
			</div>
<?php foreach (['projekt' => $t['paticka_projekt'], 'pomoc' => $t['paticka_pomoc']] as $klic => $nadpis): ?>
			<nav aria-label="<?= e($nadpis) ?>">
				<h2><?= e($nadpis) ?></h2>
				<ul>
<?php foreach ($t['paticka_odkazy'][$klic] as $kam => $popisek): ?>
					<li><a href="<?= e($cil($kam)) ?>"><?= e($popisek) ?></a></li>
<?php endforeach ?>
<?php if ($klic === 'projekt'): ?>
					<li><a href="<?= e($web['github']) ?>" rel="noopener">GitHub</a></li>
<?php endif ?>
				</ul>
			</nav>
<?php endforeach ?>
		</div>
		<p class="paticka-spodek"><span>© <?= date('Y') ?> phpRS · GNU GPL v2</span><span><?= e($t['paticka_bez_sledovani']) ?></span></p>
	</div>
</footer>
</body>
</html>
