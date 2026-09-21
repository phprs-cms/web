<?php
$stranka['titulek'] = 'Sicherheit';
$stranka['popis'] = 'Wie phpRS Websites schützt: signierte Aktualisierungen, automatische Sicherheitskorrekturen, Integritätsprüfung des Kerns. Wie Sie eine Sicherheitslücke melden.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Sicherheit</h1>
		<p class="perex">Ein Redaktionssystem ist so sicher, wie schnell eine Korrektur auf den Websites ankommt. phpRS kümmert sich deshalb vor allem darum: dass die Korrektur von selbst ankommt – und dass niemand anderes ankommen kann.</p>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Eine Lücke melden</h2>
			<p>Bitte melden Sie Sicherheitslücken <strong>nicht öffentlich</strong>. Nutzen Sie die private Meldung auf GitHub (<em>Security → Report a vulnerability</em> im Repository des Projekts)<?= $web['email'] !== null ? ' oder die E-Mail-Adresse <a href="mailto:' . e($web['email']) . '">' . e($web['email']) . '</a>' : '' ?>.</p>
			<p>Nennen Sie die Version von phpRS, das Vorgehen und die Auswirkung. Wir melden uns innerhalb von drei Werktagen. Eine Korrektur veröffentlichen wir in der Regel innerhalb von 14 Tagen, bei kritischen Lücken so schnell wie möglich. Nach der Veröffentlichung erscheint ein Sicherheitshinweis mit Dank an die Person, die die Lücke gefunden hat.</p>
		</div>
		<div>
			<h2>Was danach geschieht</h2>
			<ol class="kroky kroky-male">
				<li>Die Korrektur erscheint als <strong>Sicherheitsversion</strong>.</li>
				<li>Websites mit eingeschalteter Automatik <strong>installieren sie innerhalb von 12 Stunden selbst</strong> – nach einem Backup der Datenbank und der Prüfung der Signatur.</li>
				<li>Der Administrator erhält eine E-Mail. Wer die Automatik ausgeschaltet hat, sieht einen Hinweis und aktualisiert mit einer Schaltfläche.</li>
			</ol>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Signierte Aktualisierungen</h2>
			<p>Die Administration installiert nur ein Paket, das nachweislich vom Herausgeber von phpRS stammt.</p>
		</div>
		<dl class="funkce">
			<div><dt>Ed25519-Signatur</dt><dd>Signiert sind die Version, die Prüfsumme des Pakets und das Merkmal „Sicherheitsversion“. Niemand kann unterwegs aus einer gewöhnlichen Version eine machen, die sich selbst installiert.</dd></div>
			<div><dt>Der Schlüssel liegt nicht auf dem Server</dt><dd>Der private Schlüssel verlässt den Rechner des Herausgebers nicht. Ein Angriff auf die Website phprs.eu oder auf GitHub reicht nicht aus, um eine Aktualisierung zu fälschen.</dd></div>
			<div><dt>Ersatzschlüssel</dt><dd>Das System kennt zwei öffentliche Schlüssel. Der zweite wird offline aufbewahrt und dient dem sicheren Austausch des ersten.</dd></div>
			<div><dt>Integritätsprüfung</dt><dd>Jede Version enthält eine signierte Liste der Kerndateien. Der Systemstatus meldet danach geänderte, fehlende und hinzugefügte Dateien.</dd></div>
		</dl>
	</div>
</section>
<section class="pas">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Standardeinstellungen</h2>
			<p>Sicheres Verhalten ist keine Option in den Einstellungen. Es ist ab der Installation eingeschaltet.</p>
		</div>
		<dl class="funkce">
			<div><dt>Zwei-Faktor-Anmeldung</dt><dd>TOTP mit Ersatzcodes. Der Systemstatus weist auf Administratoren hin, die sie nicht nutzen.</dd></div>
			<div><dt>Schutz vor dem Erraten von Passwörtern</dt><dd>Vorübergehende Kontosperre und ein Limit pro IP-Adresse – für die Redaktion wie für die Leser.</dd></div>
			<div><dt>Content Security Policy</dt><dd>Die Administration führt keine eingebetteten und keine fremden Skripte aus.</dd></div>
			<div><dt>Hochgeladene Dateien werden nicht ausgeführt</dt><dd>Im Medienordner läuft kein PHP, und erlaubt sind nur sichere Dateitypen.</dd></div>
			<div><dt>Keine fremden Plug-ins</dt><dd>Den häufigsten Angriffsweg auf Redaktionssysteme gibt es in phpRS nicht.</dd></div>
			<div><dt>Grenzen für die KI</dt><dd>Die Anbindung an Claude arbeitet mit Inhalten und eigenen Vorlagen. An Code, Benutzer und Server kommt sie nicht heran.</dd></div>
		</dl>
		<p><a class="sipka" href="/de/dokumentation/betrieb/sicherheit/">Sicherheit in der Dokumentation: was nach der Installation zu tun ist</a></p>
	</div>
</section>
