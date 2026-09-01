# United Auto — Copilot Development Instructions

## CRITICAL RULE

THE CURRENT WEBSITE THEME IS LOCKED.

Never redesign, replace, restyle, or compromise the existing website theme unless the user explicitly requests a visual redesign.

The current implementation is the design baseline.

The old website/reference is ONLY used to identify missing elements.

## ARCHITECTURE

This is an existing Laravel application.

Before modifying anything:

- inspect the existing architecture
- inspect routes
- inspect controllers
- inspect models
- inspect Blade views
- inspect components
- inspect assets
- inspect CSS
- inspect JavaScript

Do not assume something is missing until you search for it.

## FRONTEND RULE

Preserve the current frontend.

Reuse:

- existing Blade components
- existing CSS classes
- existing buttons
- existing cards
- existing typography
- existing spacing
- existing colors
- existing animations
- existing responsive behavior
- existing JavaScript

Do not create a second design system.

## OLD WEBSITE RULE

The old website/reference is NOT the current design master.

Use it only to determine:

- missing sections
- missing information
- missing functionality
- missing links
- missing interactions
- missing assets

Never copy its visual theme over the current theme.

## MINIMUM CHANGE PRINCIPLE

Make the smallest change necessary to fulfill the requested task.

Before creating a new file:
search for an existing implementation.

Before creating a new component:
search for an existing component.

Before creating a route:
search for an existing route.

Before creating a model:
search for an existing model.

Avoid duplicates.

## DO NOT INVENT DATA

Never invent:

- prices
- phone numbers
- emails
- testimonials
- statistics
- awards
- partners
- customer information
- service information

Use existing repository/database/reference data.

If required information is unavailable, clearly state that it is unavailable.

## DATABASE

Preserve the existing database architecture.

Do not create duplicate tables.

Do not replace MySQL with SQLite without explicit instruction.

Do not execute destructive database commands.

Never use:

php artisan migrate:fresh

or:

php artisan db:wipe

unless explicitly requested.

## ENVIRONMENT

Never commit:

.env

Never expose:

- passwords
- API keys
- APP_KEY
- production credentials

Use .env.example for placeholders.

## ROUTES

Before creating a route:

1. Search routes/web.php.
2. Search routes/backend.php.
3. Search controllers.
4. Search route names.

Reuse existing routes whenever possible.

## ASSETS

Reuse existing project assets.

Do not replace existing images with random external images.

Check:

- public/
- public/front/
- image directories
- CSS references
- asset() calls
- Vite asset references

before adding new assets.

## CSS

Do not rewrite global CSS for a local feature.

If CSS is required:

- reuse existing classes
- keep changes scoped
- preserve existing theme
- avoid overriding unrelated components

## JAVASCRIPT

Reuse existing JavaScript libraries and patterns.

Do not introduce another library for functionality already supported.

Avoid duplicate event listeners.

## RESPONSIVENESS

Every frontend change must work on:

- desktop
- tablet
- mobile

Do not introduce:

- horizontal overflow
- clipped content
- overlapping text
- broken cards
- broken navigation
- oversized images

## LARAVEL

Follow Laravel conventions already used by the project.

Do not upgrade Laravel or major dependencies unless explicitly requested.

Do not introduce architectural changes unnecessarily.

## TESTING

After meaningful changes, verify as appropriate:

php artisan route:list
php artisan test
npm run build

and manually inspect affected pages.

## WHEN ASKED TO "START THE SITE"

First inspect:

- README.md
- composer.json
- package.json
- .env
- project directory structure

Determine the correct working directory.

If dependencies are installed:
start the development environment.

If dependencies are missing:
install them.

If .env is missing:
create it from .env.example.

If APP_KEY is missing:
run php artisan key:generate.

If database connection fails:
do not change the application architecture.

Instead diagnose:

- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD
- database server availability

Use the project's documented development command whenever possible.

## WHEN ASKED TO ADD A FEATURE

Follow this sequence:

1. Inspect.
2. Search for existing implementation.
3. Identify the minimum gap.
4. Reuse existing architecture.
5. Implement the smallest safe change.
6. Preserve the theme.
7. Test.
8. Report changed files.

## WHEN ASKED TO RESTORE OLD WEBSITE ELEMENTS

Use the old website reference as a checklist only.

Do NOT redesign the current website.

For every old element determine:

EXISTS
PARTIAL
BROKEN
MISSING

Only modify:

PARTIAL
BROKEN
MISSING

Leave:

EXISTS

alone.

## NO UNRELATED REFACTORING

Do not:

- rename unrelated files
- rewrite controllers unnecessarily
- reorganize directories unnecessarily
- change dependencies unnecessarily
- change CSS architecture unnecessarily
- change database architecture unnecessarily
- change authentication unnecessarily

## FINAL RULE

The desired result is:

CURRENT WEBSITE
+
MISSING FUNCTIONALITY
+
MISSING CONTENT
+
MISSING ELEMENTS
=
COMPLETE UNITED AUTO WEBSITE

NOT:

OLD WEBSITE
+
NEW DESIGN

THE CURRENT THEME MUST REMAIN INTACT.
