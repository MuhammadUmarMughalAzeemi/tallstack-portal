<?php

use App\Livewire\UhsForms\MultiStepForm;
use Livewire\Livewire;

test('it blocks navigation to an incomplete next step', function () {
    Livewire::test(MultiStepForm::class)
        ->call('goToStep', 2)
        ->assertSet('currentStep', 1);
});

test('it keeps the last active step after a refresh', function () {
    session()->put('uhs_form_current_step', 3);

    Livewire::test(MultiStepForm::class)
        ->assertSet('currentStep', 3);
});

test('it allows the next step only after the previous one is completed', function () {
    Livewire::test(MultiStepForm::class)
        ->set('steps.1.completed', true)
        ->call('goToStep', 2)
        ->assertSet('currentStep', 2);
});
