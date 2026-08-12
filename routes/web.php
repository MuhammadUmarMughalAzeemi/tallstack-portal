<?php

use App\Http\Controllers\BopController;
use App\Http\Controllers\ForgetPassword;
use App\Http\Middleware\CheckSubmittedAt;
use App\Livewire\UhsForms\ApplicationStatus;
use App\Livewire\UhsForms\Dashboard;
use App\Livewire\UhsForms\MultiStepForm;
use App\Livewire\UhsForms\Otp;
use App\Livewire\User\Profile;
use App\Livewire\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/form');
    }

    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->submitted_at) {
            return redirect()->route('uhs-form-dashboard');
        }

        return redirect()->route('uhs-form');
    })->name('dashboard');

    Route::get('/user/profile', Profile::class)->name('user.profile');
    Route::get('/users', UsersIndex::class)->name('users.index');

    // Multi-step form (reference pattern: sidebar left, form right)
    Route::get('/form', MultiStepForm::class)->name('uhs-form');

    Route::middleware([CheckSubmittedAt::class])->group(function () {
        Route::get('/form-dashboard', Dashboard::class)->name('uhs-form-dashboard');
        Route::get('/application-status', ApplicationStatus::class)->name('uhs-form-application-status');
        Route::get('/otp', Otp::class)->name('uhs-form-otp');
        Route::get('/challan/download', [BopController::class, 'createChallan'])->name('download.challan');
    });

});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ForgetPassword::class, 'forget_password'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ForgetPassword::class, 'rest_password'])->middleware('guest')->name('password.update');

require __DIR__.'/auth.php';
