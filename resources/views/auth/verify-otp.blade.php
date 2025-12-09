<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, please enter the 6-digit code we just emailed to you.') }}
    </div>


    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.store') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Verification Code')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center tracking-[0.5em] text-2xl font-mono"
                            type="text" name="otp" required autofocus placeholder="123456" maxlength="6" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>

            <div class="flex items-center">
                <a href="{{ route('otp.resend') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                    {{ __('Resend Code') }}
                </a>

                <x-primary-button class="bg-green-500 hover:bg-green-600">
                    {{ __('Verify') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
