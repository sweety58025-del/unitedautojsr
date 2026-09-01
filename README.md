# United Auto — Website

This repository contains the United Auto website application. It is a Laravel-based project for the company’s automotive service website, using the existing frontend theme and component structure that is already in the codebase.

The project is built with:

- Laravel 12
- PHP 8.2+
- Vite
- Node.js/npm
- Blade templates
- MySQL/MariaDB where configured for local development
- the existing United Auto frontend theme/components

## Repository layout

The repository root is:

- unitedautojsr/

The Laravel application is located in:

- public_html (3)/

Inside the Laravel app, the important directories are:

- app/
- bootstrap/
- config/
- database/
- public/
- resources/
- routes/
- storage/
- tests/

This project keeps the application logic and frontend templates inside the Laravel app folder, while the root of the repository is mainly the workspace container for the project.

## Quick Start

```bash
git clone <REPOSITORY_URL>
cd unitedautojsr
cd "public_html (3)"

composer install
npm install

copy .env.example .env
php artisan key:generate

# configure local database if needed
php artisan migrate

composer dev
```

The local site is normally served at:

- http://127.0.0.1:8000

Laravel will print the actual URL in the terminal when the dev server runs.

## Requirements

The project currently targets:

- PHP 8.2+
- Composer
- Node.js
- npm
- MySQL/MariaDB if you are using a local database server instead of the default SQLite setup

Developer verification commands:

```bash
php -v
composer --version
node -v
npm -v
```

## 1. First-time clone

Use this workflow from a fresh local checkout:

```bash
git clone <REPOSITORY_URL>
cd unitedautojsr
cd "public_html (3)"
```

Do not assume the repository root is the Laravel app directory. The application itself lives under `public_html (3)`.

## 2. Install PHP dependencies

From the Laravel app directory:

```bash
composer install
```

This installs the Laravel framework and project dependencies in `vendor/`.

## 3. Install frontend dependencies

This project uses Vite for frontend asset handling. Install the frontend dependencies with:

```bash
npm install
```

This installs the Vite and JavaScript toolchain used by the project.

## 4. Environment configuration

Create the local app environment file:

Windows:

```powershell
copy .env.example .env
```

macOS/Linux:

```bash
cp .env.example .env
```

Then generate the application key:

```bash
php artisan key:generate
```

Configure the local environment values in `.env` for your machine. Do not commit `.env` to source control and never place production credentials in this repository.

## 5. Database setup

The default project configuration in `.env.example` is SQLite-based:

```env
DB_CONNECTION=sqlite
```

