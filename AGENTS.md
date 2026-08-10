# AGENTS.md - AI Coding Agent Guide

## Project Overview
This is a **Laravel 12 + Livewire 4 + TallStackUI 3** portal application with server-side reactive components. Modern Laravel conventions (Laravel 11+) are used: routing in `routes/` with no service provider configuration, attribute-based casts, and Pest for testing.

## Architecture Overview

### Core Components
- **Livewire Components** (`app/Livewire/`): Server-side reactive UI components - the primary interface layer
  - User-facing components in `app/Livewire/Users/` and `app/Livewire/User/` directories
  - Components extend `Livewire\Component` and wire directly to models with legacy model binding (`config/livewire.php`)
- **Models** (`app/Models/`): Eloquent models with type hints via PHPDoc (`@property` annotations)
- **Controllers** (`app/Http/Controllers/`): Auth controllers from Laravel Breeze (registration/login)
- **Views** (`resources/views/`): Blade templates; Livewire renders into `layouts.app` layout (not `layouts.blade.php`)
- **TallStackUI**: Pre-built component library integrated via config; provides styled form/layout components

### Critical Knowledge

**Livewire Integration Quirks:**
- Legacy model binding is **enabled** in `config/livewire.php` (default false)
- Layout is configured as `layouts.app` (not the Laravel default) - maps to `resources/views/layouts/app.blade.php`
- Components render via route with `Route::get('/path', ComponentClass::class)`

**Development Workflow:**
```bash
composer dev  # Runs: Laravel server + queue worker + Pail logs + Vite dev (concurrent processes)
```
This single command handles the full dev stack. Never run `php artisan serve` and `npm run dev` separately.

**Database & Testing:**
- SQLite in `database/database.sqlite` (created during setup)
- Migrations in `database/migrations/`; seeders in `database/seeders/`
- Testing framework: **Pest** (not PHPUnit); parallel by default (`composer test`)

**Code Quality:**
- **Pint**: PHP formatting (`composer format`)
- **PHPStan**: Static analysis level 5 (`composer analyse`)
- **CI pipeline**: `composer ci` runs all checks sequentially

## File Organization Patterns

### When Adding Features

**Livewire Component + View:**
```php
// app/Livewire/Feature/Show.php (component logic)
class Show extends Component {
    public User $user; // Legacy binding enabled
    
    public function submit() { /* handles form submission */ }
    public function render() { return view('livewire.feature.show'); }
}

// resources/views/livewire/feature/show.blade.php (view template)
<form wire:submit="submit">
    <x-input wire:model="user.name" />
</form>
```

**Routing Pattern:**
- Full-page Livewire routes: `Route::get('/path', ComponentClass::class)` with auth middleware as needed
- Traditional form routes: `POST` controller routes in `routes/auth.php`

**Service/Repository Layer** (`app/Services/`, `app/Repositories/`):
- Organized by domain (e.g., `UserServices/`, `Base/` for shared repositories)
- Not mandatory for simple CRUD; use when centralizing business logic across multiple components

### Form Components
Always use TallStackUI form components:
- `<x-input wire:model="property" />` 
- `<x-textarea wire:model="property" />`
- `<x-checkbox wire:model="property" />`
- `<x-button>Submit</x-button>`
- Validation errors display automatically when validation fails

## Key Commands

| Command | Purpose |
|---------|---------|
| `composer dev` | Full dev stack (required, not `php artisan serve` alone) |
| `composer test` | Pest tests (parallel) |
| `composer analyse` | PHPStan level 5 static analysis |
| `composer format` | Pint code formatting |
| `composer ci` | Full CI: format check + analysis + tests |
| `php artisan migrate` | Run migrations |
| `php artisan db:seed` | Seed database |

## Critical Conventions

1. **Type Hints via PHPDoc**: Use `@property` annotations on Models for IDE support (see `User.php`)
2. **Attribute Casts**: Use `protected function casts()` not `protected $casts` (Laravel 11+ style)
3. **No Service Providers for Routes**: All routing is file-based (`routes/web.php`, `routes/auth.php`)
4. **Livewire View Paths**: Always use `view('livewire.component-name')` not `view('livewire/component-name')`
5. **Pest Tests**: Location: `tests/Feature/` or `tests/Unit/`; use `test()` syntax not classes
6. **Auth Routes**: Separate file (`routes/auth.php`) required for controllers to work

## External Integration Points

- **TallStackUI Config** (`config/tallstackui.php`): Component registration, custom colors, icons (Heroicons by default)
- **Livewire Config** (`config/livewire.php`): Only modified for layout path + legacy binding
- **Laravel Breeze**: Pre-built auth controllers (modify if custom auth logic needed)

## Common Pitfalls to Avoid

- ❌ Don't use `php artisan serve` alone; use `composer dev`
- ❌ Don't expect components to auto-validate; validation runs in component methods after form submission
- ❌ Don't bypass legacy model binding—Livewire properties auto-sync to model attributes
- ❌ Don't create custom layout file; use existing `resources/views/layouts/app.blade.php`
- ❌ Don't use `$fillable` alone; always add `protected $hidden` for sensitive attributes

## Validation & Testing Pattern

```php
// In Livewire component
public function submit() {
    $this->validate([
        'user.email' => 'required|email|unique:users',
        'user.name' => 'required|string|max:255',
    ]);
    $this->user->save();
    // Toast notification or redirect
}

// In Pest test
test('user can register', function () {
    livewire(RegisterUser::class)
        ->set('user.email', 'test@example.com')
        ->call('submit')
        ->assertHasNoErrors();
});
```

