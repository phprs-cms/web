<?php
/**
 * Kostra každé stránky.
 *
 * @var array $web @var array $t @var string $jazyk @var string $otisk @var string $logo
 * @var array{titulek:string,popis:string,trida:string} $stranka @var string $obsah @var string $url @var string $adresa
 * @var array<string,string> $jinde adresa téže stránky v ostatních jazycích (kód jazyka => adresa)
 */
$titulek = $stranka['titulek'] === '' ? 'phpRS' : $stranka['titulek'] . ' – phpRS';
$dok = $t['adresa_dokumentace'];
$cil = static fn (string $kam): string => "/$jazyk/" . ($kam === 'dokumentace' ? $dok : ($t['adresy'][$kam] ?? $kam)) . '/';
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
<link rel="canonical" href="<?= e($web['adresa'] . $url) ?>">
<?php if (count($jinde) > 1): ?>
<?php foreach ($jinde as $kod => $adresaJinde): ?>
<link rel="alternate" hreflang="<?= e($kod) ?>" href="<?= e($web['adresa'] . $adresaJinde) ?>">
<?php endforeach ?>
<link rel="alternate" hreflang="x-default" href="<?= e($web['adresa'] . ($jinde[$web['vychozi_jazyk']] ?? $url)) ?>">
<?php endif ?>
<meta property="og:title" content="<?= e($titulek) ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($web['adresa'] . $url) ?>">
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
			<a class="tl tl-maly" href="<?= e($cil('stahnout')) ?>"><?= e($t['stahnout']) ?></a>
<?php if (count($jinde) > 1): ?>
			<span class="jazyky" role="group" aria-label="<?= e($t['jazyk_webu']) ?>">
<?php foreach ($jinde as $kod => $adresaJinde): ?>
				<a href="<?= e($adresaJinde) ?>" lang="<?= e($kod) ?>" hreflang="<?= e($kod) ?>" title="<?= e($web['jazyky'][$kod]) ?>"<?= $kod === $jazyk ? ' aria-current="true"' : '' ?>><?= e(strtoupper($kod)) ?></a>
<?php endforeach ?>
			</span>
<?php endif ?>
			<button class="rezim" type="button" data-rezim aria-label="<?= e($t['rezim']) ?>" title="<?= e($t['rezim']) ?>"><svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 3a9 9 0 1 0 0 18V3Z"/><circle cx="12" cy="12" r="8.25" fill="none" stroke="currentColor" stroke-width="1.5"/></svg></button>
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
