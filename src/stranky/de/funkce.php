<?php
$stranka['titulek'] = 'Funktionen';
$stranka['popis'] = 'Was phpRS kann: Editor und Inhaltstypen, redaktioneller Workflow, Vorlagen und Blöcke, Leser und Einnahmen, SEO, Sprachversionen, KI-Assistent und sicherer Betrieb.';

$skupiny = [
    ['psani', 'Schreiben', 'Ein Editor, der nicht im Weg steht, und Inhaltstypen, die ein Magazin wirklich nutzt.', 'snimky/admin-editor', 'Artikeleditor', [
        'WYSIWYG-Editor ohne fremde Bibliotheken' => 'Überschriften, Zitate, Tabellen, Bildergalerien, Anhänge. Saubere Ausgabe, kein Durcheinander im HTML.',
        'Videos und Beiträge aus Netzwerken nur per Adresse' => 'Sie fügen den Link ein, das System erledigt den Rest. Inhalte Dritter laden beim Leser erst nach einem Klick.',
        'Revisionen und Versionsvergleich' => 'Jedes Speichern ist eine Revision. Sie sehen die Unterschiede nebeneinander und stellen jede Version wieder her.',
        'Der Entwurf wird laufend gespeichert' => 'Im Browser und auf dem Server. Eine Sperre verhindert, dass zwei Personen denselben Artikel gleichzeitig bearbeiten.',
        'Artikelvorlagen und Inhaltstypen' => 'Longread, Fotoreportage, Interview; Live-Reportage, Rezension mit Bewertung, Podcast.',
        'Geplante Veröffentlichung' => 'Der Artikel erscheint zur eingestellten Zeit – nach der Zeitzone der Website, nicht des Servers.',
    ]],
    ['redakce', 'Redaktion', 'Vom einzelnen Autor bis zur Redaktion mit Korrektorat und Titelseiten-Editor.', 'snimky/admin-prehled', 'Übersicht der Administration', [
        'Rollen und Berechtigungen' => 'Autor, Redakteur, Administrator. Das Recht zu veröffentlichen wird gesondert vergeben. Zugriff nur auf ausgewählte Rubriken.',
        'Übergabe ans Korrektorat' => 'Entwurf → zur Korrektur → freigegeben → veröffentlicht. Über Übergabe und Rückgabe informiert eine E-Mail.',
        'Redaktionskalender und Titelseite' => 'Was wann erscheint und was auf der Website oben steht – an einem Ort.',
        'Bearbeiten direkt auf der Website' => 'Einen Tippfehler korrigieren Sie auf der Seite, auf der Sie ihn gefunden haben. Gilt für Artikel und Seiten.',
        'Befehlspalette' => 'Strg/⌘+K: Artikel finden, neuen anlegen, in die Einstellungen springen. Ohne Klicken durch Menüs.',
        'Sammelaktionen und Protokoll' => 'Mehrere Artikel auf einmal verschieben, veröffentlichen oder löschen. Wichtige Änderungen werden protokolliert.',
    ]],
    ['vzhled', 'Aussehen', 'Vier Vorlagen, die Identität der Website und ein Layout, das Sie direkt auf der Seite zusammenstellen.', 'snimky/web-bloky', 'Visueller Block-Editor', [
        'Vier mitgelieferte Vorlagen' => 'Klassisch mit drei Spalten, Classic Newspaper, Modern Magazine und Minimal.',
        'Identität der Website' => 'Logo, Farbe und Schriften werden einmal eingestellt, die Vorlagen übernehmen sie.',
        'Dunkler Modus' => 'In allen Vorlagen und in der Administration. Richtet sich nach dem System des Lesers und lässt sich umschalten.',
        'Visueller Block-Editor' => 'Spalten und Blöcke ziehen Sie auf der Live-Seite an ihren Platz – Sie sehen dasselbe wie der Leser.',
        'Eigene Vorlage' => 'Gewöhnliches PHP und CSS in einem Ordner. Das System prüft die Vorlage vor dem Einschalten.',
        'Bilder ohne Springen' => 'Abmessungen, WebP-Varianten und Hintergrundfarbe werden automatisch ergänzt.',
    ]],
    ['ctenari', 'Leser und Einnahmen', 'Werkzeuge, mit denen ein Magazin sein Publikum aufbaut und den Betrieb bezahlt.', null, '', [
        'Kommentare mit Moderation' => 'Spamschutz ohne Cookies und ohne fremde Dienste.',
        'Registrierung ohne Passwort' => 'Der Leser meldet sich über einen Link aus der E-Mail an. Gespeicherte Artikel, Newsletter-Abo, Kommentare unter eigenem Konto.',
        'Gesperrte Inhalte und weiche Paywall' => 'Ein Teil der Inhalte nur für Angemeldete oder Abonnenten; einige gesperrte Artikel pro Monat können kostenlos sein.',
        'Newsletter' => 'Manuelle und automatische Auswahl neuer Artikel, für jede Sprache der Website getrennt. Warteschlange mit Wiederholung.',
        'Web Push' => 'Benachrichtigungen über neue Artikel im Browser, ohne Dienst eines Drittanbieters.',
        'Anzeigensystem' => 'Positionen, Ausrichtung auf Rubriken, zeitlich begrenzte Kampagnen und ein Bericht über Einblendungen und Klicks.',
    ]],
    ['seo', 'SEO und KI-Suche', 'Damit Mensch und Maschine den Artikel finden – und Sie bestimmen, was Maschinen dürfen.', null, '', [
        'Strukturierte Daten' => 'Schema.org für Artikel, Rezensionen, Podcasts, Brotkrümelnavigation und Autor.',
        'Sitemap, RSS und JSON Feed' => 'Entstehen automatisch, einschließlich der Sprachversionen.',
        'IndexNow' => 'Suchmaschinen erfahren sofort von einem neuen Artikel.',
        'llms.txt und Markdown-Versionen der Artikel' => 'Reiner Text für Sprachmodelle, wenn Sie das möchten.',
        'Steuerung der KI-Crawler' => 'Sie entscheiden, welche Bots Sie zulassen – in den Einstellungen, nicht durch Bearbeiten der robots.txt von Hand.',
    ]],
    ['jazyky', 'Sprachen', 'Mehrsprachige Website und mehrsprachige Redaktion.', null, '', [
        'Sprachversionen der Website' => 'Tschechisch, Slowakisch, Englisch, Deutsch – mit hreflang und verknüpften Übersetzungen.',
        'Administration in vier Sprachen' => 'Jeder Benutzer wählt seine eigene. Der Installer ebenfalls.',
        'E-Mails in der Sprache des Empfängers' => 'Newsletter und Systemnachrichten.',
        'Zeitzone der Website' => 'Unabhängig von der Einstellung des Servers.',
    ]],
    ['ai', 'KI – optional', 'Ausgeschaltet, bis Sie einen eigenen Schlüssel eintragen. Nichts wird ohne Ihr Wissen gesendet.', null, '', [
        'Assistent im Editor' => 'Titel, Vorspann, Zusammenfassung, Schlagwörter, Korrektur, Bildbeschreibungen, Übersetzung des Artikels. Über die Claude API.',
        'Anbindung an Claude (MCP)' => 'Claude verwaltet Inhalte und schreibt eigene Vorlagen. In den Code des Systems, die Benutzer und den Server greift Claude nicht ein.',
    ]],
    ['provoz', 'Betrieb und Sicherheit', 'Dinge, die man erst schätzt, wenn etwas schiefgeht. Hier sind sie schon fertig.', 'snimky/admin-stav', 'Systemstatus', [
        'Signierte Aktualisierungen' => 'Eine Schaltfläche, Ed25519-Signatur. Sicherheitsversionen installieren sich selbst.',
        'Backups auch außerhalb des Servers' => 'Wöchentlich und vor jeder Aktualisierung; Kopie per FTP oder nach S3. Wiederherstellung aus der Administration.',
        'Systemstatus' => 'Server, Datenbank, Rechte, Absicherung, E-Mail, Cron – mit einem Hinweis, was zu beheben ist. Auch als JSON für das Monitoring.',
        'Zwei-Faktor-Anmeldung' => 'TOTP mit Ersatzcodes. Kontosperre nach wiederholten Fehlversuchen.',
        'Integritätsprüfung des Kerns' => 'Die Dateien werden mit der signierten Dateiliste der Version verglichen.',
        'E-Mail über SMTP mit Warteschlange' => 'Nicht zugestellte Nachrichten werden erneut versucht; Übersicht der letzten Nachrichten.',
    ]],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Funktionen</h1>
		<p class="perex">Alles, was folgt, gehört zu einem einzigen Paket. Nichts wird dazugekauft und nichts nachinstalliert – seltener genutzte Teile schalten Sie in den Einstellungen als Erweiterungen ein.</p>
		<nav class="kotvy" aria-label="Funktionsgruppen">
<?php foreach ($skupiny as [$id, $nazev]): ?>
			<a href="#<?= e($id) ?>"><?= e($nazev) ?></a>
<?php endforeach ?>
		</nav>
	</div>
</section>
<?php foreach ($skupiny as $i => [$id, $nazev, $uvod, $snimek, $alt, $body]): ?>
<section class="pas<?= $i % 2 ? ' pas-plocha' : '' ?>" id="<?= e($id) ?>">
	<div class="obal">
		<div class="skupina-hlava">
			<h2><?= e($nazev) ?></h2>
			<p><?= e($uvod) ?></p>
		</div>
<?php if ($snimek !== null && ($img = obrazek("$snimek.webp", $alt, 'jen-svetly') . obrazek("$snimek-tmavy.webp", "$alt – dunkler Modus", 'jen-tmavy')) !== ''): ?>
		<figure class="okno okno-skupina"><?= $img ?></figure>
<?php endif ?>
		<dl class="funkce">
<?php foreach ($body as $co => $popis): ?>
			<div><dt><?= e($co) ?></dt><dd><?= e($popis) ?></dd></div>
<?php endforeach ?>
		</dl>
	</div>
</section>
<?php endforeach ?>
