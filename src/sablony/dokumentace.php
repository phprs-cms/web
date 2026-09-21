<?php
/**
 * Stránka příručky: navigace kapitol, text, obsah stránky.
 *
 * @var array $web @var array $t @var string $jazyk @var array $doc @var array $navigace
 * @var ?array $predchozi @var ?array $dalsi @var string $zaklad
 */
?>
<div class="obal doc">
	<aside class="doc-nav" aria-label="<?= e($t['doc_kapitoly']) ?>">
		<div class="doc-hledani" data-hledani="<?= e($zaklad) ?>hledani.json" data-nic="<?= e($t['doc_hledat_nic']) ?>">
			<label class="jen-ctecka" for="doc-q"><?= e($t['doc_hledat']) ?></label>
			<input id="doc-q" type="search" placeholder="<?= e($t['doc_hledat']) ?>" autocomplete="off" spellcheck="false">
			<ol class="doc-vysledky" hidden></ol>
		</div>
		<details class="doc-kapitoly" open>
			<summary><?= e($t['doc_kapitoly']) ?></summary>
			<p><a href="<?= e($zaklad) ?>"<?= $doc['url'] === $zaklad ? ' aria-current="page"' : '' ?>><?= e($t['doc_prehled']) ?></a></p>
<?php foreach ($navigace as $kapitola): ?>
			<h2><?= e($kapitola['nazev']) ?></h2>
			<ul>
<?php foreach ($kapitola['stranky'] as $s): ?>
				<li><a href="<?= e($s['url']) ?>"<?= $s['url'] === $doc['url'] ? ' aria-current="page"' : '' ?>><?= e($s['titulek']) ?></a></li>
<?php endforeach ?>
			</ul>
<?php endforeach ?>
		</details>
		<p class="doc-verze"><?= e($t['doc_verze']) ?> <strong><?= e($web['verze']) ?></strong></p>
	</aside>
	<article class="doc-text proza">
		<h1><?= e($doc['titulek']) ?></h1>
<?= $doc['html'] ?>
		<nav class="doc-dal" aria-label="<?= e($t['doc_predchozi']) ?> / <?= e($t['doc_dalsi']) ?>">
<?php if ($predchozi !== null): ?>
			<a class="doc-dal-zpet" href="<?= e($predchozi['url']) ?>"><span><?= e($t['doc_predchozi']) ?></span><?= e($predchozi['titulek']) ?></a>
<?php endif ?>
<?php if ($dalsi !== null): ?>
			<a class="doc-dal-vpred" href="<?= e($dalsi['url']) ?>"><span><?= e($t['doc_dalsi']) ?></span><?= e($dalsi['titulek']) ?></a>
<?php endif ?>
		</nav>
	</article>
<?php if (count($doc['nadpisy']) > 1): ?>
	<nav class="doc-obsah" aria-label="<?= e($t['doc_obsah']) ?>">
		<h2><?= e($t['doc_obsah']) ?></h2>
		<ul>
<?php foreach ($doc['nadpisy'] as $n): ?>
			<li><a href="#<?= e($n['id']) ?>"><?= e($n['text']) ?></a></li>
<?php endforeach ?>
		</ul>
	</nav>
<?php endif ?>
</div>
