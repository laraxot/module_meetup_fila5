# Laravel Pizza Project - Architecture Overview

## Project Structure

The Laravel Pizza project is a modular Laravel application built with a layered architecture that follows the principles of separation of concerns and maintainability. The project uses the `nwidart/laravel-modules` package to organize functionality into distinct, reusable modules.

### Directory Structure
```
/var/www/_bases/base_laravelpizza/laravel/
├── app/                    # Core Laravel application
│   ├── Application.php     # Custom Application class
│   ├── Http/              # HTTP layer (Controllers, Middleware, etc.)
│   ├── Livewire/          # Livewire components
│   ├── Models/            # Eloquent models
│   ├── Providers/         # Service providers
│   └── View/              # View components
├── bootstrap/             # Framework bootstrap files
├── config/                # Configuration files
├── database/              # Migrations, factories, seeders
├── Modules/               # Modular components (13 modules)
│   ├── Activity/
│   ├── Cms/
│   ├── Gdpr/
│   ├── Geo/
│   ├── Job/
│   ├── Lang/
│   ├── Media/
│   ├── Notify/
│   ├── Seo/
│   ├── Tenant/
│   ├── UI/
│   ├── User/
│   └── Xot/
├── public_html/           # Public web directory
├── resources/             # Views, assets, language files
├── routes/                # Route definitions
├── storage/               # Storage and cache
├── Themes/                # Frontend themes
├── vendor/                # Composer dependencies
└── ...
```

## Core Modules

### Xot Module (Core Utilities)
The Xot module serves as the foundation of the application, providing:
- Base data objects and actions
- Core utilities and helpers
- Configuration management
- Theme composition system
- View resolution logic

### UI Module (User Interface)
The UI module contains:
- Reusable UI components
- Layout systems
- Design system elements
- Component-based architecture
- Theme implementations

### User Module (Authentication & Authorization)
- User management system
- Authentication (Fortify)
- Authorization and roles
- Profile management
- Team functionality

### Cms Module (Content Management)
- Page management
- Content blocks system
- Theme composition
- Dynamic content rendering

### Geo Module (Geographic Services)
- Location services
- Map integration
- Geocoding functionality
- Geographic calculations

### Other Specialized Modules
- **Activity**: Activity logging and tracking
- **Gdpr**: GDPR compliance tools
- **Media**: Media file management
- **Notify**: Notification system
- **Seo**: SEO optimization tools
- **Tenant**: Multi-tenancy support

## Key Architectural Patterns

### 1. Modular Architecture
Each module follows a consistent structure:
```
Module/
├── app/
│   ├── Actions/           # Business logic actions
│   ├── Console/           # Commands
│   ├── Events/            # Event classes
│   ├── Http/              # Controllers, requests, middleware
│   ├── Models/            # Eloquent models
│   ├── Policies/          # Authorization policies
│   ├── Providers/         # Service providers
│   └── View/              # Components, composers
├── config/
├── database/
├── resources/
├── routes/
├── tests/
├── composer.json
└── module.json
```

### 2. Action Pattern
Business logic is encapsulated in action classes:
- Single responsibility
- Testable units of logic
- Reusable across the application
- Follows command pattern

### 3. Data Transfer Objects
The application uses Spatie's Laravel Data package for:
- Type-safe data transfer
- Validation
- Transformation
- Serialization

### 4. Component-Based UI
- Livewire Volt for reactive components
- Blade components for reusable UI elements
- View composers for data binding
- Theme system for flexible layouts

## Technology Stack

### Backend
- **Laravel 12.x**: Web application framework
- **PHP 8.2+**: Programming language
- **MySQL/PostgreSQL**: Database systems
- **Redis**: Caching and session storage
- **Queue System**: Asynchronous job processing

### Frontend
- **Tailwind CSS**: CSS framework
- **Alpine.js**: JavaScript framework
- **Vite**: Build tool
- **Livewire**: Full-stack framework

### Development Tools
- **Laravel Modules**: Modular architecture
- **Filament**: Admin panel
- **Laravel Fortify**: Authentication
- **Laravel Sanctum**: API authentication

## Configuration Management

The application uses a hierarchical configuration system:
1. **Environment-specific configs** in `config/localhost/`
2. **Module-specific configs** in each module's `config/` directory
3. **Global configs** in the main `config/` directory

## Theme System

The application implements a flexible theme system:
- Theme files located in `Themes/` directory
- Module-based theme composition
- View resolution through `XotData` and theme composers
- Multi-tenant theme support

## Multi-Tenancy

The application supports multi-tenancy through:
- Tenant-specific configurations
- Isolated data storage
- Tenant-aware services
- Dynamic domain routing

## Security Features

- Laravel's built-in security features
- GDPR compliance tools
- Authentication and authorization
- Input validation and sanitization
- Rate limiting
- CSRF protection

## Performance Optimizations

- Caching strategies (Redis, file, database)
- Database query optimization
- Asset optimization through Vite
- Queue-based processing
- Lazy loading and pagination

This architecture provides a scalable, maintainable foundation for the Laravel Pizza application while allowing for modular development and easy extension.