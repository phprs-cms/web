<?php
$stranka['titulek'] = 'Funkce';
$stranka['popis'] = 'Co phpRS umí: editor a typy obsahu, redakční workflow, šablony a bloky, čtenáři a příjmy, SEO, jazykové verze, AI asistent a bezpečný provoz.';

$skupiny = [
    ['psani', 'Psaní', 'Editor, který nepřekáží, a typy obsahu, které magazín opravdu používá.', 'snimky/admin-editor', 'Editor článku', [
        'WYSIWYG editor bez cizích knihoven' => 'Nadpisy, citace, tabulky, fotogalerie, přílohy. Čistý výstup, žádný nepořádek v HTML.',
        'Video a příspěvky ze sítí pouhou adresou' => 'Vložíte odkaz, systém udělá zbytek. Obsah třetích stran se čtenáři načte až po kliknutí.',
        'Revize a porovnání verzí' => 'Každé uložení je revize. Rozdíly vidíte vedle sebe a kteroukoli verzi vrátíte.',
        'Koncept se ukládá průběžně' => 'V prohlížeči i na serveru. Zámek hlídá, aby jeden článek neupravovali dva lidé zároveň.',
        'Šablony článku a typy obsahu' => 'Dlouhé čtení, Fotoreportáž, Rozhovor; živá reportáž, recenze s hodnocením, podcast.',
        'Plánované vydání' => 'Článek vyjde v nastavený čas – podle časového pásma webu, ne serveru.',
    ]],
    ['redakce', 'Redakce', 'Od jednoho autora po redakci s korektorem a editorem titulní strany.', 'snimky/admin-prehled', 'Přehled administrace', [
        'Role a oprávnění' => 'Autor, redaktor, administrátor. Právo vydávat zvlášť. Přístup jen k vybraným rubrikám.',
        'Předávka ke korektuře' => 'Koncept → ke korektuře → schváleno → vydáno. O předání a vrácení chodí e-mail.',
        'Redakční kalendář a titulní strana' => 'Co kdy vyjde a co je na webu nahoře – na jednom místě.',
        'Úprava přímo na webu' => 'Překlep opravíte na stránce, kde jste ho našli. Platí pro články i stránky.',
        'Paleta příkazů' => 'Ctrl/⌘+K: najít článek, založit nový, skočit do nastavení. Bez klikání v nabídkách.',
        'Hromadné akce a protokol' => 'Přesun, vydání, smazání více článků najednou. Důležité změny se zapisují.',
    ]],
    ['vzhled', 'Vzhled', 'Čtyři šablony, identita webu a rozvržení, které skládáte přímo na stránce.', 'snimky/web-bloky', 'Vizuální editor bloků', [
        'Čtyři vestavěné šablony' => 'Klasická třísloupcová, Classic Newspaper, Modern Magazine a Minimal.',
        'Identita webu' => 'Logo, barva a písma se nastaví jednou a šablony je převezmou.',
        'Tmavý režim' => 'Ve všech šablonách i v administraci. Řídí se systémem čtenáře, jde přepnout.',
        'Vizuální editor bloků' => 'Sloupce a bloky přetahujete na živé stránce – vidíte totéž co čtenář.',
        'Vlastní šablona' => 'Obyčejné PHP a CSS v jedné složce. Systém šablonu před zapnutím zkontroluje.',
        'Obrázky bez poskakování' => 'Rozměry, WebP varianty a barva podkladu se doplňují samy.',
    ]],
    ['ctenari', 'Čtenáři a příjmy', 'Nástroje, kterými si magazín buduje publikum a platí provoz.', null, '', [
        'Komentáře s moderací' => 'Antispam bez cookies a bez cizích služeb.',
        'Registrace bez hesla' => 'Čtenář se přihlásí odkazem z e-mailu. Uložené články, odběr newsletteru, komentáře pod vlastním účtem.',
        'Zamčený obsah a měkký paywall' => 'Část obsahu jen pro přihlášené nebo předplatitele; několik zamčených článků měsíčně může být zdarma.',
        'Newsletter' => 'Ruční i automatický výběr nových článků, pro každý jazyk webu zvlášť. Fronta s opakováním.',
        'Web Push' => 'Oznámení o nových článcích do prohlížeče, bez služby třetí strany.',
        'Reklamní systém' => 'Pozice, cílení na rubriky, časové kampaně a výkaz zobrazení a prokliků.',
    ]],
    ['seo', 'SEO a vyhledávání s AI', 'Aby článek našel člověk i stroj – a abyste měli pod kontrolou, co stroje smějí.', null, '', [
        'Strukturovaná data' => 'Schema.org pro články, recenze, podcasty, drobečkovou navigaci i autora.',
        'Mapa webu, RSS a JSON Feed' => 'Generují se samy, včetně jazykových verzí.',
        'IndexNow' => 'Vyhledávače se o novém článku dozvědí hned.',
        'llms.txt a Markdown verze článků' => 'Čistý text pro jazykové modely, pokud o to stojíte.',
        'Řízení AI crawlerů' => 'Rozhodnete, které roboty pustíte – v nastavení, ne ruční úpravou robots.txt.',
    ]],
    ['jazyky', 'Jazyky', 'Vícejazyčný web i vícejazyčná redakce.', null, '', [
        'Jazykové verze webu' => 'Čeština, slovenština, angličtina, němčina – s hreflang a propojením překladů.',
        'Administrace ve čtyřech jazycích' => 'Každý uživatel si volí svůj. Instalátor také.',
        'E-maily v jazyce příjemce' => 'Newsletter i systémové zprávy.',
        'Časové pásmo webu' => 'Nezávislé na nastavení serveru.',
    ]],
    ['ai', 'AI – volitelně', 'Vypnuté, dokud nezadáte vlastní klíč. Nic se nikam neposílá bez vašeho vědomí.', null, '', [
        'Asistent v editoru' => 'Titulky, perex, shrnutí, štítky, korektura, popisy obrázků, překlad článku. Přes Claude API.',
        'Napojení na Claude (MCP)' => 'Claude spravuje obsah a píše vlastní šablony. Do kódu systému, uživatelů ani serveru nezasáhne.',
    ]],
    ['provoz', 'Provoz a bezpečnost', 'Věci, které oceníte, až když se něco pokazí. Tady jsou hotové předem.', 'snimky/admin-stav', 'Stav systému', [
        'Podepsané aktualizace' => 'Jedno tlačítko, podpis Ed25519. Bezpečnostní vydání se nainstalují sama.',
        'Zálohy i mimo server' => 'Týdně a před každou aktualizací; kopie na FTP nebo do S3. Obnova z administrace.',
        'Stav systému' => 'Server, databáze, práva, zabezpečení, pošta, cron – s radou, co opravit. I jako JSON pro dohled.',
        'Dvoufázové přihlášení' => 'TOTP se záložními kódy. Zámek účtu po opakovaných chybách.',
        'Kontrola neporušenosti jádra' => 'Soubory se porovnávají s podepsaným seznamem vydání.',
        'Pošta přes SMTP s frontou' => 'Nedoručené zprávy se zkoušejí znovu; přehled posledních zpráv.',
    ]],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Funkce</h1>
		<p class="perex">Všechno níže je součást jednoho balíčku. Nic se nedokupuje a nic se nedoinstalovává – méně používané části se jen zapínají v nastavení jako rozšíření.</p>
		<nav class="kotvy" aria-label="Skupiny funkcí">
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
<?php if ($snimek !== null && ($img = obrazek("$snimek.webp", $alt, 'jen-svetly') . obrazek("$snimek-tmavy.webp", "$alt – tmavý režim", 'jen-tmavy')) !== ''): ?>
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
