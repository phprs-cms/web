#!/bin/sh
# Nasazení na Blueboard přes Git: hosting nic nesestavuje, do složky www jen rozbalí větev "production".
# Proto se web sestaví tady a do větve production jde HOTOVÝ obsah složky public/ (ne zdrojové soubory).
#
#   tools/nasad.sh             sestaví web a připraví commit ve větvi production (nic neodesílá)
#   tools/nasad.sh --odeslat   navíc pushne do vzdáleného repozitáře "blueboard"
#
# Vzdálený repozitář se přidává jednou, adresu ukáže administrace Blueboardu po aktivaci Gitu:
#   git remote add blueboard ssh://…
set -eu
cd "$(dirname "$0")/.."

[ -z "$(git status --porcelain)" ] || { echo "Pracovní strom není čistý – nejdřív commitněte změny."; exit 1; }
php build.php
[ -f static/aktualizace.json ] || echo "Pozn.: static/aktualizace.json zatím neexistuje – adresa aktualizací bude vracet 404 (CMS s tím počítá)."

ZDROJ=$(git rev-parse --short HEAD)
PRACE=$(mktemp -d)
trap 'git worktree remove --force "$PRACE" 2>/dev/null || true' EXIT
if git show-ref --quiet refs/heads/production; then
	git worktree add -q "$PRACE" production
else
	git worktree add -q --detach "$PRACE"
	git -C "$PRACE" checkout -q --orphan production
fi
git -C "$PRACE" rm -rq --ignore-unmatch . >/dev/null 2>&1 || true
find "$PRACE" -mindepth 1 -maxdepth 1 ! -name .git -exec rm -rf {} +
cp -R public/. "$PRACE"/
git -C "$PRACE" add -A
if git -C "$PRACE" diff --cached --quiet; then
	echo "Žádná změna k nasazení."
else
	git -C "$PRACE" commit -q -m "Nasazení ze zdroje $ZDROJ"
	echo "Větev production připravena (zdroj $ZDROJ)."
fi

if [ "${1:-}" = "--odeslat" ]; then
	git push blueboard production
	echo "Odesláno na hosting."
else
	echo "Neodesláno. K nasazení spusťte: tools/nasad.sh --odeslat"
fi
