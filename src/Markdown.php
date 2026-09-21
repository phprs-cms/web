<?php
/**
 * Malý převodník Markdownu pro příručku phpRS.
 *
 * Umí jen to, co příručka používá: nadpisy, odstavce, seznamy (i vnořené a s bloky uvnitř položky),
 * tabulky, citace (vykreslené jako poznámka), bloky kódu a řádkové formátování. Žádné HTML ve zdroji –
 * všechno se escapuje.
 */

declare(strict_types=1);

final class Markdown
{
    public string $titulek = '';

    /** @var list<array{id:string,text:string}> nadpisy druhé úrovně pro obsah stránky */
    public array $nadpisy = [];

    /** @var list<array{nadpis:string,id:string,text:string}> text po oddílech pro hledání */
    public array $oddily = [];

    /** @var array<string,int> */
    private array $pouzitaId = [];

    /** @param \Closure(string):string $odkaz přepis cílů odkazů (relativní .md -> adresa na webu) */
    public function __construct(private readonly \Closure $odkaz)
    {
    }

    public function preved(string $text): string
    {
        $text = str_replace(["\r\n", "\r", "\t"], ["\n", "\n", '    '], $text);
        $this->oddily = [['nadpis' => '', 'id' => '', 'text' => '']];

        return $this->bloky(explode("\n", $text), true);
    }

    /** @param list<string> $radky */
    private function bloky(array $radky, bool $vrchni = false): string
    {
        $html = '';
        $n = count($radky);
        for ($i = 0; $i < $n;) {
            $radek = $radky[$i];
            if (trim($radek) === '') {
                $i++;
                continue;
            }
            // blok kódu
            if (preg_match('/^```\s*(\w*)\s*$/', $radek, $m)) {
                $kod = [];
                for ($i++; $i < $n && !preg_match('/^```\s*$/', $radky[$i]); $i++) {
                    $kod[] = $radky[$i];
                }
                $i++;
                $html .= '<pre><code' . ($m[1] !== '' ? ' class="jazyk-' . $m[1] . '"' : '') . '>' . htmlspecialchars(implode("\n", $kod), ENT_NOQUOTES) . "</code></pre>\n";
                continue;
            }
            // nadpis
            if (preg_match('/^(#{1,6})\s+(.+?)\s*#*$/', $radek, $m)) {
                $i++;
                $uroven = strlen($m[1]);
                $cisty = trim(strip_tags($this->radkove($m[2])));
                if ($uroven === 1 && $vrchni && $this->titulek === '') {
                    $this->titulek = html_entity_decode($cisty, ENT_QUOTES);
                    continue;
                }
                $id = $this->id($cisty);
                if ($vrchni && $uroven === 2) {
                    $this->nadpisy[] = ['id' => $id, 'text' => html_entity_decode($cisty, ENT_QUOTES)];
                    $this->oddily[] = ['nadpis' => html_entity_decode($cisty, ENT_QUOTES), 'id' => $id, 'text' => ''];
                }
                $html .= "<h$uroven id=\"$id\">" . $this->radkove($m[2]) . "</h$uroven>\n";
                continue;
            }
            // tabulka
            if (str_starts_with(ltrim($radek), '|') && isset($radky[$i + 1]) && preg_match('/^\s*\|?\s*:?-{2,}/', $radky[$i + 1])) {
                $hlavicka = $this->bunky($radek);
                $html .= '<div class="tabulka"><table><thead><tr>';
                foreach ($hlavicka as $b) {
                    $html .= '<th>' . $this->radkove($b) . '</th>';
                }
                $html .= "</tr></thead><tbody>\n";
                for ($i += 2; $i < $n && str_starts_with(ltrim($radky[$i]), '|'); $i++) {
                    $html .= '<tr>';
                    foreach ($this->bunky($radky[$i]) as $b) {
                        $html .= '<td>' . $this->radkove($b) . '</td>';
                        $this->doHledani($b);
                    }
                    $html .= "</tr>\n";
                }
                $html .= "</tbody></table></div>\n";
                continue;
            }
            // citace = poznámka
            if (str_starts_with($radek, '>')) {
                $uvnitr = [];
                for (; $i < $n && str_starts_with($radky[$i], '>'); $i++) {
                    $uvnitr[] = (string) preg_replace('/^>\s?/', '', $radky[$i]);
                }
                $html .= '<aside class="poznamka">' . $this->bloky($uvnitr) . "</aside>\n";
                continue;
            }
            // seznam
            if (preg_match('/^([-*]|\d+\.)\s+/', $radek, $m)) {
                $cislovany = ctype_digit($m[1][0]);
                $vzor = $cislovany ? '/^\d+\.\s+/' : '/^[-*]\s+/';
                $polozky = [];
                $volny = false;
                while ($i < $n && preg_match($vzor, $radky[$i], $mm)) {
                    $odsazeni = strlen($mm[0]);
                    $polozka = [substr($radky[$i], $odsazeni)];
                    for ($i++; $i < $n; $i++) {
                        if (trim($radky[$i]) === '') {
                            // prázdný řádek patří k položce jen tehdy, když po něm následuje odsazený text
                            $dalsi = $radky[$i + 1] ?? '';
                            if (preg_match('/^ {2,}\S/', $dalsi)) {
                                $polozka[] = '';
                                $volny = true;
                                continue;
                            }
                            break;
                        }
                        if (!preg_match('/^ {2,}/', $radky[$i])) {
                            break;
                        }
                        $polozka[] = (string) preg_replace('/^ {1,' . $odsazeni . '}/', '', $radky[$i]);
                    }
                    $polozky[] = $polozka;
                    // prázdné řádky mezi položkami téhož seznamu
                    $j = $i;
                    while ($j < $n && trim($radky[$j]) === '') {
                        $j++;
                    }
                    if ($j < $n && $j > $i && preg_match($vzor, $radky[$j])) {
                        $i = $j;
                    }
                }
                $html .= $cislovany ? "<ol>\n" : "<ul>\n";
                foreach ($polozky as $polozka) {
                    $obsah = $this->bloky($polozka);
                    if (!$volny || !in_array('', $polozka, true)) {
                        $obsah = (string) preg_replace('#^<p>(.*?)</p>\n#s', '$1', $obsah, 1);
                    }
                    $html .= '<li>' . trim($obsah) . "</li>\n";
                }
                $html .= $cislovany ? "</ol>\n" : "</ul>\n";
                continue;
            }
            // odstavec
            $odstavec = [];
            for (; $i < $n && trim($radky[$i]) !== '' && !preg_match('/^(#{1,6}\s|```|>|([-*]|\d+\.)\s+|\s*\|)/', $radky[$i]); $i++) {
                $odstavec[] = trim($radky[$i]);
            }
            if ($odstavec === []) {
                // řádek, který vypadá jako začátek bloku, ale žádný blok ho nepřevzal
                $odstavec[] = trim($radky[$i++]);
            }
            $this->doHledani(implode(' ', $odstavec));
            $html .= '<p>' . $this->radkove(implode("\n", $odstavec)) . "</p>\n";
        }

        return $html;
    }

