#!/bin/sh
# Pořídí snímek obrazovky běžící instance CMS bezhlavým Chromem a uloží ho jako WebP do assets/img/snimky/.
#   tools/snimky.sh jazyk/nazev adresa vyska [tmavy=1] [orez_vyska]     (jazyk = cs, en, de – každá verze webu má vlastní snímky)
# Příklad: tools/snimky.sh cs/sablona-minimal http://localhost:8080/ 1080
#          tools/snimky.sh en/sablona-minimal-tmavy http://localhost:8080/en/ 1080 1
# Snímky administrace vyžadují přihlášení – viz README, oddíl Snímky obrazovek.
set -eu
cd "$(dirname "$0")/.."
CH="/Applications/Google Chrome.app/Contents/MacOS/Google Chrome"
TMP=$(mktemp -d)
TMAVY=""; [ "${4:-0}" = "1" ] && TMAVY="--force-dark-mode"
perl -e 'alarm 40; exec @ARGV' "$CH" --headless=new --disable-gpu --hide-scrollbars $TMAVY --window-size=1440,"$3" --virtual-time-budget=3000 --screenshot="$TMP/s.png" "$2" >/dev/null 2>&1 || true
[ -f "$TMP/s.png" ] || { echo "Snímek $1 se nepodařil."; exit 1; }
mkdir -p "assets/img/snimky/$(dirname "$1")"
if [ -n "${5:-}" ]; then
	cwebp -quiet -q 80 -crop 0 0 1440 "$5" "$TMP/s.png" -o "assets/img/snimky/$1.webp"
else
	cwebp -quiet -q 80 "$TMP/s.png" -o "assets/img/snimky/$1.webp"
fi
rm -rf "$TMP"
echo "ok assets/img/snimky/$1.webp"
