<?php
$stranka['titulek'] = 'Herunterladen und installieren';
$stranka['popis'] = 'Download von phpRS, Anforderungen an das Hosting und Installation in vier Schritten.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Herunterladen und installieren</h1>
		<p class="perex">Ein ZIP, keine Abhängigkeiten. Sie entpacken es, laden es auf Ihr Hosting und öffnen die Website im Browser.</p>
	</div>
</section>
<section class="pas">
	<div class="obal stahnout">
		<div class="vydani">
			<p class="vydani-verze">phpRS <strong><?= e($web['verze']) ?></strong></p>
<?php if ($web['stahnout_url'] !== null): ?>
			<p><a class="tl" href="<?= e($web['stahnout_url']) ?>">ZIP herunterladen</a></p>
			<p class="drobne">Dies ist eine <strong>Beta</strong>: Das System ist fertig und getestet, sammelt aber erst Erfahrungen aus dem Produktivbetrieb. Legen Sie Backups an und melden Sie Fehler bitte auf <a href="https://github.com/phprs-cms/cms/issues" rel="noopener">GitHub</a>. <a href="https://github.com/phprs-cms/cms/releases" rel="noopener">Alle Versionen und Änderungen</a></p>
			<p class="drobne">Das Paket ist signiert. SHA-256-Prüfsumme und Signatur finden Sie bei der Version; die Administration prüft beides bei einer Aktualisierung selbst.</p>
<?php else: ?>
			<p><strong>Die öffentliche Beta ist in Vorbereitung.</strong> Das System läuft derzeit im Testbetrieb. Der Download erscheint hier, sobald wir es auf einem produktiven Hosting geprüft haben.</p>
			<p class="drobne">Das Paket wird mit dem Schlüssel des Herausgebers signiert – demselben, mit dem die Administration Aktualisierungen prüft.</p>
<?php endif ?>
<?php if ($web['demo_url'] !== null): ?>
			<p><a class="sipka" href="<?= e($web['demo_url']) ?>" rel="noopener">Demo ausprobieren</a></p>
<?php endif ?>
		</div>
		<div>
			<h2>Voraussetzungen</h2>
			<div class="tabulka"><table>
				<tbody>
					<tr><th scope="row">PHP</th><td>8.4 oder neuer</td></tr>
					<tr><th scope="row">Datenbank</th><td>MySQL 8 oder MariaDB 10.6 und neuer</td></tr>
					<tr><th scope="row">PHP-Erweiterungen</th><td><code>pdo_mysql</code>, <code>mbstring</code>, <code>gd</code> (Bildverarbeitung)</td></tr>
					<tr><th scope="row">Empfohlene Erweiterungen</th><td><code>zip</code> und <code>sodium</code> (Aktualisierung aus der Administration), <code>exif</code>, <code>intl</code>, <code>curl</code></td></tr>
					<tr><th scope="row">Webserver</th><td>Apache oder LiteSpeed (die Regeln liegen im Paket); nginx mit eigener Konfiguration</td></tr>
				</tbody>
			</table></div>
			<p class="drobne">Gewöhnliches Shared Hosting genügt. Sie brauchen weder Kommandozeile noch Composer oder Node.js. <a href="/de/dokumentation/erste-schritte/voraussetzungen/">Ausführliche Voraussetzungen</a></p>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal instalace">
		<div>
			<h2>Installation</h2>
			<p>Sie dauert wenige Minuten. Legen Sie vorher auf dem Hosting eine leere Datenbank an.</p>
			<p><a class="sipka" href="/de/dokumentation/erste-schritte/installation/">Ausführliche Anleitung</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Laden Sie den Inhalt des Pakets</strong> in den Ordner der Website – einschließlich der versteckten Dateien <code>.htaccess</code>.</li>
			<li><strong>Öffnen Sie die Website im Browser.</strong> Der Installer startet von selbst und prüft den Server.</li>
			<li><strong>Tragen Sie Datenbankzugang, Namen der Website und Administratorkonto ein</strong>, wählen Sie Zeitzone und Vorlage.</li>
			<li><strong>Melden Sie sich an</strong> und gehen Sie die „Ersten Schritte“ in der Übersicht durch. Der Installer löscht sich nach Abschluss selbst.</li>
		</ol>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Nach der Installation</h2>
			<p>Schalten Sie HTTPS und die Zwei-Faktor-Anmeldung ein, richten Sie E-Mail und Backups außerhalb des Servers ein. Die Seite <a href="/de/dokumentation/betrieb/systemstatus/">Systemstatus</a> zeigt, was noch fehlt.</p>
		</div>
		<div>
			<h2>Sie verwenden nginx?</h2>
			<p>Nginx liest die Dateien <code>.htaccess</code> nicht, die sensible Ordner schützen. Betreiben Sie die Website <strong>nicht</strong> ohne eigene Regeln – <a href="/de/dokumentation/betrieb/nginx/">Anleitung und Beispielkonfiguration</a>.</p>
		</div>
	</div>
</section>