    /** @return list<string> */
    private function bunky(string $radek): array
    {
        $radek = trim($radek);
        $radek = trim($radek, '|');

        return array_map('trim', preg_split('/(?<!\\\\)\|/', $radek) ?: []);
    }

    private function radkove(string $text): string
    {
        $kody = [];
        $text = (string) preg_replace_callback('/`([^`]+)`/', static function (array $m) use (&$kody): string {
            $kody[] = '<code>' . htmlspecialchars($m[1], ENT_NOQUOTES) . '</code>';

            return "\x02" . (count($kody) - 1) . "\x03";
        }, $text);
        $text = htmlspecialchars($text, ENT_NOQUOTES);
        $text = (string) preg_replace_callback('/\[([^\]]+)\]\(([^)\s]+)\)/', function (array $m): string {
            $cil = ($this->odkaz)(html_entity_decode($m[2], ENT_QUOTES));
            $vnejsi = (bool) preg_match('#^https?:#', $cil);

            return '<a href="' . htmlspecialchars($cil, ENT_QUOTES) . '"' . ($vnejsi ? ' rel="noopener"' : '') . '>' . $m[1] . '</a>';
        }, $text);
        $text = (string) preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
        $text = (string) preg_replace('/(?<![\w*])\*(?!\s)(.+?)(?<!\s)\*(?![\w*])/s', '<em>$1</em>', $text);
        // nezlomitelná mezera za jednopísmennými předložkami a spojkami
        $text = (string) preg_replace('/(?<=^|[\s(>])([KkSsVvZzOoUuAaIi]) (?=\S)/u', "$1\u{00A0}", $text);

        return (string) preg_replace_callback('/\x02(\d+)\x03/', static fn (array $m): string => $kody[(int) $m[1]], $text);
    }

    private function doHledani(string $text): void
    {
        $text = (string) preg_replace('/\[([^\]]+)\]\([^)]+\)/', '$1', $text);
        $text = str_replace(['**', '`'], '', $text);
        $posledni = count($this->oddily) - 1;
        $this->oddily[$posledni]['text'] = trim($this->oddily[$posledni]['text'] . ' ' . $text);
    }

    private function id(string $text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES);
        $text = strtr(mb_strtolower($text), [
            'á' => 'a', 'ä' => 'a', 'č' => 'c', 'ď' => 'd', 'é' => 'e', 'ě' => 'e', 'í' => 'i', 'ľ' => 'l', 'ĺ' => 'l', 'ň' => 'n',
            'ó' => 'o', 'ô' => 'o', 'ö' => 'o', 'ř' => 'r', 'ŕ' => 'r', 'š' => 's', 'ť' => 't', 'ú' => 'u', 'ů' => 'u', 'ü' => 'u',
            'ý' => 'y', 'ž' => 'z', 'ß' => 'ss',
        ]);
        $id = trim((string) preg_replace('/[^a-z0-9]+/', '-', $text), '-') ?: 'oddil';
        $this->pouzitaId[$id] = ($this->pouzitaId[$id] ?? 0) + 1;

        return $this->pouzitaId[$id] > 1 ? $id . '-' . $this->pouzitaId[$id] : $id;
    }
}
