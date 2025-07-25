# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Laravel Development Server
- `php artisan serve` - Start local development server
- `composer run dev` - Start full development environment (server, queue, logs, and Vite)

### Building and Assets
- `npm run dev` - Start Vite development server with hot reload
- `npm run build` - Build production assets

### Database Operations
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh` - Drop all tables and run all migrations
- `php artisan db:seed` - Seed database with sample data

### Testing
- `php artisan test` - Run all tests
- `composer run test` - Clear config and run tests
- `vendor/bin/phpunit tests/Unit` - Run unit tests only
- `vendor/bin/phpunit tests/Feature` - Run feature tests only

### Code Quality
- `vendor/bin/pint` - Laravel Pint (code formatter)

### Queue Management
- `php artisan queue:work` - Process queue jobs
- `php artisan queue:listen --tries=1` - Listen for queue jobs

### Cache Management
- `php artisan config:cache` - Cache configuration
- `php artisan config:clear` - Clear configuration cache
- `php artisan cache:clear` - Clear application cache
- `php artisan optimize` - Cache framework files for performance
- `php artisan optimize:clear` - Clear all cached files

## Project Architecture

### Framework and Stack
- **Laravel 12.21.0** - PHP framework
- **PHP 8.2+** - Required PHP version
- **Vite** - Asset bundling and development server
- **TailwindCSS 4.0** - CSS framework
- **SQLite** - Default database (database.sqlite)

### Directory Structure
- `app/Http/Controllers/` - Application controllers
- `app/Models/` - Eloquent models
- `app/Providers/` - Service providers
- `database/migrations/` - Database schema migrations
- `database/factories/` - Model factories for testing
- `database/seeders/` - Database seeders
- `resources/views/` - Blade templates
- `resources/css/` - CSS assets (with Tailwind)
- `resources/js/` - JavaScript assets
- `routes/web.php` - Web routes
- `routes/console.php` - Artisan commands
- `tests/Feature/` - Feature tests
- `tests/Unit/` - Unit tests

### Key Configuration
- Uses SQLite database by default
- Configured for Vite asset compilation
- TailwindCSS for styling
- PHPUnit for testing with in-memory SQLite
- Laravel Pint for code formatting