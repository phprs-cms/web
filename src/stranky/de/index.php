<?php
$stranka['titulek'] = '';
$stranka['popis'] = 'phpRS ist ein Redaktionssystem für Online-Magazine, Zeitungen und Blogs. Reines PHP und MySQL, ohne Framework und ohne Abhängigkeiten. Kostenlos unter der GNU GPL v2.';
$stranka['trida'] = 'je-uvod';
?>
<section class="uvod">
	<div class="obal uvod-mrizka">
		<div class="uvod-text">
			<p class="stitek-verze"><a href="/de/download/">Version <?= e($web['verze']) ?></a> · GNU GPL v2 · kostenlos</p>
			<h1>Redaktionssystem für Magazine, Zeitungen und&nbsp;Blogs.</h1>
			<p class="perex">Reines PHP und MySQL. Kein Framework, kein Composer, kein npm. Sie laden es auf Ihr Hosting, öffnen den Installer und schreiben nach vier Schritten.</p>
			<p class="tlacitka">
				<a class="tl" href="/de/download/">Herunterladen und installieren</a>
				<a class="tl tl-obrys" href="/de/dokumentation/">Dokumentation</a>
			</p>
		</div>
		<dl class="uvod-cisla">
			<div><dt>0</dt><dd>Abhängigkeiten und Build-Schritte</dd></div>
			<div><dt>4</dt><dd>Installationsschritte</dd></div>
			<div><dt>3</dt><dd>mitgelieferte Vorlagen</dd></div>
			<div><dt>4</dt><dd>Sprachen der Administration</dd></div>
		</dl>
	</div>
	<div class="obal">
		<figure class="okno">
			<?= obrazek('snimky/admin-prehled.webp', 'Übersicht der phpRS-Administration: Artikel in Arbeit, Redaktionskalender und erste Schritte', 'jen-svetly', false) ?>
			<?= obrazek('snimky/admin-prehled-tmavy.webp', 'Übersicht der phpRS-Administration im dunklen Modus', 'jen-tmavy', false) ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Warum phpRS</h2>
		<div class="duvody">
			<article>
				<h3>Einfachheit vor Abstraktion</h3>
				<p>Code, den ein interessierter Laie lesen kann. Keine Schichten, die man erst verstehen muss. Die Website läuft auf gewöhnlichem Shared Hosting. Umziehen heißt: Ordner und Datenbank kopieren.</p>
			</article>
			<article>
				<h3>Sicherheit an erster Stelle</h3>
				<p>Aktualisierungen sind mit dem Schlüssel des Herausgebers signiert, Sicherheitskorrekturen installieren sich selbst. Zwei-Faktor-Anmeldung, strenge Content Security Policy und Integritätsprüfung der Kerndateien.</p>
			</article>
			<article>
				<h3>Kein Plug-in-Marktplatz</h3>
				<p>Die Erweiterungen sind ein geschlossener, kuratierter Satz. Sie schalten sie in den Einstellungen ein – nichts wird aus fremden Quellen installiert, nichts bricht nach einer Aktualisierung und nichts bringt fremden Code auf Ihre Website.</p>
			</article>
			<article>
				<h3>Privatsphäre der Leser</h3>
				<p>Eigene Besucherstatistik ohne Cookies. IP-Adressen werden nicht gespeichert. Videos und Beiträge aus sozialen Netzwerken laden erst nach einem Klick des Lesers, der Spamschutz kommt ohne fremde Dienste aus.</p>
			</article>
		</div>
	</div>
</section>

<section class="pas pas-plocha">
	<div class="obal dvoji">
		<div>
			<h2>Eine Redaktion, nicht nur ein Editor</h2>
			<p>Die Rollen Autor, Redakteur und Administrator, Berechtigungen nach Rubriken, Übergabe ans Korrektorat per E-Mail, Redaktionskalender und Titelseite. Revisionen mit Versionsvergleich und eine Sperre gegen gleichzeitiges Bearbeiten.</p>
			<p>Seiten und Artikel lassen sich <strong>direkt auf der Website</strong> bearbeiten. Das Layout der Website entsteht im <strong>visuellen Block-Editor</strong> – auf der Seite, die die Leser sehen.</p>
			<p><a class="sipka" href="/de/funktionen/">Alle Funktionen</a></p>
		</div>
		<figure class="okno">
			<?= obrazek('snimky/admin-editor.webp', 'Artikeleditor in phpRS', 'jen-svetly') ?>
			<?= obrazek('snimky/admin-editor-tmavy.webp', 'Artikeleditor in phpRS im dunklen Modus', 'jen-tmavy') ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Drei Vorlagen im Paket</h2>
		<p class="pod-nadpisem">Jede hat einen hellen und einen dunklen Modus und übernimmt Logo, Farbe und Schriften Ihrer Website. Eine eigene Vorlage schreiben Sie selbst – oder mit Claude über die MCP-Anbindung.</p>
		<div class="sablony-nahled">
<?php foreach (['classic-newspaper' => 'Classic Newspaper', 'modern-magazine' => 'Modern Magazine', 'minimal' => 'Minimal'] as $slug => $nazev): ?>
			<a href="/de/vorlagen/#<?= e($slug) ?>">
				<?= obrazek("snimky/sablona-$slug.webp", "Vorlage $nazev – Titelseite", 'jen-svetly') ?>
				<?= obrazek("snimky/sablona-$slug-tmavy.webp", "Vorlage $nazev – Titelseite, dunkler Modus", 'jen-tmavy') ?>
				<span><?= e($nazev) ?></span>
			</a>
<?php endforeach ?>
		</div>
	</div>
</section>

<section class="pas pas-tmavy">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Künstliche Intelligenz nur dort, wo sie hilft</h2>
			<p>Der optionale Assistent im Editor schlägt Titel, Vorspann, Schlagwörter oder eine Bildbeschreibung vor und übersetzt den Artikel in eine andere Sprachversion. Ohne Ihren Schlüssel für die Claude API ist er ausgeschaltet und sendet nichts.</p>
		</div>
		<div>
			<h2>Anbindung an Claude über MCP</h2>
			<p>Claude kann auf Ihre Anweisung Inhalte verwalten und eigene Vorlagen erstellen. An den Code des Systems, die Benutzer und die Servereinstellungen kommt Claude nicht heran – die Grenze liegt im Kern, nicht in den Einstellungen.</p>
		</div>
	</div>
</section>

<section class="pas">
	<div class="obal instalace">
		<div>
			<h2>Installation in vier Schritten</h2>
			<p>Sie brauchen ein Hosting mit PHP 8.4 und MySQL 8 oder MariaDB 10.6. Sonst nichts – auch keinen Zugang zur Kommandozeile.</p>
			<p><a class="sipka" href="/de/dokumentation/erste-schritte/installation/">Ausführliche Anleitung</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Laden Sie die Dateien</strong> aus dem Paket auf Ihr Hosting.</li>
			<li><strong>Öffnen Sie die Website</strong> – der Installer startet von selbst und prüft den Server.</li>
			<li><strong>Tragen Sie Datenbank, Namen der Website und Administratorkonto ein</strong> und wählen Sie eine Vorlage.</li>
			<li><strong>Löschen Sie <code>install.php</code></strong> und melden Sie sich in der Administration an.</li>
		</ol>
	</div>
</section>
