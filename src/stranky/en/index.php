<?php
$stranka['titulek'] = '';
$stranka['popis'] = 'phpRS is a content management system for online magazines, newspapers and blogs. Plain PHP and MySQL, no framework and no dependencies. Free under the GNU GPL v2.';
$stranka['trida'] = 'je-uvod';
?>
<section class="uvod">
	<div class="obal uvod-mrizka">
		<div class="uvod-text">
			<p class="stitek-verze"><a href="/en/download/">Version <?= e($web['verze']) ?></a> · GNU GPL v2 · free</p>
			<h1>A content management system for magazines, newspapers and&nbsp;blogs.</h1>
			<p class="perex">Plain PHP and MySQL. No framework, no Composer, no npm. You upload it to your hosting, open the installer and start writing after four steps.</p>
			<p class="tlacitka">
				<a class="tl" href="/en/download/">Download and install</a>
				<a class="tl tl-obrys" href="/en/docs/">Documentation</a>
			</p>
		</div>
		<dl class="uvod-cisla">
			<div><dt>0</dt><dd>dependencies and build steps</dd></div>
			<div><dt>4</dt><dd>installation steps</dd></div>
			<div><dt>4</dt><dd>built-in templates</dd></div>
			<div><dt>4</dt><dd>admin languages</dd></div>
		</dl>
	</div>
	<div class="obal">
		<figure class="okno">
			<?= obrazek('snimky/admin-prehled.webp', 'The phpRS admin dashboard: articles in progress, the editorial calendar and first steps', 'jen-svetly', false) ?>
			<?= obrazek('snimky/admin-prehled-tmavy.webp', 'The phpRS admin dashboard in dark mode', 'jen-tmavy', false) ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Why phpRS</h2>
		<div class="duvody">
			<article>
				<h3>Simplicity over abstraction</h3>
				<p>Code that an informed non-programmer can read. No layers you have to understand first. The site runs on ordinary shared hosting, and you move it by copying a folder and a database.</p>
			</article>
			<article>
				<h3>Security comes first</h3>
				<p>Updates are signed with the publisher's key, and security fixes install themselves. Two-factor login, a strict Content Security Policy and an integrity check of the core files.</p>
			</article>
			<article>
				<h3>No plug-in marketplace</h3>
				<p>Extensions are a closed, curated set. You switch them on in the settings – you install nothing from outside sources, nothing breaks after an update and no third-party code reaches your site.</p>
			</article>
			<article>
				<h3>Reader privacy</h3>
				<p>Built-in traffic statistics without cookies. IP addresses are not stored. Videos and social media posts load only after the reader clicks, and the antispam works without third-party services.</p>
			</article>
		</div>
	</div>
</section>

<section class="pas pas-plocha">
	<div class="obal dvoji">
		<div>
			<h2>A newsroom, not just an editor</h2>
			<p>Author, editor and administrator roles, permissions by section, handover for proofreading by e-mail, an editorial calendar and front page management. Revisions with version comparison and a lock against simultaneous editing.</p>
			<p>Pages and articles can be edited <strong>directly on the site</strong>, and the site layout is put together in a <strong>visual block editor</strong> – on the page that readers see.</p>
			<p><a class="sipka" href="/en/features/">All features</a></p>
		</div>
		<figure class="okno">
			<?= obrazek('snimky/admin-editor.webp', 'The article editor in phpRS', 'jen-svetly') ?>
			<?= obrazek('snimky/admin-editor-tmavy.webp', 'The article editor in phpRS in dark mode', 'jen-tmavy') ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Four templates in the package</h2>
		<p class="pod-nadpisem">Each has a light and a dark mode and takes over your site's logo, colour and fonts. You can write your own template yourself – or with Claude through the MCP connection.</p>
		<div class="sablony-nahled">
<?php foreach (['default' => 'Classic', 'classic-newspaper' => 'Classic Newspaper', 'modern-magazine' => 'Modern Magazine', 'minimal' => 'Minimal'] as $slug => $nazev): ?>
			<a href="/en/templates/#<?= e($slug) ?>">
				<?= obrazek("snimky/sablona-$slug.webp", "The $nazev template – front page", 'jen-svetly') ?>
				<?= obrazek("snimky/sablona-$slug-tmavy.webp", "The $nazev template – front page, dark mode", 'jen-tmavy') ?>
				<span><?= e($nazev) ?></span>
			</a>
<?php endforeach ?>
		</div>
	</div>
</section>

<section class="pas pas-tmavy">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Artificial intelligence only where it helps</h2>
			<p>An optional assistant in the editor suggests a headline, standfirst, tags or an image description and translates an article into another language version. Without your own Claude API key it is switched off and sends nothing anywhere.</p>
		</div>
		<div>
			<h2>Connection to Claude through MCP</h2>
			<p>On your instruction, Claude can manage content and create custom templates. It has no access to the system code, the users or the server settings – the boundary is set in the core, not in the settings.</p>
		</div>
	</div>
</section>

<section class="pas">
	<div class="obal instalace">
		<div>
			<h2>Installation in four steps</h2>
			<p>You need hosting with PHP 8.4 and MySQL 8 or MariaDB 10.6. Nothing else – no command-line access.</p>
			<p><a class="sipka" href="/en/docs/getting-started/installation/">Detailed guide</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Upload the files</strong> from the package to your hosting.</li>
			<li><strong>Open the site</strong> – the installer starts by itself and checks the server.</li>
			<li><strong>Fill in the database, the site name and the administrator account</strong> and choose a template.</li>
			<li><strong>Delete <code>install.php</code></strong> and log in to the administration.</li>
		</ol>
	</div>
</section>
