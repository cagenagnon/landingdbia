#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
PARTIAL_BACKEND="$ROOT_DIR/laravel-backend"
FULL_BACKEND="$ROOT_DIR/laravel-backend-full"

require_cmd() {
  if ! command -v "$1" >/dev/null 2>&1; then
    echo "[ERREUR] Commande manquante: $1"
    exit 1
  fi
}

copy_if_exists() {
  local src="$1"
  local dst="$2"

  if [ -e "$src" ]; then
    mkdir -p "$(dirname "$dst")"
    cp -R "$src" "$dst"
    echo "[OK] Copie: $src -> $dst"
  else
    echo "[INFO] Introuvable, ignore: $src"
  fi
}

copy_dir_contents_if_exists() {
  local src="$1"
  local dst="$2"

  if [ -d "$src" ]; then
    mkdir -p "$dst"
    cp -R "$src"/. "$dst"/
    echo "[OK] Copie contenu: $src -> $dst"
  else
    echo "[INFO] Introuvable, ignore: $src"
  fi
}

require_cmd php
require_cmd composer
require_cmd npm

if [ ! -d "$PARTIAL_BACKEND" ]; then
  echo "[ERREUR] Backend partiel introuvable: $PARTIAL_BACKEND"
  exit 1
fi

if [ -d "$FULL_BACKEND" ]; then
  echo "[ERREUR] Dossier deja present: $FULL_BACKEND"
  echo "Supprime-le ou renomme-le avant de relancer."
  exit 1
fi

echo "[1/5] Creation du projet Laravel complet..."
composer create-project laravel/laravel "$FULL_BACKEND"

echo "[2/5] Copie du code metier depuis backend partiel..."
copy_dir_contents_if_exists "$PARTIAL_BACKEND/app/Http/Controllers" "$FULL_BACKEND/app/Http/Controllers"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/app/Http/Requests" "$FULL_BACKEND/app/Http/Requests"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/app/Models" "$FULL_BACKEND/app/Models"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/app/Mail" "$FULL_BACKEND/app/Mail"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/app/Services" "$FULL_BACKEND/app/Services"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/database/migrations" "$FULL_BACKEND/database/migrations"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/resources/views/emails" "$FULL_BACKEND/resources/views/emails"
copy_dir_contents_if_exists "$PARTIAL_BACKEND/resources/views/admin" "$FULL_BACKEND/resources/views/admin"
copy_if_exists "$PARTIAL_BACKEND/routes/api.php" "$FULL_BACKEND/routes/api.php"
copy_if_exists "$PARTIAL_BACKEND/routes/web.php" "$FULL_BACKEND/routes/web.php"

echo "[3/5] Configuration environnement Laravel..."
cd "$FULL_BACKEND"
cp .env.example .env
php artisan key:generate

echo "[4/5] Migration base de donnees..."
php artisan migrate

echo "[5/5] Installation des dependances frontend Laravel (Vite)..."
npm install

echo "[TERMINE] Stack backend Laravel pret."
echo "Tu peux lancer le backend avec:"
echo "  cd $FULL_BACKEND && php artisan serve"
echo ""
echo "Tu peux lancer Vite avec:"
echo "  cd $FULL_BACKEND && npm run dev"
echo ""
echo "Si ton frontend tourne sur un autre port, pense a configurer CORS dans config/cors.php."
