<?php
$stranka['titulek'] = 'Download and install';
$stranka['popis'] = 'Downloading phpRS, hosting requirements and installation in four steps.';
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Download and install</h1>
		<p class="perex">One ZIP, no dependencies. You unpack it, upload it to your hosting and open the site in a browser.</p>
	</div>
</section>
<section class="pas">
	<div class="obal stahnout">
		<div class="vydani">
			<p class="vydani-verze">phpRS <strong><?= e($web['verze']) ?></strong></p>
<?php if ($web['stahnout_url'] !== null): ?>
			<p><a class="tl" href="<?= e($web['stahnout_url']) ?>">Download ZIP</a></p>
			<p class="drobne">This is a <strong>beta</strong>: the system is complete and tested, but is only now gathering experience from production use. Keep backups and please report bugs on <a href="https://github.com/phprs-cms/cms/issues" rel="noopener">GitHub</a>. <a href="https://github.com/phprs-cms/cms/releases" rel="noopener">All releases and the change log</a></p>
			<p class="drobne">The package is signed. The SHA-256 checksum and the signature are listed with the release; the administration verifies them by itself during an update.</p>
<?php else: ?>
			<p><strong>The public beta is being prepared.</strong> The system is now running in a trial operation; it will be available for download here once we have tested it on production hosting.</p>
			<p class="drobne">The package will be signed with the publisher's key – the same one the administration uses to verify updates.</p>
<?php endif ?>
<?php if ($web['demo_url'] !== null): ?>
			<p><a class="sipka" href="<?= e($web['demo_url']) ?>" rel="noopener">Try the demo</a></p>
<?php endif ?>
		</div>
		<div>
			<h2>Requirements</h2>
			<div class="tabulka"><table>
				<tbody>
					<tr><th scope="row">PHP</th><td>8.4 or newer</td></tr>
					<tr><th scope="row">Database</th><td>MySQL 8 or MariaDB 10.6 and newer</td></tr>
					<tr><th scope="row">PHP extensions</th><td><code>pdo_mysql</code>, <code>mbstring</code>, <code>gd</code> (image processing)</td></tr>
					<tr><th scope="row">Recommended extensions</th><td><code>zip</code> and <code>sodium</code> (updates from the administration), <code>exif</code>, <code>intl</code>, <code>curl</code></td></tr>
					<tr><th scope="row">Web server</th><td>Apache or LiteSpeed (the rules are in the package); nginx with your own configuration</td></tr>
				</tbody>
			</table></div>
			<p class="drobne">Ordinary shared hosting is enough. You do not need a command line, Composer or Node.js. <a href="/en/docs/getting-started/requirements/">Detailed requirements</a></p>
		</div>
	</div>
</section>
<section class="pas pas-plocha">
	<div class="obal instalace">
		<div>
			<h2>Installation</h2>
			<p>It takes a few minutes. Create an empty database on your hosting beforehand.</p>
			<p><a class="sipka" href="/en/docs/getting-started/installation/">Detailed guide</a></p>
		</div>
		<ol class="kroky">
			<li><strong>Upload the contents of the package</strong> to the site folder – including the hidden <code>.htaccess</code> files.</li>
			<li><strong>Open the site in a browser.</strong> The installer starts by itself and checks the server.</li>
			<li><strong>Fill in the database details, the site name and the administrator account</strong>, choose a time zone and a template.</li>
			<li><strong>Log in</strong> and go through First steps on the dashboard. The installer deletes itself when it finishes.</li>
		</ol>
	</div>
</section>
<section class="pas">
	<div class="obal dvoji dvoji-text">
		<div>
			<h2>After installation</h2>
			<p>Turn on HTTPS and two-factor login, set up mail and off-server backups. The <a href="/en/docs/operations/system-status/">System status</a> page shows what is still missing.</p>
		</div>
		<div>
			<h2>Do you use nginx?</h2>
			<p>Nginx does not read the <code>.htaccess</code> files that protect sensitive folders. <strong>Do not run</strong> the site without your own rules – <a href="/en/docs/operations/nginx/">guide and sample configuration</a>.</p>
		</div>
	</div>
</section>
