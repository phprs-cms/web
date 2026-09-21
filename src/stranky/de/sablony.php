<?php
$stranka['titulek'] = 'Vorlagen';
$stranka['popis'] = 'Vier mitgelieferte Vorlagen von phpRS: Klassisch mit drei Spalten, Classic Newspaper, Modern Magazine und Minimal. Heller und dunkler Modus, eigene Vorlagen.';

$sablony = [
    'default' => ['Klassisch', 'Drei Spalten, Blöcke an den Seiten, Artikel in der Mitte. Für Websites, die auf der Titelseite vieles zugleich zeigen wollen: Rubriken, Umfragen, meistgelesene Artikel, Kalender.'],
    'classic-newspaper' => ['Classic Newspaper', 'Seriöse Tageszeitung. Überschriften in Serifenschrift, feine Linien, Aufmacher und Spaltensatz im Stil großer internationaler Zeitungen.'],
    'modern-magazine' => ['Modern Magazine', 'Markantes Online-Magazin. Schwarze Leiste, große Überschriften, große Fotos und ein Kartenraster.'],
    'minimal' => ['Minimal', 'Persönliches Magazin, Blog oder Newsletter-Website. Eine schmale Spalte, ruhige Typografie, Artikelliste ohne störende Elemente.'],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Vorlagen</h1>
		<p class="perex">Im Paket sind vier. Alle haben einen hellen und einen dunklen Modus, funktionieren auf dem Telefon und übernehmen Logo, Farbe und Schriften aus der Einstellung „Identität der Website“. Die Vorlage wechseln Sie mit einem Klick – der Inhalt bleibt.</p>
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
			<figure class="okno"><?= obrazek("snimky/sablona-$slug.webp", "Vorlage $nazev – Titelseite, heller Modus") ?></figure>
			<figure class="okno"><?= obrazek("snimky/sablona-$slug-tmavy.webp", "Vorlage $nazev – Titelseite, dunkler Modus") ?></figure>
		</div>
	</div>
</section>
<?php endforeach ?>
<section class="pas pas-plocha">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Eigene Vorlage</h2>
			<p>Eine Vorlage ist ein Ordner mit einigen PHP-Dateien und einer CSS-Datei. Keine Template-Sprache, kein Build. Sie kopieren eine mitgelieferte Vorlage unter neuem Namen und passen sie an – eine Aktualisierung des Systems überschreibt Ihre Kopie nicht.</p>
		</div>
		<div>
			<h2>Mit Hilfe von Claude</h2>
			<p>Über die MCP-Anbindung kann Claude die Vorlage nach Ihrer Beschreibung schreiben. Jede eigene Vorlage durchläuft eine Prüfung, die weder Zugriff auf Dateien und Netzwerk noch das Starten von Prozessen zulässt – egal, wer sie geschrieben hat.</p>
		</div>
	</div>
</section>
