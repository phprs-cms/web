<?php
$stranka['titulek'] = 'Features';
$stranka['popis'] = 'What phpRS can do: editor and content types, editorial workflow, templates and blocks, readers and revenue, SEO, language versions, AI assistant and secure operation.';

$skupiny = [
    ['psani', 'Writing', 'An editor that stays out of the way, and content types that a magazine really uses.', 'snimky/admin-editor', 'Article editor', [
        'WYSIWYG editor with no third-party libraries' => 'Headings, quotes, tables, photo galleries, attachments. Clean output, no clutter in the HTML.',
        'Video and social media posts from a plain URL' => 'You paste a link, the system does the rest. Third-party content loads for the reader only after a click.',
        'Revisions and version comparison' => 'Every save is a revision. You see the differences side by side and can restore any version.',
        'Drafts are saved continuously' => 'In the browser and on the server. A lock makes sure two people do not edit one article at the same time.',
        'Article templates and content types' => 'Long read, Photo story, Interview; live coverage, review with a rating, podcast.',
        'Scheduled publishing' => 'The article goes out at the set time – in the time zone of the site, not of the server.',
    ]],
    ['redakce', 'Newsroom', 'From a single author to an editorial team with a proofreader and a front page editor.', 'snimky/admin-prehled', 'Admin dashboard', [
        'Roles and permissions' => 'Author, editor, administrator. The right to publish is separate. Access can be limited to selected sections.',
        'Handover for proofreading' => 'Draft → for proofreading → approved → published. Handovers and returns are announced by e-mail.',
        'Editorial calendar and front page' => 'What goes out when and what is at the top of the site – in one place.',
        'Editing directly on the site' => 'You fix a typo on the page where you found it. This works for articles and pages.',
        'Command palette' => 'Ctrl/⌘+K: find an article, start a new one, jump to the settings. No clicking through menus.',
        'Bulk actions and audit log' => 'Move, publish or delete several articles at once. Important changes are logged.',
    ]],
    ['vzhled', 'Appearance', 'Three templates, a site identity and a layout that you put together directly on the page.', 'snimky/web-bloky', 'Visual block editor', [
        'Three built-in templates' => 'Classic Newspaper, Modern Magazine and Minimal.',
        'Site identity' => 'Logo, colour and fonts are set once and the templates take them over.',
        'Dark mode' => 'In all templates and in the administration. It follows the reader\'s system and can be switched.',
        'Visual block editor' => 'You drag columns and blocks on the live page – you see the same thing as the reader.',
        'Custom template' => 'Plain PHP and CSS in one folder. The system checks the template before it is switched on.',
        'Images without layout shifts' => 'Dimensions, WebP variants and the placeholder colour are filled in automatically.',
    ]],
    ['ctenari', 'Readers and revenue', 'Tools a magazine uses to build its audience and pay for its operation.', null, '', [
        'Comments with moderation' => 'Antispam without cookies and without third-party services.',
        'Registration without a password' => 'The reader logs in with a link from an e-mail. Saved articles, newsletter subscription, comments under their own account.',
        'Locked content and a soft paywall' => 'Part of the content only for logged-in readers or subscribers; a few locked articles per month can be free.',
        'Newsletter' => 'Manual and automatic selection of new articles, separately for each language of the site. A queue with retries.',
        'Web Push' => 'Browser notifications about new articles, with no third-party service.',
        'Advertising system' => 'Positions, targeting by section, timed campaigns and a report of impressions and clicks.',
    ]],
    ['seo', 'SEO and AI search', 'So that both people and machines find the article – and so that you control what machines are allowed to do.', null, '', [
        'Structured data' => 'Schema.org for articles, reviews, podcasts, breadcrumbs and the author.',
        'Sitemap, RSS and JSON Feed' => 'Generated automatically, including language versions.',
        'IndexNow' => 'Search engines learn about a new article right away.',
        'llms.txt and Markdown versions of articles' => 'Clean text for language models, if you want that.',
        'AI crawler control' => 'You decide which bots you let in – in the settings, not by editing robots.txt by hand.',
    ]],
    ['jazyky', 'Languages', 'A multilingual site and a multilingual editorial team.', null, '', [
        'Language versions of the site' => 'Czech, Slovak, English, German – with hreflang and linked translations.',
        'Administration in four languages' => 'Each user chooses their own. So does the installer.',
        'E-mails in the language of the recipient' => 'Newsletters and system messages.',
        'Site time zone' => 'Independent of the server settings.',
    ]],
    ['ai', 'AI – optional', 'Switched off until you enter your own key. Nothing is sent anywhere without your knowledge.', null, '', [
        'Assistant in the editor' => 'Headlines, standfirst, summary, tags, proofreading, image descriptions, article translation. Through the Claude API.',
        'Connection to Claude (MCP)' => 'Claude manages content and writes custom templates. It cannot touch the system code, the users or the server.',
    ]],
    ['provoz', 'Operation and security', 'Things you appreciate only when something goes wrong. Here they are ready in advance.', 'snimky/admin-stav', 'System status', [
        'Import from WordPress and site export' => 'Bring over articles, sections, tags, pages, comments and images from a WordPress export; old addresses are redirected. And you can take all your content away in an open format at any time.',
        'Signed updates' => 'One button, an Ed25519 signature. Security releases install themselves.',
        'Backups, also off the server' => 'Weekly and before every update; a copy to FTP or S3. Restore from the administration.',
        'System status' => 'Server, database, permissions, security, mail, cron – with advice on what to fix. Also as JSON for monitoring.',
        'Two-factor login' => 'TOTP with backup codes, or a passkey (fingerprint, Face ID). The account is locked after repeated failures.',
        'Core integrity check' => 'Files are compared with the signed file list of the release.',
        'Mail over SMTP with a queue' => 'Undelivered messages are retried; an overview of recent messages.',
    ]],
];
?>
<section class="zahlavi">
	<div class="obal">
		<h1>Features</h1>
		<p class="perex">Everything below is part of one package. Nothing is bought separately and nothing is installed afterwards – the less used parts are simply switched on in the settings as extensions.</p>
		<nav class="kotvy" aria-label="Feature groups">
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
<?php if ($snimek !== null && ($img = obrazek("$snimek.webp", $alt, 'jen-svetly') . obrazek("$snimek-tmavy.webp", "$alt – dark mode", 'jen-tmavy')) !== ''): ?>
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
