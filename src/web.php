<?php
/**
 * Nastavení webu. Hodnoty null znamenají „zatím není“ – stránky s tím počítají a nic neslibují.
 */

return [
    'adresa' => 'https://phprs.eu',
    'verze' => '3.0.0-beta.1',          // při sestavení se přepíše verzí z repozitáře CMS
    'jazyky' => ['cs' => 'Čeština', 'en' => 'English', 'de' => 'Deutsch'],
    'vychozi_jazyk' => 'en',            // kořen webu a x-default; podle jazyka prohlížeče přesměruje static/.htaccess
    'og_locale' => ['cs' => 'cs_CZ', 'en' => 'en_GB', 'de' => 'de_DE'],
    // obrázek pro sdílení (og:image), společný všem jazykům; zdroj a postup v tools/sdileni/
    'sdileni' => ['soubor' => '/assets/img/phprs-sdileni.png', 'sirka' => 1200, 'vyska' => 630],
    // adresy produktových stránek ('' = úvod); soubor src/stranky/<jazyk>/<adresa>.php
    'stranky' => ['', 'funkce', 'sablony', 'stahnout', 'podporit', 'bezpecnost', 'o-projektu', 'soukromi'],
    'sponsors' => 'https://github.com/sponsors/phprscms',
    'github' => 'https://github.com/phprs-cms',
    // adresa ZIPu posledního vydání; %s nahradí sestavení číslem verze z repozitáře CMS; null = veřejná beta se připravuje
    'stahnout_url' => 'https://github.com/phprs-cms/cms/releases/download/v%s/phprs-%s.zip',
    'demo_url' => 'https://demo.phprs.eu',
    'email' => 'info@phprs.eu',
];
