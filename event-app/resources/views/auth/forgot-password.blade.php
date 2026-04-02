<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Forgot Password</h1>
                    <p class="text-gray-500 mt-2">No problem. Just let us know your email address.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input id="email" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-colors"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required autofocus 
                               placeholder="you@example.com">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