If you want to use MySQL/MariaDB locally instead, configure:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<local_database_name>
DB_USERNAME=<local_database_user>
DB_PASSWORD=<local_database_password>
```

Then create the local database before running migrations.

Example:

```sql
CREATE DATABASE <local_database_name>;
```

Do not use production database credentials in local setup. Do not modify production databases.

## 6. Migrations

Run the project migrations:

```bash
php artisan migrate
```

Important warning:

Do not use `php artisan migrate:fresh` unless you intentionally want to destroy all local database data.

This command is intentionally not part of the normal setup flow.

## 7. Storage

The current project does not require a public storage link for the normal development workflow. Only run:

```bash
php artisan storage:link
```

if a feature specifically needs the public storage filesystem available in the browser.

## 8. Starting the website

This project uses Laravel together with Vite. The verified development workflow is:

```bash
composer dev
```

This starts the development services defined in the Laravel project scripts, including:

- Laravel development server
- queue listener
- Laravel log output with Pail
- Vite dev server

The `composer dev` command is the preferred way to run the project locally.

## 9. Local URL

For a default Laravel local setup, the site is served at:

- http://127.0.0.1:8000

If a different port is already in use, Laravel will print the active URL in the terminal output. Vite handles frontend asset hot reloading in the dev workflow while Laravel serves the application.

## 10. Daily development

After the project is already installed and configured, developers should not repeat the full setup sequence every time.

Normally, the standard developer flow is just:

```bash
composer dev
```

Only repeat `composer install`, `npm install`, and `php artisan key:generate` when the environment is freshly set up or dependencies are missing.

## 11. If `composer dev` does not work

Use the fallback commands below for troubleshooting:

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

If queue processing is required:

```bash
php artisan queue:listen --tries=1
```

If log output is needed:

```bash
php artisan pail --timeout=0
```

These commands are fallback troubleshooting steps when the combined dev workflow is not suitable for the local environment.

## 12. Production build

Build frontend assets for production with:

```bash
npm run build
```

This runs the Vite production build and generates the optimized frontend asset bundle.

Do not use `npm run dev` for production.

## 13. Common errors

### `vendor/autoload.php` not found

Run:

```bash
composer install
```

### `node_modules` missing

Run:

```bash
npm install
```

### `APP_KEY` missing

Run:

```bash
php artisan key:generate
```

### SQLSTATE connection refused

Verify that the local database server is running and that the `.env` database values are correct.

### Vite manifest not found

Run either:

```bash
npm run dev
```

or

```bash
npm run build
```

depending on the environment and whether you are developing or preparing a production bundle.

### Storage link missing

Run:

```bash
php artisan storage:link
```

### Port 8000 already in use

Stop the process using the port or start Laravel on another port.

## 14. Windows setup

Developers may work from Windows using:

- XAMPP
- Laragon
- native PHP

The project does not require a specific Windows environment. The key requirement is that PHP, Composer, Node.js, npm, and the chosen local database server are installed and running correctly.

If MySQL/MariaDB is used, make sure the database service is started before running migrations.

## 15. Using VS Code / Cursor / Windsurf

Open the repository root in the editor, then open the actual Laravel app folder when you need to run commands and edit the project:

- Root: unitedautojsr/
- Laravel app: public_html (3)/

Do not open an unrelated parent directory and expect Laravel commands to work automatically. The working project root for application commands is the Laravel folder itself.

Before making changes, AI assistants and developers should read:

- .github/copilot-instructions.md

## 16. AI development rules

Before asking an AI assistant to modify the project, instruct it to:

1. Inspect the existing implementation.
2. Reuse existing components.
3. Preserve the current theme.
4. Avoid unnecessary rewrites.
5. Avoid duplicate routes or components.
6. Avoid inventing business data.
7. Test changes.
8. Read `.github/copilot-instructions.md` first.

## 17. IMPORTANT — CURRENT THEME IS PROTECTED

This is the required baseline for all work:

> IMPORTANT — CURRENT THEME IS PROTECTED
>
> The current website theme is the design baseline.
>
> Do not redesign the site when adding functionality.
>
> Do not replace the existing:
> - colors
> - typography
> - spacing
> - buttons
> - cards
> - header
> - footer
> - animations
> - responsive behavior
>
> unless the task explicitly requests a visual change.
>
> Missing functionality must be integrated into the current theme.

## 18. Development vs production

Local development uses `.env` values appropriate for a developer machine.

Production values must never be committed to the repository.

Production credentials must never be placed in:

- README.md
- `.env.example`
- GitHub
- Copilot instructions

The repository should only contain placeholders, sample values, and local-safe configuration.

## 19. Testing checklist

Before opening a PR or pushing major changes, verify the relevant project areas:

```bash
php artisan route:list
php artisan test
npm run build
```

Then manually verify:

- homepage
- navigation
- services
- pricing
- gallery
- FAQ
- blog
- contact
- footer
- mobile layout

## 20. Contribution rules

- make focused changes
- avoid unrelated refactoring
- preserve the existing architecture
- do not commit secrets
- do not commit `vendor/`
- do not commit `node_modules/`
- do not modify production configuration accidentally
- test before pushing

## 21. Do not modify application logic

This task is primarily about documentation and developer workflow setup. Do not change:

- controllers
- models
- routes
- Blade files
- CSS
- JavaScript
- database
- configuration

unless the change is required to make the setup workflow functional.

## 22. Summary

This project is a Laravel website with a custom frontend already in place. The preferred local workflow is:

```bash
cd "public_html (3)"
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate
composer dev
```

Then open:

- http://127.0.0.1:8000

The project should be developed as an existing theme-based application, not as a redesign exercise.
