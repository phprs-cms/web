<?php
/**
 * Nastavení webu. Hodnoty null znamenají „zatím není“ – stránky s tím počítají a nic neslibují.
 */

return [
    'adresa' => 'https://phprs.eu',
    'verze' => '3.0.0-beta.1',          // při sestavení se přepíše verzí z repozitáře CMS
    'jazyky' => ['cs' => 'Čeština', 'en' => 'English', 'de' => 'Deutsch'],
    'vychozi_jazyk' => 'en',            // kořen webu a x-default; podle jazyka prohlížeče přesměruje static/.htaccess
    // adresy produktových stránek ('' = úvod); soubor src/stranky/<jazyk>/<adresa>.php
    'stranky' => ['', 'funkce', 'sablony', 'stahnout', 'podporit', 'bezpecnost', 'o-projektu', 'soukromi'],
    'sponsors' => 'https://github.com/sponsors/phprscms',
    'github' => 'https://github.com/phprs-cms',
    'stahnout_url' => 'https://github.com/phprs-cms/cms/releases/download/v3.0.0-beta.3/phprs-3.0.0-beta.3.zip', // ZIP posledního vydání; null = veřejná beta se připravuje
    'demo_url' => 'https://demo.phprs.eu',
    'email' => 'info@phprs.eu',
];
