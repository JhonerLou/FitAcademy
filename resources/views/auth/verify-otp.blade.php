<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please enter the 6-digit code sent to') }} <span class="font-bold">{{ $email ?? session('email') }}</span>.
    </div>
    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.store') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email ?? session('email') }}">

        <div>
            <x-input-label for="otp" :value="__('Verification Code')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center tracking-[0.5em] text-2xl font-mono"
                            type="text" name="otp" required autofocus placeholder="123456" maxlength="6" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                {{ __('Start Over') }}
            </a>

            <div class="flex items-center">
                <a href="{{ route('otp.resend', ['email' => $email ?? session('email')]) }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                    {{ __('Resend Code') }}
                </a>

                <x-primary-button class="bg-green-500 hover:bg-green-600">
                    {{ __('Verify & Register') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
