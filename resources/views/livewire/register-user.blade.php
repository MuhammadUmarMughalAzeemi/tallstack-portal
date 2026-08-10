<div>
    <x-guest-layout>
        <div class="my-6 flex items-center justify-center">
            <img class="w-28" src="{{ asset('/images/logo.png') }}"/>
        </div>
        <form wire:submit.prevent="submit">
            @csrf
            <div>
                <x-input label="Name *" wire:model="name" required autofocus autocomplete="name"/>
            </div>

            <div class="mt-4">
                <x-input label="Email *" type="email" wire:model="email" required autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-select.styled
                    label="Select CNIC/POC/Passport/B-Form *"
                    searchable
                    placeholder="Select Identity Type"
                    :options="$this->allCnicPassport"
                    wire:model.live="cnic"
                    select="label:name|value:id"
                />
            </div>
            @if($this->showInput > 0)
                <div
                    class="mt-4"
                    x-data="{
                        value: @entangle('cnic_passport').defer
                    }"
                >
                    <x-input
                        :label="$this->currentLabel"
                        x-model="value"
                        @input="
                if ([4,5,6].includes({{ $this->showInput }})) {
                    value = value.replace(/[^a-zA-Z0-9]/g, '')
                } else {
                    value = value.replace(/[^0-9]/g, '')
                }"
                        required
                        autofocus
                        :placeholder="
                in_array($this->showInput, [4, 5, 6])
                ? 'Enter '.$this->currentLabel
                : 'Enter '.$this->currentLabel.' Without Dashes'"
                        autocomplete="name"
                    />
                </div>
            @endif

            <div class="mt-4">
                <x-password label="Password *" wire:model="password" rules required autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-password label="Confirm Password *" wire:model="password_confirmation" rules required
                            autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md"
                   href="{{ route('login') }}"
                   wire:navigate.hover>
                    {{ __('Already registered?') }}
                </a>

                <x-button type="submit" class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-guest-layout>
</div>


