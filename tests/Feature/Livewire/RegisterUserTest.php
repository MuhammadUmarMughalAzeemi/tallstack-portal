<?php

use App\Livewire\RegisterUser;
use App\Models\CnicPassport;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    CnicPassport::updateOrCreate(['id' => 1], ['name' => 'CNIC (Pakistani Citizen)']);
    CnicPassport::updateOrCreate(['id' => 4], ['name' => 'Passport (Foreigner)']);
});

test('register user component can render', function () {
    Livewire::test(RegisterUser::class)
        ->assertStatus(200);
});

test('validation fails when required fields are missing', function () {
    Livewire::test(RegisterUser::class)
        ->call('submit')
        ->assertHasErrors(['name', 'email', 'password', 'cnic']);
});

test('validation fails for duplicate email', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(RegisterUser::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'existing@example.com')
        ->set('cnic', 1)
        ->set('cnic_passport', '1234567890123')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('submit')
        ->assertHasErrors(['email' => 'unique']);
});

test('user can register with valid cnic', function () {
    Livewire::test(RegisterUser::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('cnic', 1)
        ->set('cnic_passport', '1234567890123')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('uhs-form'));

    expect(User::where('email', 'john@example.com')->exists())->toBeTrue();
    expect(auth()->check())->toBeTrue();
});

test('user can register with valid passport', function () {
    Livewire::test(RegisterUser::class)
        ->set('cnic', 4)
        ->set('name', 'Foreign Resident')
        ->set('email', 'foreign@example.com')
        ->set('cnic_passport', 'A12345678')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('uhs-form'));

    expect(User::where('email', 'foreign@example.com')->exists())->toBeTrue();
});
