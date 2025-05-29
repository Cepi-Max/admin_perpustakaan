<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-gray-900 rounded-2xl shadow-lg p-8">
      <div class="text-center mb-6">
        <span class="material-symbols-outlined text-gray-100 text-5xl">
          menu_book
        </span>
        <h2 class="mt-4 text-2xl font-bold text-gray-100">Perpustakaan Login</h2>
      </div>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="text-gray-100" />
          <x-text-input id="email" class="block mt-1 w-full border-gray-200 focus:ring-gray-300 focus:border-gray-500 rounded-lg" 
                        type="email" name="email" :value="old('email')" required autofocus />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" class="text-gray-100" />
          <x-text-input id="password" class="block mt-1 w-full border-gray-200 focus:ring-gray-300 focus:border-gray-500 rounded-lg"
                        type="password" name="password" required autocomplete="current-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input id="remember_me" type="checkbox" name="remember"
                 class="h-4 w-4 text-gray-100 border-gray-300 rounded focus:ring-gray-300">
          <label for="remember_me" class="ml-2 block text-sm text-gray-700">
            {{ __('Remember me') }}
          </label>
        </div>

        <div class="flex items-center justify-between">
          @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 hover:text-gray-100" href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
            </a>
          @endif

          <x-primary-button class="bg-yellow-900 hover:bg-yellow-700">
            {{ __('Log in') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
