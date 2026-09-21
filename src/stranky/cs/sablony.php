<?php
$stranka['titulek'] = 'Šablony';
$stranka['popis'] = 'Čtyři vestavěné šablony phpRS: klasická třísloupcová, Classic Newspaper, Modern Magazine a Minimal. Světlý i tmavý režim, vlastní šablony.';

$sablony = [
    'default' => ['Klasická', 'Tři sloupce, bloky po stranách, články uprostřed. Pro weby, které chtějí mít na titulní straně hodně věcí najednou: rubriky, ankety, nejčtenější, kalendář.'],
    'classic-newspaper' => ['Classic Newspaper', 'Seriózní deník. Patkové titulky, tenké linky, otvírák a sloupcová sazba ve stylu velkých světových novin.'],
    'modern-magazine' => ['Modern Magazine', 'Výrazný online magazín. Černá lišta, velké titulky, velké fotografie a mřížka karet.'],
    'minimal' => ['Minimal', 'Osobní magazín, blog nebo newsletterový web. Jeden úzký sloupec, klidná typografie, seznam článků bez rušivých prvků.'],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Šablony</h1>
		<p class="perex">V balíčku jsou čtyři. Všechny mají světlý i tmavý režim, fungují na telefonu a přebírají logo, barvu a písma z nastavení Identita webu. Přepnutí šablony je otázka jednoho kliknutí – obsah zůstává.</p>
	</div>
</section>
<?php foreach ($sablony as $slug => [$nazev, $popis]): ?>
<section class="pas sablona" id="<?= e($slug) ?>">
	<div class="obal">
		<div class="skupina-hlava">
			<h2><?= e($nazev) ?></h2>
			<p><?= e($popis) ?></p>
		</div>
		<div class="sablona-dvojice">
			<figure class="okno"><?= obrazek("snimky/sablona-$slug.webp", "Šablona $nazev – titulní strana, světlý režim") ?></figure>
			<figure class="okno"><?= obrazek("snimky/sablona-$slug-tmavy.webp", "Šablona $nazev – titulní strana, tmavý režim") ?></figure>
		</div>
	</div>
</section>
<?php endforeach ?>
<section class="pas pas-plocha">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Vlastní šablona</h2>
			<p>Šablona je složka s několika soubory PHP a jedním CSS. Žádný šablonovací jazyk, žádné sestavování. Vestavěnou šablonu zkopírujete pod novým názvem a upravíte – aktualizace systému vaši kopii nepřepíše.</p>
		</div>
		<div>
			<h2>S pomocí Claude</h2>
			<p>Přes napojení MCP může šablonu podle vašeho popisu napsat Claude. Každá vlastní šablona prochází kontrolou, která nepovolí práci se soubory, sítí ani spouštění procesů – ať ji psal kdokoli.</p>
		</div>
	</div>
</section>
