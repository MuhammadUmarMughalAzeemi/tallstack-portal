<x-guest-layout>
    <div style="background-image: url('{{ asset('images/bg-new.jpg') }}');" class="bg-cover bg-center min-h-screen flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
            <div class="mb-6 text-center">
                <div class="flex justify-center gap-6 mb-4">
                    <img src="{{ asset('images/privateclogo.png') }}" alt="UHS Logo" class="rounded-lg w-16 h-16">
                    <img src="{{ asset('images/login.png') }}" alt="Portal Logo" class="w-16 h-16">
                </div>
                <h1 class="text-2xl font-bold text-gray-900 font-inter">Reset Password</h1>
                <p class="text-gray-500 text-sm mt-1 font-poppins">Enter your new password below.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <x-input id="email" label="Email *" placeholder="Email" type="email" name="email" :value="old('email', request()->email)" required autofocus />
                </div>

                <div>
                    <x-input id="password" label="New Password *" placeholder="New Password (min 8 characters)" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div>
                    <x-input id="password_confirmation" label="Confirm New Password *" placeholder="Confirm New Password" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-3">
                        <ul class="text-sm text-red-600 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" style="border-radius: 3px; background: #179F9E;"
                        class="block w-full px-[27px] py-2 mt-4 text-[16px] items-center justify-center font-normal text-center font-sans text-white border rounded-[5px] leading-normal hover:bg-teal-700 transition-colors">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
