# United Auto Laravel Project

This repository contains a Laravel 12 application for the United Auto website. The actual application directory is:

- `public_html (3)/`

This README documents the real developer setup for this project only. It does not modify the website theme, UI, or application behavior.

## Actual project root

Use the Laravel app directory as the working directory for all commands:

- `C:\Users\HP\UnitedAuto\unitedautojsr\public_html (3)`

## Requirements

- PHP 8.2+
- Composer
- Node.js
- npm

Verified local environment:

- PHP 8.4.24
- Node.js 24.18.0
- npm 11.12.1

## Composer

The Composer configuration is in:

- `public_html (3)/composer.json`

This project declares:

- PHP `^8.2`
- Laravel Framework `^12.0`
- local dev dependencies such as `laravel/pail` and `phpunit`

Scripts include:

```json
"scripts": {
  "dev": [
    "Composer\\Config::disableProcessTimeout",
    "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others"
  ],
  "test": [
    "@php artisan config:clear --ansi",
    "@php artisan test"
  ]
}
```

Use the local Composer wrapper if Composer is not available on PATH:

```powershell
cd "public_html (3)"
.\composer install
.\composer dev
```

## Frontend / Vite

The frontend config is in:

- `public_html (3)/package.json`

Scripts are:

```json
"scripts": {
  "build": "vite build",
  "dev": "vite"
}
```

Install frontend deps with:

```powershell
cd "public_html (3)"
npm install
```

## Environment and database

The default environment template is:

- `public_html (3)/.env.example`

It uses SQLite by default:

```env
DB_CONNECTION=sqlite
```

Create the local env file from the template:

```powershell
cd "public_html (3)"
Copy-Item .env.example .env
php artisan key:generate
```

The database config is set in:

- `public_html (3)/config/database.php`

It supports the standard Laravel connections and defaults to SQLite for local development.

## Database setup

If using SQLite, ensure the file exists before running migrations:

```powershell
cd "public_html (3)"
New-Item -Path .\database\database.sqlite -ItemType File -Force
```

Then run:

```powershell
php artisan migrate:fresh --seed
```

This was verified successfully in the current environment.

## Storage

A public storage link is not required for normal development unless a feature specifically needs uploaded files to be publicly accessible.

Run only when needed:

```powershell
php artisan storage:link
```

## Git safety

The project-level `.gitignore` already excludes the expected developer and generated files:

- `.env`
- `vendor/`
- `node_modules/`
- `public/build`
- `public/storage`
- `storage/*.key`

## Correct local workflow

Run commands from the actual Laravel app directory:

```powershell
cd "public_html (3)"
.\composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
.\composer dev
```

## Verified status

- PHP runtime works: `php -v` returned PHP 8.4.24
- SQLite extensions are available: `pdo_sqlite` and `sqlite3` were both present
- Composer dependencies were installed and the project booted
- Database migration and seeding succeeded
- `npm run build` succeeded

## Remaining local preview issue

The browser preview was failing earlier because the PHP web runtime was not consistently seeing the SQLite extension. The fix is to ensure the same PHP runtime used by the web server has the SQLite PDO driver enabled. Once that runtime is correct, Laravel can serve the application normally.

No Blade templates, CSS, JavaScript app logic, controllers, models, routes, or website design were modified as part of this setup audit.
