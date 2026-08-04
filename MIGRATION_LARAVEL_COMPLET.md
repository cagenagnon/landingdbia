# Migration vers un Laravel complet

Ce depot contient actuellement un backend Laravel partiel (sans `composer.json`, sans `artisan`, sans bootstrap complet).

## Objectif

Creer un projet Laravel complet, puis y reinjecter le code metier deja implemente dans ce workspace.

## 1) Prerequis locaux

Verifier que ces commandes existent sur ta machine:

- `php -v`
- `composer -V`
- `node -v`
- `npm -v`

Si `composer` est absent, installe-le via la methode officielle Composer (pas via ce workspace).

## 2) Creer un projet Laravel complet

Depuis la racine du workspace:

```bash
cd /home/enagnon/Downloads/landingpagedbia
composer create-project laravel/laravel laravel-backend-full
```

## 3) Injecter le code metier existant

Copier les dossiers/fichiers suivants depuis `laravel-backend/` vers `laravel-backend-full/`:

- `app/Http/Controllers/`
- `app/Http/Requests/`
- `app/Models/`
- `app/Mail/`
- `app/Services/`
- `database/migrations/`
- `resources/views/emails/`
- `resources/views/admin/`
- `routes/api.php`
- `routes/web.php`

Tu peux le faire manuellement, ou utiliser le script fourni:

```bash
bash scripts/bootstrap_full_stack.sh
```

## 4) Configurer et migrer

```bash
cd /home/enagnon/Downloads/landingpagedbia/laravel-backend-full
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## 5) Lancer le backend

```bash
php artisan serve
```

Par defaut, Laravel expose `http://127.0.0.1:8000`.

## 5-bis) Installer et lancer les assets Laravel (Vite)

Dans le dossier Laravel complet:

```bash
cd /home/enagnon/Downloads/landingpagedbia/laravel-backend-full
npm install
npm run dev
```

Si `npm run dev` echoue avec `Cannot find package 'laravel-vite-plugin'`, c'est que `npm install` n'a pas ete execute dans ce dossier.

## 6) Lancer le frontend actuel

Le frontend est statique. Pas besoin de `npm run dev`.

Option simple:

```bash
cd /home/enagnon/Downloads/landingpagedbia/frontend
python3 -m http.server 8080
```

Ouvrir ensuite:

- `http://127.0.0.1:8080/landing_dbia_inscriptions.html`
- `http://127.0.0.1:8080/admin_inscriptions.html` (si tu veux tester la version admin statique)

## 7) Connecter frontend -> API Laravel

Dans les pages HTML frontend, regler:

```js
const API_BASE = 'http://127.0.0.1:8000';
```

Fichiers concernes:

- `frontend/landing_dbia_inscriptions.html`
- `frontend/admin_inscriptions.html`

## 8) URL admin Laravel

Une fois le backend complet lance:

- `http://127.0.0.1:8000/admin/inscriptions`

## 9) Si CORS bloque

Si frontend et backend tournent sur des ports differents, configurer CORS dans le Laravel complet (`config/cors.php`) pour autoriser l'origine du frontend (ex: `http://127.0.0.1:8080`).

## 10) Pourquoi `composer install` et `npm run dev` echouaient

- `composer install` echouait car `composer.json` absent dans le backend partiel.
- `npm run dev` echouait car `package.json` absent dans ce projet (frontend statique).

