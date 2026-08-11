<?php

use App\Filament\Resources\PermissionsResource;
use App\Filament\Resources\RolesResource;
use App\Filament\Resources\UsersResource;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\Livewire;

beforeEach(function () {
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $this->admin = User::factory()->create([
        'email' => 'admin@example.com',
    ]);
    $this->admin->assignRole($adminRole);
});

test('user can be assigned roles and permissions using spatie', function () {
    $role = Role::create(['name' => 'editor']);
    $permission = Permission::create(['name' => 'edit articles']);

    $role->givePermissionTo($permission);

    $user = User::factory()->create();
    $user->assignRole($role);

    expect($user->hasRole('editor'))->toBeTrue();
    expect($user->hasPermissionTo('edit articles'))->toBeTrue();
});

test('roles resource list page renders successfully', function () {
    $this->actingAs($this->admin);

    Livewire::test(RolesResource\Pages\ListRoles::class)
        ->assertSuccessful();
});

test('roles resource can create role with permissions', function () {
    $this->actingAs($this->admin);

    $permission = Permission::create(['name' => 'manage-users']);

    Livewire::test(RolesResource\Pages\CreateRole::class)
        ->fillForm([
            'name' => 'Manager',
            'guard_name' => 'web',
            'permissions' => [$permission->id],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $role = Role::where('name', 'Manager')->first();
    expect($role)->not->toBeNull();
    expect($role->hasPermissionTo('manage-users'))->toBeTrue();
});

test('permissions resource list page renders successfully', function () {
    $this->actingAs($this->admin);

    Livewire::test(PermissionsResource\Pages\ListPermissions::class)
        ->assertSuccessful();
});

test('permissions resource can create permission', function () {
    $this->actingAs($this->admin);

    Livewire::test(PermissionsResource\Pages\CreatePermission::class)
        ->fillForm([
            'name' => 'publish-posts',
            'guard_name' => 'web',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Permission::where('name', 'publish-posts')->exists())->toBeTrue();
});

test('users resource list page renders successfully', function () {
    $this->actingAs($this->admin);

    Livewire::test(UsersResource\Pages\ListUsers::class)
        ->assertSuccessful();
});

test('users resource can create user and assign roles', function () {
    $this->actingAs($this->admin);

    $role = Role::create(['name' => 'supervisor']);

    Livewire::test(UsersResource\Pages\CreateUser::class)
        ->fillForm([
            'name' => 'Jane Supervisor',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'roles' => [$role->id],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $createdUser = User::where('email', 'jane@example.com')->first();
    expect($createdUser)->not->toBeNull();
    expect($createdUser->hasRole('supervisor'))->toBeTrue();
});

test('seeded admin user has admin role and can access filament panel', function () {
    $this->seed(\Database\Seeders\DatabaseSeeder::class);

    $admin = User::where('email', 'admin@uhs.edu.pk')->first();
    expect($admin)->not->toBeNull();
    expect($admin->hasRole('admin'))->toBeTrue();
    expect($admin->canAccessPanel(filament()->getPanel('admin')))->toBeTrue();
});
