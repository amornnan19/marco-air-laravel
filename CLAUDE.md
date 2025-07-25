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
- `resources/views/` - Blade templates (organized by feature)
  - `auth/` - Authentication flow templates
  - `app/` - Main application templates
  - `policy/` - Legal/policy page templates
  - `layouts/` - Layout templates
  - `components/` - Reusable components
- `resources/css/` - CSS assets (with Tailwind)
- `resources/js/` - JavaScript assets
- `routes/web.php` - Web routes
- `routes/console.php` - Artisan commands
- `tests/Feature/` - Feature tests
- `tests/Unit/` - Unit tests

### Key Configuration
- Uses MySQL database (configured in .env)
- Configured for Vite asset compilation
- TailwindCSS for styling
- PHPUnit for testing with in-memory SQLite
- Laravel Pint for code formatting

## Authentication System

### LINE Login Integration
- **Laravel Socialite** with LINE provider for OAuth authentication
- **User Profile Management** with mandatory completion flow
- **Terms & Conditions** acceptance with dual consent checkboxes

### Authentication Flow
1. **Login** → LINE OAuth authentication
2. **Profile Completion** → Required fields: first_name, last_name, phone (10-digit validation)
3. **Terms Acceptance** → Marketing consent + Data sharing consent (both required)
4. **Dashboard** → User can access application

### Middleware System
- **EnsureProfileComplete** - Enforces profile completion and terms acceptance
- **Smart Routing** - Root URL automatically redirects authenticated users to appropriate step

### Database Schema
- **Users Table Fields**: name, email, line_id, line_avatar, first_name, last_name, phone, terms_accepted, terms_accepted_at, marketing_consent, data_sharing_consent

## View Architecture

### Layout System (Unified)
- **Single Responsive Layout** (`layouts/app.blade.php`) - Unified layout for all pages
  - **Mobile (< sm)**: Full screen layout
  - **Desktop (≥ sm)**: Phone frame simulation with realistic bezels
  - **Policy Pages**: Full width on desktop, phone frame for app pages

### Template Inheritance
All views use the unified responsive layout (`layouts/app.blade.php`):
- **Authentication Views** (`auth/`) → phone frame on desktop, full screen on mobile
  - `login.blade.php` - LINE login page
  - `update-profile.blade.php` - Profile completion form
  - `terms.blade.php` - Terms acceptance page
- **Application Views** (`app/`) → phone frame on desktop, full screen on mobile
  - `dashboard.blade.php` - Main dashboard with promotions
  - `promotion-detail.blade.php` - Individual promotion details
- **Policy Views** (`policy/`) → full width on desktop, phone frame bypass
  - `terms-conditions.blade.php`
  - `privacy-policy.blade.php` 
  - `cookie-policy.blade.php`

### Responsive Design Features
- **Mobile-First Approach**: Optimized for mobile devices primarily
- **Desktop Phone Simulation**: 375x812px frame with realistic bezels and shadows
- **Automatic Breakpoint Detection**: `sm` breakpoint (640px) switches between modes
- **Policy Page Exception**: Legal pages use full desktop width for better readability
- **Consistent UI Patterns**: Unified experience across all devices

### Page Structure
- **Authentication Flow**: login → update-profile → terms → dashboard
- **Policy Pages**: terms-conditions, privacy-policy, cookie-policy (publicly accessible)
- **Protected Routes**: All main application pages require authentication and profile completion
- **Promotion Routes**: `/promotion/{promotion}` - Individual promotion detail pages

## Navigation System

### Sticky Bottom Navigation
- **Component Location**: `resources/views/components/sticky-bottom-navigation.blade.php`
- **Mobile-Optimized**: Fixed bottom navigation for mobile app experience
- **Menu Items**: หน้าแรก (Home), บริการ (Services), แชท (Chat), บทความ (Articles)
- **Logout Integration**: Profile tab includes logout functionality with CSRF protection
- **Responsive Design**: Centered with max-width constraint for mobile screens

### Navigation Features
- SVG icons for all menu items
- Active state styling (blue for current page)
- Proper form-based logout implementation
- Thai language labels throughout

## Development Notes

### Thai Language Support
- Validation messages in Thai
- Form labels and UI text in Thai
- Error handling with Thai messages

### Security Features
- Phone number validation (10 digits only with real-time filtering)
- Required terms acceptance before application access
- LINE avatar integration with fallback handling
- Session persistence and authentication state management

## Promotion System

### Database Schema
- **Promotions Table**: id, title, content, image_path, link_url, button_text, is_active, start_date, end_date, sort_order, timestamps

### Features Implemented
- Dynamic promotion carousel on dashboard
- Active/inactive status management
- Date-based promotion scheduling (start_date/end_date)
- Sort ordering for promotion display
- Customizable button text and content
- WYSIWYG content support ready
- Model scopes for filtering active and current promotions
- Individual promotion detail pages with full content display
- Consistent blue gradient design theme

### TODO: Admin Features (Future Development)
- [ ] Create admin panel for CRUD operations on promotions
- [ ] Implement image upload functionality for promotion banners
- [ ] Add WYSIWYG editor integration for promotion content
- [ ] Create promotion analytics and click tracking
- [ ] Add promotion categories/tags system
- [ ] Implement A/B testing for promotions
- [ ] Add promotion scheduling with automatic activation/deactivation