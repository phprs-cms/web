<?php
$stranka['titulek'] = 'Bezpečnost';
$stranka['popis'] = 'Jak phpRS chrání weby: podepsané aktualizace, automatické bezpečnostní opravy, kontrola neporušenosti jádra. Jak nahlásit bezpečnostní chybu.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Bezpečnost</h1>
		<p class="perex">Redakční systém je tak bezpečný, jak rychle se na weby dostane oprava. phpRS proto řeší hlavně tohle: aby oprava dorazila sama, a aby nemohl dorazit nikdo jiný.</p>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Nahlášení chyby</h2>
			<p>Bezpečnostní chyby prosíme <strong>nehlaste veřejně</strong>. Použijte soukromé hlášení na GitHubu (<em>Security → Report a vulnerability</em> v repozitáři projektu)<?= $web['email'] !== null ? ' nebo e-mail <a href="mailto:' . e($web['email']) . '">' . e($web['email']) . '</a>' : '' ?>.</p>
			<p>Uveďte verzi phpRS, postup a dopad. Ozveme se do tří pracovních dnů. Opravu běžně vydáváme do 14 dnů, u kritických chyb co nejdříve. Po vydání zveřejníme bezpečnostní oznámení s poděkováním nálezci.</p>
		</div>
		<div>
			<h2>Co se stane potom</h2>
			<ol class="kroky kroky-male">
				<li>Oprava vyjde jako <strong>bezpečnostní vydání</strong>.</li>
				<li>Weby se zapnutou automatikou si ho do 12 hodin <strong>nainstalují samy</strong> – po záloze databáze a ověření podpisu.</li>
				<li>Správce dostane e-mail. Kdo má automatiku vypnutou, uvidí upozornění a aktualizuje jedním tlačítkem.</li>
			</ol>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Podepsané aktualizace</h2>
			<p>Administrace nainstaluje jen balíček, který prokazatelně vydal vydavatel phpRS.</p>
		</div>
		<dl class="funkce">
			<div><dt>Podpis Ed25519</dt><dd>Podepsaná je verze, otisk balíčku i příznak „bezpečnostní“. Nikdo po cestě nemůže z běžného vydání udělat takové, které se nainstaluje samo.</dd></div>
			<div><dt>Klíč není na serveru</dt><dd>Soukromý klíč neopouští počítač vydavatele. Napadení webu phprs.eu ani GitHubu k podvržení aktualizace nestačí.</dd></div>
			<div><dt>Záložní klíč</dt><dd>Systém zná dva veřejné klíče. Druhý je uložený offline a slouží k bezpečné výměně prvního.</dd></div>
			<div><dt>Kontrola neporušenosti</dt><dd>Každé vydání nese podepsaný seznam souborů jádra. Stav systému podle něj hlásí změněné, chybějící i přidané soubory.</dd></div>
		</dl>
	</div>
</section>
<section class="pas">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Výchozí nastavení</h2>
			<p>Bezpečné chování není volba v nastavení. Je zapnuté od instalace.</p>
		</div>
		<dl class="funkce">
			<div><dt>Dvoufázové přihlášení</dt><dd>TOTP se záložními kódy. Stav systému upozorní na administrátora, který ho nemá.</dd></div>
			<div><dt>Ochrana proti hádání hesel</dt><dd>Dočasný zámek účtu i limit na IP adresu – pro redakci i pro čtenáře.</dd></div>
			<div><dt>Content Security Policy</dt><dd>Administrace nespouští žádné vložené ani cizí skripty.</dd></div>
			<div><dt>Nahrané soubory se nespouštějí</dt><dd>Ve složce médií neběží PHP a povolené jsou jen bezpečné typy souborů.</dd></div>
			<div><dt>Žádné cizí plug-iny</dt><dd>Nejčastější cesta k napadení redakčních systémů v phpRS neexistuje.</dd></div>
			<div><dt>Hranice pro AI</dt><dd>Napojení na Claude pracuje s obsahem a vlastními šablonami. Ke kódu, uživatelům a serveru se nedostane.</dd></div>
		</dl>
		<p><a class="sipka" href="/cs/dokumentace/provoz/bezpecnost/">Bezpečnost v dokumentaci: co udělat po instalaci</a></p>
	</div>
</section>
