# Web phprs.eu

Zdrojové soubory webu projektu [phpRS](https://phprs.eu): představení redakčního systému, dokumentace a podpora projektu.

Web je **statický**. Sestavuje ho jeden skript v čistém PHP bez závislostí – stejně jako phpRS sám: žádný Composer, žádné npm, žádný cizí generátor.

## Sestavení

```
php build.php
```

Výstup je ve složce `public/`. Náhled: `php -S 127.0.0.1:8095 -t public`.

Před nasazením spusťte `php tools/kontrola.php` – projde sestavený web a skončí chybou, když najde rozbitý odkaz, chybějící překlad klíče nebo nevalidní kostru stránky.

Dokumentace se nepíše tady. Skript ji při sestavení převezme z repozitáře CMS (`docs/prirucka/<jazyk>/*.md` a `osnova.json`), který čeká ve složce `../phprs3`; jinou cestu určí proměnná `PHPRS_CMS`. Odtud se bere i číslo verze a logo.

## Struktura

| Cesta | Obsah |
| --- | --- |
| `build.php` | generátor |
| `src/web.php` | nastavení: jazyky, seznam stránek, adresy (Sponsors, stažení, demo, e-mail) |
| `src/texty/<jazyk>.php` | texty rozhraní (nabídka, patička, dokumentace) |
| `src/stranky/<jazyk>/*.php` | produktové stránky; `index.php` je úvod |
| `src/sablony/` | kostra stránky a stránka dokumentace |
| `src/Markdown.php` | převodník Markdownu pro příručku (jen to, co příručka používá) |
| `assets/` | `web.css`, `web.js`, `rezim.js` (režim vzhledu: podle systému → světlý → tmavý, volba v `localStorage.rezim`), obrázky, písmo |
| `static/` | soubory kopírované do kořene webu: `.htaccess`, později `aktualizace.json` |
| `tools/nasad.sh` | nasazení na hosting |
| `tools/snimky.sh` | snímky obrazovek z běžící instance CMS |
| `tools/sdileni/` | zdroj obrázku pro sdílení (`karta.html`, `karta.css`) a skript `sestav.sh`, který ho vykreslí |
| `tools/kontrola.php` | kontrola sestaveného webu: HTML, vnitřní odkazy a kotvy, hreflang, sitemap, klíče textů, čeština v en/de, obrázek pro sdílení, stránky 404 |

Hodnota `null` v `src/web.php` znamená „zatím není“ – stránky pak nic neslibují (např. stažení ukazuje „veřejná beta se připravuje“).

## Jazyky

Čeština (zdroj), angličtina a němčina. Soubory stránek se ve všech jazycích jmenují stejně (česky); adresy na webu překládá klíč `adresy` v `src/texty/<kód>.php`, adresy příručky klíč `adresy` v `osnova.json` repozitáře CMS. Každá stránka nese `hreflang` a přepínač jazyků vede na tutéž stránku. Kořen webu přesměruje `static/.htaccess` podle jazyka prohlížeče (cs/sk → čeština, de → němčina, jinak angličtina). Mění-li se český text, upravte i en a de.

## Stránka 404

Každý jazyk má vlastní (`/cs/404.html`, `/en/404.html`, `/de/404.html`), kořenová `/404.html` je anglická. Všechny jsou `noindex`, bez kanonické adresy a přepínač jazyků v nich vede na úvody. Kód 404 nastavuje `ErrorDocument 404 /404.html`; vnitřní požadavek na `/404.html` pak `static/.htaccess` podle původní adresy (`%{THE_REQUEST}`) přepíše na jazykový soubor – mění se jen tělo odpovědi, kód zůstává. Server, který vnitřní požadavek nepřepisuje, pošle anglickou stránku, pořád s kódem 404. Zkouška po nasazení:

```
curl -s -o /dev/null -w '%{http_code}\n' https://phprs.eu/cs/neexistuje        # 404
curl -s https://phprs.eu/cs/neexistuje | grep -o '<html lang="[a-z]*"'          # <html lang="cs"
curl -s https://phprs.eu/de/neexistuje | grep -o '<html lang="[a-z]*"'          # <html lang="de"
curl -s https://phprs.eu/neexistuje | grep -o '<html lang="[a-z]*"'             # <html lang="en"
```

## Obrázek pro sdílení

`assets/img/phprs-sdileni.png` (1200 × 630) je společný všem jazykům, proto má text anglicky. Stránky na něj odkazují přes `og:image` (nastavení `sdileni` v `src/web.php`, alternativní text `sdileni_alt` v textech). Zdrojem je `tools/sdileni/karta.html` a `karta.css`; logo si karta bere ze sestaveného webu a písmo z `assets/fonts/`. Po úpravě:

```
php build.php               # karta potřebuje public/assets/img/phprs-logo-tmavy.svg
tools/sdileni/sestav.sh     # bezhlavý Chrome vykreslí kartu do assets/img/phprs-sdileni.png
php build.php
```

Sociální sítě drží obrázek v cache podle adresy – po výrazné změně pomůže nový název souboru.

## Soubor pro aktualizace CMS

Každá instalace phpRS se ptá na `https://phprs.eu/aktualizace.json`. Soubor vzniká **u vydavatele** nástrojem `tools/vydani.php` v repozitáři CMS a je podepsaný. Sem se jen zkopíruje do `static/aktualizace.json` a commitne – **nikdy se needituje ani neformátuje**, podpis by přestal platit. Dokud neexistuje, adresa vrací 404 a CMS s tím počítá.

## Nasazení

Hosting Blueboard umí nasazení přes Git: obsah větve `production` rozbalí do složky `www`. **Nic přitom nesestavuje** (jeho soubor `.deploy` umí jen `composer install`, `delete` a `url`), proto do větve `production` patří hotový obsah `public/`, ne zdrojové soubory:

```
tools/nasad.sh            # sestaví a připraví větev production, nic neodesílá
tools/nasad.sh --odeslat  # navíc pushne na hosting (remote „blueboard“)
```

Subdomény jsou na Blueboardu sourozenecké složky vedle `www` (`demo` = demo.phprs.eu), nasazení webu se jich netýká.

## Snímky obrazovek

`assets/img/snimky/<jazyk>/` – **každá jazyková verze má vlastní snímky** (administrace v daném jazyce, ukázkový magazín s obsahem v daném jazyce); snímek jiného jazyka se nikdy nepoužije, chybějící se vynechá. Pořizují se z běžící instance CMS skriptem `tools/snimky.sh` (bezhlavý Chrome, světlý i tmavý režim). Ukázkový magazín „Pražský kurýr“ je smyšlený: jména autorů jsou vymyšlená a obrázky článků jsou vlastní ilustrace vytvořené pro tento projekt, takže snímky nenesou žádná cizí práva. Chybějící snímek sestavení nezastaví – stránka se vykreslí bez něj. V en a de zatím chybí snímek Stavu systému (jeho řádky nejsou v CMS přeložené).

## Zásady

- Žádné cookies, analytika, cizí skripty ani písma; přísná CSP v `static/.htaccess`.
- Písmo **Noto Sans** (licence OFL) pro nadpisy i text, hostované u sebe: `assets/fonts/noto-sans-latin-wght-normal.woff2` a `noto-sans-latin-ext-wght-normal.woff2`. Dokud soubory chybí, použije se systémové písmo. Logo má písmo v křivkách a na Noto Sans nezávisí.
- Texty: věcně, krátké věty, vykání. Tvrzení o funkcích se ověřují proti repozitáři CMS.

Licence obsahu a kódu webu: GNU GPL v2, shodně s phpRS.
