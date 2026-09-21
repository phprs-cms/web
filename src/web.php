<?php
/**
 * Nastavení webu. Hodnoty null znamenají „zatím není“ – stránky s tím počítají a nic neslibují.
 */

return [
    'adresa' => 'https://phprs.eu',
    'verze' => '3.0.0-beta.1',          // při sestavení se přepíše verzí z repozitáře CMS
    'jazyky' => ['cs' => 'Čeština'],    // en a de přibudou po schválení českých textů
    'vychozi_jazyk' => 'cs',
    // adresy produktových stránek ('' = úvod); soubor src/stranky/<jazyk>/<adresa>.php
    'stranky' => ['', 'funkce', 'sablony', 'stahnout', 'podporit', 'bezpecnost', 'o-projektu', 'soukromi'],
    'sponsors' => 'https://github.com/sponsors/phprscms',
    'github' => 'https://github.com/phprs-cms',
    'stahnout_url' => null,             // adresa ZIPu posledního vydání; null = veřejná beta se připravuje
    'demo_url' => null,                 // https://demo.phprs.eu, až poběží
    'email' => null,                    // kontaktní e-mail projektu
];
