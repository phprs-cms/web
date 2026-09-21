<?php
$stranka['titulek'] = 'Funktionen';
$stranka['popis'] = 'Was phpRS kann: Editor und Inhaltstypen, redaktioneller Workflow, Vorlagen und Blöcke, Leser und Einnahmen, SEO, Sprachversionen, KI-Assistent und sicherer Betrieb.';

$skupiny = [
    ['psani', 'Schreiben', 'Ein Editor, der nicht im Weg steht, und Inhaltstypen, die ein Magazin wirklich nutzt.', 'snimky/admin-editor', 'Artikeleditor', [
        'WYSIWYG-Editor ohne fremde Bibliotheken' => 'Überschriften, Zitate, Tabellen, Bildergalerien, Anhänge. Saubere Ausgabe, kein Durcheinander im HTML.',
        'Videos und Beiträge aus Netzwerken nur per Adresse' => 'Sie fügen den Link ein, das System erledigt den Rest. Inhalte Dritter laden beim Leser erst nach einem Klick.',
        'Revisionen und Versionsvergleich' => 'Jede Änderung am Text ist eine Revision (die letzten 20 bleiben erhalten). Unterschiede sind im Text hervorgehoben, jede Version lässt sich wiederherstellen.',
        'Der Entwurf wird laufend gespeichert' => 'Im Browser und auf dem Server. Eine Sperre verhindert, dass zwei Personen denselben Artikel gleichzeitig bearbeiten.',
        'Artikelvorlagen und Inhaltstypen' => 'Longread, Fotoreportage, Interview; Live-Reportage, Rezension mit Bewertung, Podcast.',
        'Geplante Veröffentlichung' => 'Der Artikel erscheint zur eingestellten Zeit – nach der Zeitzone der Website, nicht des Servers.',
        'Kurz gefasst, Fragen und Antworten' => 'Zusammenfassung des Artikels in Stichpunkten und ein Frage-Antwort-Block mit strukturierten Daten. Nützlich für Leser wie für Suchmaschinen.',
        'Serien und Autorenseiten' => 'Artikel in Fortsetzungen mit Navigation zwischen den Teilen. Jeder Autor hat eine Seite mit Kurzporträt und seinen Texten.',
        'Anhänge zum Herunterladen' => 'PDF, Tabellen, Audio, Video und weitere gängige Typen bis 200 MB. Ausführbare Dateien, HTML und SVG lassen sich nicht hochladen.',
    ]],
    ['redakce', 'Redaktion', 'Vom einzelnen Autor bis zur Redaktion mit Korrektorat und Titelseiten-Editor.', 'snimky/admin-prehled', 'Übersicht der Administration', [
        'Rollen und Berechtigungen' => 'Autor, Redakteur, Administrator. Das Recht zu veröffentlichen wird gesondert vergeben. Zugriff nur auf ausgewählte Rubriken.',
        'Übergabe ans Korrektorat' => 'Entwurf → zur Korrektur → freigegeben → veröffentlicht. Über Übergabe und Rückgabe informiert eine E-Mail.',
        'Redaktionskalender und Titelseite' => 'Was wann erscheint und was auf der Website oben steht – zwei übersichtliche Ansichten direkt bei den Artikeln.',
        'Bearbeiten direkt auf der Website' => 'Einen Tippfehler korrigieren Sie auf der Seite, auf der Sie ihn gefunden haben. Gilt für Artikel und Seiten.',
        'Befehlspalette' => 'Strg/⌘+K: Artikel finden, neuen anlegen, in die Einstellungen springen. Ohne Klicken durch Menüs.',
        'Sammelaktionen und Protokoll' => 'Mehrere Artikel auf einmal in ein Ressort verschieben, verschlagworten, sperren oder löschen. Wichtige Änderungen werden protokolliert.',
        'Prüfung defekter Links' => 'Das System geht im Hintergrund die Links in veröffentlichten Artikeln durch und zeigt, welche nicht mehr funktionieren.',
    ]],
    ['vzhled', 'Aussehen', 'Drei Vorlagen, die Identität der Website und ein Layout, das Sie direkt auf der Seite zusammenstellen.', 'snimky/web-bloky', 'Visueller Block-Editor', [
        'Drei mitgelieferte Vorlagen' => 'Classic Newspaper, Modern Magazine und Minimal.',
        'Identität der Website' => 'Logo, Farbe und Schriften werden einmal eingestellt, die Vorlagen übernehmen sie.',
        'Dunkler Modus' => 'In allen Vorlagen – Sie schalten ihn in der Website-Identität ein, er richtet sich nach dem Gerät des Lesers. In der Administration schaltet jeder für sich um.',
        'Visueller Block-Editor' => 'Blöcke ziehen Sie auf der Live-Seite an ihren Platz und wählen dort das Spaltenlayout – Sie sehen dasselbe wie der Leser.',
        'Eigene Vorlage' => 'Gewöhnliches PHP und CSS in einem Ordner. Dateien, die Claude schreibt, durchlaufen eine Prüfung der erlaubten Funktionen.',
        'Bilder ohne Springen' => 'Abmessungen, WebP-Varianten und Hintergrundfarbe werden automatisch ergänzt.',
    ]],
    ['ctenari', 'Leser und Einnahmen', 'Werkzeuge, mit denen ein Magazin sein Publikum aufbaut und den Betrieb bezahlt.', null, '', [
        'Kommentare mit Moderation' => 'Spamschutz ohne Cookies und ohne fremde Dienste.',
        'Registrierung ohne Passwort' => 'Der Leser registriert sich nur mit seiner E-Mail-Adresse; das Passwort setzt er über einen Link, oder er meldet sich mit einem Einmal-Link an. Gespeicherte Artikel, Newsletter-Abo, Kommentare unter eigenem Konto.',
        'Gesperrte Inhalte und weiche Paywall' => 'Ein Teil der Inhalte nur für Angemeldete oder Abonnenten; einige gesperrte Artikel pro Monat können kostenlos sein.',
        'Abonnements über Stripe' => 'Der Leser zahlt per Karte auf einer Stripe-Seite, die Website schaltet das Abonnement selbst frei und verlängert es; Kündigung und Kartenwechsel erledigt er im Stripe-Portal. Kartendaten erreichen Ihre Website nie. Von Hand können Sie ein Abonnement weiterhin jedem eintragen.',
        'Newsletter' => 'Manuelle und automatische Auswahl neuer Artikel, für jede Sprache der Website getrennt. Warteschlange mit Wiederholung.',
        'Web Push' => 'Benachrichtigungen über neue Artikel im Browser – ohne Vermittler, nur über die Zustelldienste der Browser selbst.',
        'Anzeigensystem' => 'Positionen, Ausrichtung auf Rubriken, zeitlich begrenzte Kampagnen und ein Bericht über Einblendungen und Klicks.',
        'Umfragen, Kurzmeldungen und Bewertungen' => 'Umfragen und Kurzmeldungen als Erweiterungen; Sternebewertung für Artikel; Leser können einen unpassenden Kommentar melden.',
        'Übersicht Einnahmen' => 'Abonnements, freiwillige Unterstützung, Werbung und Newsletter auf einem Bildschirm. Der Block „Unterstützen Sie uns“ führt zu Ihrem Zahlungslink.',
    ]],
    ['seo', 'SEO und KI-Suche', 'Damit Mensch und Maschine den Artikel finden – und Sie bestimmen, was Maschinen dürfen.', null, '', [
        'Strukturierte Daten' => 'Schema.org für Artikel, Rezensionen, Podcasts, Brotkrümelnavigation und Autor.',
        'Sitemap, RSS und JSON Feed' => 'Entstehen automatisch, einschließlich der Sprachversionen.',
        'IndexNow' => 'Suchmaschinen erfahren sofort von einem neuen Artikel.',
        'llms.txt und Markdown-Versionen der Artikel' => 'Reiner Text für Sprachmodelle, wenn Sie das möchten.',
        'Steuerung der KI-Crawler' => 'Mit einem Schalter lassen Sie KI-Bots (GPTBot, ClaudeBot, PerplexityBot…) zu oder sperren sie aus – ohne die robots.txt von Hand zu bearbeiten.',
        'Podcast und Google News' => 'Ein Podcast-Feed mit den Angaben, die Apple Podcasts und Spotify erwarten, und eine eigene Sitemap für Google News.',
        '301-Weiterleitungen' => 'Alte Adressen führen auf neue; bei jeder Weiterleitung sehen Sie, wie oft sie verwendet wurde.',
        'Cookie-Banner und Webanalyse mit Einwilligung' => 'Eingebautes Banner mit Protokoll der Einwilligungen. GA4, Matomo und Plausible starten erst nach der Einwilligung; die eigene Besuchsstatistik braucht gar keine Cookies.',
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
        'Import aus WordPress und Export der Website' => 'Artikel, Ressorts, Schlagwörter, Seiten, Kommentare und Bilder übernehmen Sie aus einem WordPress-Export; alte Adressen werden weitergeleitet. Und alle Inhalte nehmen Sie jederzeit in einem offenen Format mit.',
        'Signierte Aktualisierungen' => 'Eine Schaltfläche, Ed25519-Signatur. Sicherheitsversionen installieren sich selbst.',
        'Backups auch außerhalb des Servers' => 'Datenbank-Backup wöchentlich und vor jeder Aktualisierung; Kopie per FTP/FTPS oder in einen S3-Speicher. Wiederherstellung aus der Administration; die Dateien nimmt der Website-Export mit.',
        'Systemstatus' => 'Server, Datenbank, Rechte, Absicherung, E-Mail, Cron – mit einem Hinweis, was zu beheben ist. Auch als JSON für das Monitoring.',
        'Zwei-Faktor-Anmeldung' => 'TOTP mit Ersatzcodes und dazu ein Passkey (Fingerabdruck, Face ID) als bequemerer zweiter Schritt. Kontosperre nach wiederholten Fehlversuchen.',
        'Integritätsprüfung des Kerns' => 'Die Dateien werden mit der signierten Dateiliste der Version verglichen.',
        'E-Mail über SMTP mit Warteschlange' => 'Nicht zugestellte Nachrichten werden erneut versucht; Übersicht der letzten Nachrichten.',
        'Lese-API und Webhook' => 'Eine JSON-API für eine mobile App oder eine andere Website und ein Webhook bei Veröffentlichung eines Artikels – beides als Erweiterung.',
        'Seiten-Cache und Volltextsuche' => 'Nicht angemeldete Leser erhalten die fertige Seite aus dem Cache. Die Suche läuft über die Datenbank, ohne fremden Dienst.',
        'Beispielmagazin' => 'Bei der Installation können Sie Beispielinhalte auf Tschechisch, Englisch oder Deutsch laden und später mit einem Klick löschen.',
    ]],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Funktionen</h1>
		<p class="perex">Alles, was folgt, gehört zu einem einzigen Paket. Nichts wird dazugekauft und nichts nachinstalliert – seltener genutzte Teile schalten Sie in der Administration auf der Seite Erweiterungen ein.</p>
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
