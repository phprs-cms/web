<?php
$stranka['titulek'] = 'Stáhnout a nainstalovat';
$stranka['popis'] = 'Stažení phpRS, požadavky na hosting a instalace ve čtyřech krocích.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Stáhnout a nainstalovat</h1>
		<p class="perex">Jeden ZIP, žádné závislosti. Rozbalíte, nahrajete na hosting a otevřete web v prohlížeči.</p>
	</div>
</section>
<section class="pas">
	<div class="obal stahnout">
		<div class="vydani">
			<p class="vydani-verze">phpRS <strong><?= e($web['verze']) ?></strong></p>
<?php if ($web['stahnout_url'] !== null): ?>
			<p><a class="tl" href="<?= e($web['stahnout_url']) ?>">Stáhnout ZIP</a></p>
<?php if (str_contains($web['verze'], '-')): // předběžná verze (beta, rc) ?>
			<p class="drobne">Jde o <strong>betu</strong>: systém je hotový a testovaný, ale teprve sbírá zkušenosti z ostrého provozu. Zálohujte a chyby prosím hlaste na <a href="https://github.com/phprs-cms/cms/issues" rel="noopener">GitHubu</a>. <a href="https://github.com/phprs-cms/cms/releases" rel="noopener">Všechna vydání a seznam změn</a></p>
<?php else: ?>
			<p class="drobne">Stabilní vydání s bezpečnostními opravami, které se instalují samy. Chyby prosím hlaste na <a href="https://github.com/phprs-cms/cms/issues" rel="noopener">GitHubu</a>. <a href="https://github.com/phprs-cms/cms/releases" rel="noopener">Všechna vydání a seznam změn</a></p>
<?php endif ?>
			<p class="drobne">Balíček je podepsaný. Otisk SHA-256 a podpis najdete u vydání; administrace je při aktualizaci ověřuje sama.</p>
<?php else: ?>
			<p><strong>Veřejná beta se připravuje.</strong> Systém teď běží ve zkušebním provozu; ke stažení bude tady, jakmile ho prověříme na ostrém hostingu.</p>
			<p class="drobne">Balíček bude podepsaný klíčem vydavatele – stejným, kterým administrace ověřuje aktualizace.</p>
<?php endif ?>
<?php if ($web['demo_url'] !== null): ?>
			<p><a class="sipka" href="<?= e($web['demo_url']) ?>" rel="noopener">Vyzkoušet demo</a></p>
<?php endif ?>
		</div>
		<div>
			<h2>Požadavky</h2>
			<div class="tabulka"><table>
				<tbody>
					<tr><th scope="row">PHP</th><td>8.4 nebo novější</td></tr>
					<tr><th scope="row">Databáze</th><td>MySQL 8 nebo MariaDB 10.6 a novější</td></tr>
					<tr><th scope="row">Rozšíření PHP</th><td><code>pdo_mysql</code>, <code>mbstring</code>, <code>gd</code> (zpracování obrázků; instalátor ho nevyžaduje, ale bez něj nejdou nahrávat obrázky)</td></tr>
					<tr><th scope="row">Doporučená rozšíření</th><td><code>zip</code> a <code>sodium</code> (aktualizace z administrace), <code>exif</code>, <code>intl</code>, <code>curl</code>, <code>openssl</code> (Web Push, přihlašovací klíče), <code>zlib</code> a <code>ftp</code> (zálohy)</td></tr>
					<tr><th scope="row">Webový server</th><td>Apache nebo LiteSpeed (pravidla jsou v balíčku); nginx s vlastní konfigurací</td></tr>
				</tbody>
			</table></div>
			<p class="drobne">Běžný sdílený hosting stačí. Nepotřebujete příkazovou řádku, Composer ani Node.js. <a href="/cs/dokumentace/zaciname/pozadavky/">Podrobné požadavky</a></p>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal instalace">
		<div>
			<h2>Instalace</h2>
			<p>Zabere několik minut. Předem si na hostingu založte prázdnou databázi.</p>
			<p><a class="sipka" href="/cs/dokumentace/zaciname/instalace/">Podrobný návod</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Nahrajte obsah balíčku</strong> do složky webu – včetně skrytých souborů <code>.htaccess</code>.</li>
			<li><strong>Otevřete web v prohlížeči.</strong> Instalátor se spustí sám a zkontroluje server.</li>
			<li><strong>Vyplňte údaje k databázi, název webu a účet správce</strong>, zvolte časové pásmo a šablonu.</li>
			<li><strong>Přihlaste se</strong> a projděte První kroky na přehledu. Instalátor se po dokončení smaže sám.</li>
		</ol>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Po instalaci</h2>
			<p>Zapněte HTTPS a dvoufázové přihlášení, nastavte poštu a zálohy mimo server. Stránka <a href="/cs/dokumentace/provoz/stav-systemu/">Stav systému</a> ukáže, co ještě chybí.</p>
		</div>
		<div>
			<h2>Používáte nginx?</h2>
			<p>Nginx nečte soubory <code>.htaccess</code>, které chrání citlivé složky. Bez vlastních pravidel web <strong>neprovozujte</strong> – <a href="/cs/dokumentace/provoz/nginx/">návod a ukázková konfigurace</a>.</p>
		</div>
	</div>
</section>
