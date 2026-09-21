#!/bin/sh
# Obrázek pro sdílení (og:image): vykreslí tools/sdileni/karta.html bezhlavým Chromem do assets/img/phprs-sdileni.png.
# Před spuštěním: php build.php (karta si bere logo z public/assets/img). Po spuštění znovu php build.php.
#   tools/sdileni/sestav.sh
set -eu

KOREN="$(cd "$(dirname "$0")/../.." && pwd)"
CHROME="${CHROME:-/Applications/Google Chrome.app/Contents/MacOS/Google Chrome}"
CIL="$KOREN/assets/img/phprs-sdileni.png"
DOCASNY="$(mktemp -d)"
trap 'rm -rf "$DOCASNY"' EXIT

[ -f "$KOREN/public/assets/img/phprs-logo-tmavy.svg" ] || { echo "Chybí public/assets/img/phprs-logo-tmavy.svg – nejdřív php build.php." >&2; exit 1; }

# adresa file:// nesnese mezery (složka iCloudu je má)
ADRESA="file://$(printf '%s' "$KOREN/tools/sdileni/karta.html" | sed 's/ /%20/g')"

# bezhlavý Chrome se po snímku často sám neukončí: běží na pozadí nejvýš 40 s (alarm) a končí, jakmile je snímek zapsaný
perl -e 'alarm 40; exec @ARGV' "$CHROME" --headless=new --disable-gpu --hide-scrollbars --allow-file-access-from-files \
	--force-device-scale-factor=1 --window-size=1200,630 --virtual-time-budget=3000 \
	--user-data-dir="$DOCASNY/profil" --screenshot="$DOCASNY/karta.png" "$ADRESA" >/dev/null 2>&1 &
CHROME_PID=$!
CEKANI=0
while [ "$CEKANI" -lt 40 ] && kill -0 "$CHROME_PID" 2>/dev/null; do
	if [ -s "$DOCASNY/karta.png" ]; then
		sleep 1 # dopsání souboru
		break
	fi
	sleep 1
	CEKANI=$((CEKANI + 1))
done
kill "$CHROME_PID" 2>/dev/null || true
wait "$CHROME_PID" 2>/dev/null || true

[ -s "$DOCASNY/karta.png" ] || { echo "Chrome snímek nevytvořil." >&2; exit 1; }
ROZMERY="$(sips -g pixelWidth -g pixelHeight "$DOCASNY/karta.png" | awk '/pixel/ {printf "%s ", $2}')"
[ "$ROZMERY" = "1200 630 " ] || { echo "Snímek má rozměry $ROZMERY, čekal jsem 1200 630." >&2; exit 1; }

cp "$DOCASNY/karta.png" "$CIL"
echo "Hotovo: assets/img/phprs-sdileni.png ($(wc -c < "$CIL" | tr -d ' ') bajtů)"
