<?php
$stranka['titulek'] = '';
$stranka['popis'] = 'phpRS je redakční systém pro internetové magazíny, noviny a blogy. Čisté PHP a MySQL, bez frameworku a bez závislostí. Zdarma pod GNU GPL v2.';
$stranka['trida'] = 'je-uvod';
?>
<section class="uvod">
	<div class="obal uvod-mrizka">
		<div class="uvod-text">
			<p class="stitek-verze"><a href="/cs/stahnout/">Verze <?= e($web['verze']) ?></a> · GNU GPL v2 · zdarma</p>
			<h1>Redakční systém pro magazíny, noviny a&nbsp;blogy.</h1>
			<p class="perex">Čisté PHP a MySQL. Žádný framework, žádný Composer, žádné npm. Nahrajete ho na hosting, otevřete instalátor a po čtyřech krocích píšete.</p>
			<p class="tlacitka">
				<a class="tl" href="/cs/stahnout/">Stáhnout a nainstalovat</a>
				<a class="tl tl-obrys" href="/cs/dokumentace/">Dokumentace</a>
			</p>
		</div>
		<dl class="uvod-cisla">
			<div><dt>0</dt><dd>závislostí a build kroků</dd></div>
			<div><dt>4</dt><dd>kroky instalace</dd></div>
			<div><dt>3</dt><dd>vestavěné šablony</dd></div>
			<div><dt>4</dt><dd>jazyky administrace</dd></div>
		</dl>
	</div>
	<div class="obal">
		<figure class="okno">
			<?= obrazek('snimky/admin-prehled.webp', 'Přehled administrace phpRS: rozpracované články, redakční kalendář a první kroky', 'jen-svetly', false) ?>
			<?= obrazek('snimky/admin-prehled-tmavy.webp', 'Přehled administrace phpRS v tmavém režimu', 'jen-tmavy', false) ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Proč phpRS</h2>
		<div class="duvody">
			<article>
				<h3>Jednoduchost nad abstrakcí</h3>
				<p>Kód, který přečte poučený laik. Žádné vrstvy, které by bylo nutné nejdřív pochopit. Web běží na obyčejném sdíleném hostingu a přesunete ho zkopírováním složky a databáze.</p>
			</article>
			<article>
				<h3>Bezpečnost na prvním místě</h3>
				<p>Aktualizace podepsané klíčem vydavatele, bezpečnostní opravy se instalují samy. Dvoufázové přihlášení, přísná Content Security Policy v administraci a kontrola neporušenosti souborů jádra.</p>
			</article>
			<article>
				<h3>Žádný obchod s plug-iny</h3>
				<p>Rozšíření jsou uzavřená, kurátorovaná sada. Zapínáte je v administraci na stránce Rozšíření – nic neinstalujete z cizích zdrojů, nic se nerozbije po aktualizaci a nic nepřináší cizí kód na váš web.</p>
			</article>
			<article>
				<h3>Soukromí čtenářů</h3>
				<p>Vlastní statistika návštěvnosti bez cookies. IP adresy se neukládají. Videa a příspěvky ze sítí se načtou až po kliknutí čtenáře, antispam se obejde bez cizích služeb.</p>
			</article>
		</div>
	</div>
</section>

<section class="pas pas-plocha">
	<div class="obal dvoji">
		<div>
			<h2>Redakce, ne jen editor</h2>
			<p>Role autor, redaktor a administrátor, oprávnění podle rubrik, předávka ke korektuře e-mailem, redakční kalendář a titulní strana. Revize s porovnáním verzí a zámek proti souběžné úpravě.</p>
			<p>Stránky i články jdou upravit <strong>přímo na webu</strong> a rozvržení webu se skládá ve <strong>vizuálním editoru bloků</strong> – na stránce, kterou vidí čtenáři.</p>
			<p><a class="sipka" href="/cs/funkce/">Všechny funkce</a></p>
		</div>
		<figure class="okno">
			<?= obrazek('snimky/admin-editor.webp', 'Editor článku v phpRS', 'jen-svetly') ?>
			<?= obrazek('snimky/admin-editor-tmavy.webp', 'Editor článku v phpRS v tmavém režimu', 'jen-tmavy') ?>
		</figure>
	</div>
</section>

<section class="pas">
	<div class="obal">
		<h2 class="nadpis-pasu">Tři šablony v balíčku</h2>
		<p class="pod-nadpisem">Každá má světlý i tmavý režim a přebírá logo, barvu a písma vašeho webu. Vlastní šablonu si napíšete sami – nebo s Claude přes napojení MCP.</p>
		<div class="sablony-nahled">
<?php foreach (['classic-newspaper' => 'Classic Newspaper', 'modern-magazine' => 'Modern Magazine', 'minimal' => 'Minimal'] as $slug => $nazev): ?>
			<a href="/cs/sablony/#<?= e($slug) ?>">
				<?= obrazek("snimky/sablona-$slug.webp", "Šablona $nazev – titulní strana", 'jen-svetly') ?>
				<?= obrazek("snimky/sablona-$slug-tmavy.webp", "Šablona $nazev – titulní strana, tmavý režim", 'jen-tmavy') ?>
				<span><?= e($nazev) ?></span>
			</a>
<?php endforeach ?>
		</div>
	</div>
</section>

<section class="pas pas-tmavy">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Umělá inteligence jen tam, kde pomáhá</h2>
			<p>Volitelný asistent v editoru navrhne titulek, perex, štítky nebo popis obrázku a přeloží článek do jiné jazykové verze. Bez vašeho klíče ke Claude API je vypnutý a nic nikam neposílá.</p>
		</div>
		<div>
			<h2>Napojení na Claude přes MCP</h2>
			<p>Claude může na váš pokyn spravovat obsah a vytvářet vlastní šablony. Ke kódu systému, uživatelům ani nastavení serveru se nedostane – hranice je daná v jádře, ne v nastavení.</p>
		</div>
	</div>
</section>

<section class="pas">
	<div class="obal instalace">
		<div>
			<h2>Instalace ve čtyřech krocích</h2>
			<p>Potřebujete hosting s PHP 8.4 a MySQL 8 nebo MariaDB 10.6. Nic dalšího – žádný přístup na příkazovou řádku.</p>
			<p><a class="sipka" href="/cs/dokumentace/zaciname/instalace/">Podrobný návod</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Nahrajte soubory</strong> z balíčku na hosting.</li>
			<li><strong>Otevřete web</strong> – instalátor se spustí sám a zkontroluje server.</li>
			<li><strong>Vyplňte databázi, název webu a účet správce</strong> a vyberte šablonu.</li>
			<li><strong>Přihlaste se do administrace.</strong> Instalátor se po dokončení smaže sám.</li>
		</ol>
	</div>
</section>
