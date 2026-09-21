<?php
$stranka['titulek'] = 'Templates';
$stranka['popis'] = 'The four built-in phpRS templates: the three-column Classic, Classic Newspaper, Modern Magazine and Minimal. Light and dark mode, custom templates.';

$sablony = [
    'default' => ['Classic', 'Three columns, blocks on the sides, articles in the middle. For sites that want many things on the front page at once: sections, polls, most read, a calendar.'],
    'classic-newspaper' => ['Classic Newspaper', 'A serious daily. Serif headlines, thin rules, a lead story and column layout in the style of the major international newspapers.'],
    'modern-magazine' => ['Modern Magazine', 'A bold online magazine. A black bar, large headlines, large photographs and a grid of cards.'],
    'minimal' => ['Minimal', 'A personal magazine, a blog or a newsletter site. One narrow column, calm typography, a list of articles with no distracting elements.'],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Templates</h1>
		<p class="perex">There are four in the package. All have a light and a dark mode, work on a phone and take over the logo, colour and fonts from the Site identity settings. Switching the template takes one click – the content stays.</p>
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
			<figure class="okno"><?= obrazek("snimky/sablona-$slug.webp", "The $nazev template – front page, light mode") ?></figure>
			<figure class="okno"><?= obrazek("snimky/sablona-$slug-tmavy.webp", "The $nazev template – front page, dark mode") ?></figure>
		</div>
	</div>
</section>
<?php endforeach ?>
<section class="pas pas-plocha">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Custom template</h2>
			<p>A template is a folder with a few PHP files and one CSS file. No templating language, no build. You copy a built-in template under a new name and edit it – system updates do not overwrite your copy.</p>
		</div>
		<div>
			<h2>With the help of Claude</h2>
			<p>Through the MCP connection, Claude can write a template from your description. Every custom template goes through a check that does not allow file access, network access or starting processes – no matter who wrote it.</p>
		</div>
	</div>
</section>
