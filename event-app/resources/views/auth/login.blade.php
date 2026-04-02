<?php

use Illuminate\Support\Facades\Route;

?>

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-gray-600 mt-2">Sign in to continue to your dashboard</p>
    </div>

    <!-- Role Selection Tabs -->
    <div class="flex mb-6 bg-gray-100 rounded-xl p-1">
        <button type="button" onclick="selectRole('user')" id="userTab" class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold transition-all duration-200 bg-white text-indigo-600 shadow-sm">
            👤 User Login
        </button>
        <button type="button" onclick="selectRole('admin')" id="adminTab" class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-all duration-200">
            🔐 Admin Login
        </button>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm text-green-700">{{ session('status') }}</p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <!-- Hidden Role Input -->
        <input type="hidden" name="role" id="roleInput" value="user">

        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                📧 Email Address
            </label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all duration-200"
                   placeholder="you@example.com">
            @error('email')
                <p class="mt-2 text-sm text-red-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                🔒 Password
            </label>
            <div class="relative">
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all duration-200 pr-12"
                       placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me & Forgot -->
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="remember" class="w-5 h-5 text-indigo-600 border-2 border-gray-300 rounded focus:ring-indigo-500">
                <span class="ml-3 text-sm text-gray-600">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            Sign In
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-8 text-center">
        <p class="text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-bold">
                Create one →
            </a>
        </p>
    </div>

    <!-- Demo Credentials Box -->
    <div class="mt-8 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-5 border border-indigo-100">
        <p class="text-sm font-bold text-indigo-800 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Demo Credentials
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
            <div class="bg-white rounded-xl p-3 border border-indigo-100">
                <p class="font-semibold text-indigo-700">👤 User Account</p>
                <p class="text-gray-600 text-xs mt-1">Email: user@example.com</p>
                <p class="text-gray-600 text-xs">Password: password</p>
            </div>
            <div class="bg-white rounded-xl p-3 border border-indigo-100">
                <p class="font-semibold text-purple-700">🔐 Admin Account</p>
                <p class="text-gray-600 text-xs mt-1">Email: admin@example.com</p>
                <p class="text-gray-600 text-xs">Password: password</p>
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            const userTab = document.getElementById('userTab');
            const adminTab = document.getElementById('adminTab');
            const roleInput = document.getElementById('roleInput');
            const submitBtn = document.getElementById('submitBtn');

            if (role === 'user') {
                userTab.className = 'flex-1 py-2 px-4 rounded-lg text-sm font-semibold transition-all duration-200 bg-white text-indigo-600 shadow-sm';
                adminTab.className = 'flex-1 py-2 px-4 rounded-lg text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-all duration-200';
                roleInput.value = 'user';
                submitBtn.innerHTML = 'Sign In as User';
            } else {
                adminTab.className = 'flex-1 py-2 px-4 rounded-lg text-sm font-semibold transition-all duration-200 bg-purple-600 text-white shadow-sm';
                userTab.className = 'flex-1 py-2 px-4 rounded-lg text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-all duration-200';
                roleInput.value = 'admin';
                submitBtn.innerHTML = 'Sign In as Admin';
            }
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</x-guest-layout>
