<?php
$stranka['titulek'] = 'Security';
$stranka['popis'] = 'How phpRS protects websites: signed updates, automatic security fixes, a core integrity check. How to report a security vulnerability.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Security</h1>
		<p class="perex">A content management system is as secure as the speed at which a fix reaches the sites. So phpRS focuses mainly on this: that the fix arrives by itself, and that nobody else can arrive in its place.</p>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>Reporting a vulnerability</h2>
			<p>Please <strong>do not report</strong> security vulnerabilities <strong>publicly</strong>. Use private reporting on GitHub (<em>Security → Report a vulnerability</em> in the project repository)<?= $web['email'] !== null ? ' or e-mail <a href="mailto:' . e($web['email']) . '">' . e($web['email']) . '</a>' : '' ?>.</p>
			<p>Include the phpRS version, the steps to reproduce and the impact. We reply within three working days. We usually release a fix within 14 days, and as soon as possible for critical vulnerabilities. After the release we publish a security advisory with thanks to the reporter.</p>
		</div>
		<div>
			<h2>What happens next</h2>
			<ol class="kroky kroky-male">
				<li>The fix comes out as a <strong>security release</strong>.</li>
				<li>Sites with automatic updates switched on <strong>install it themselves</strong> within 12 hours – after a database backup and signature verification. If the server cannot do it (no <code>zip</code> or <code>sodium</code>, files not writable), the administrator at least gets an e-mail.</li>
				<li>The administrator gets an e-mail. Those who have automatic updates switched off see a notice and update with one button.</li>
			</ol>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Signed updates</h2>
			<p>The administration installs only a package that was verifiably released by the publisher of phpRS.</p>
		</div>
		<dl class="funkce">
			<div><dt>Ed25519 signature</dt><dd>The version, the package checksum and the “security” flag are all signed. Nobody along the way can turn an ordinary release into one that installs itself.</dd></div>
			<div><dt>The key is not on a server</dt><dd>The private key never leaves the publisher's computer. Compromising the phprs.eu website or GitHub is not enough to forge an update.</dd></div>
			<div><dt>Backup key</dt><dd>The system knows two public keys. The second is stored offline and is used to replace the first one safely.</dd></div>
			<div><dt>Integrity check</dt><dd>Every release carries a signed list of core files. System status uses it to report changed, missing and added files.</dd></div>
		</dl>
	</div>
</section>
<section class="pas">
	<div class="obal">
		<div class="skupina-hlava">
			<h2>Default settings</h2>
			<p>Secure behaviour is not an option in the settings. It is on from the moment of installation – only two-factor login is switched on by each account, and System status keeps reminding you.</p>
		</div>
		<dl class="funkce">
			<div><dt>Two-factor login</dt><dd>TOTP with backup codes. System status points out any administrator who does not have it.</dd></div>
			<div><dt>Protection against password guessing</dt><dd>A temporary account lock and a limit per IP address – for the editorial team and for readers.</dd></div>
			<div><dt>Content Security Policy</dt><dd>The administration runs no inline and no third-party scripts.</dd></div>
			<div><dt>Uploaded files are not executed</dt><dd>PHP does not run in the media folder, and only safe file types are allowed.</dd></div>
			<div><dt>No third-party plug-ins</dt><dd>The most common way content management systems get compromised does not exist in phpRS.</dd></div>
			<div><dt>Boundaries for AI</dt><dd>The connection to Claude works with content and custom templates. It has no access to the code, the users or the server.</dd></div>
		</dl>
		<p><a class="sipka" href="/en/docs/operations/security/">Security in the documentation: what to do after installation</a></p>
	</div>
</section>
