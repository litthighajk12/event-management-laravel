<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="/" class="text-xl font-bold text-indigo-600">
            EventApp
        </a>

        <!-- Navigation -->
        <div class="flex items-center space-x-4">

            <a href="/" class="text-gray-600 hover:text-indigo-600">Home</a>
            <a href="/events" class="text-gray-600 hover:text-indigo-600">Events</a>

            @auth
                <!-- User Info -->
                <span class="text-gray-500 text-sm">
                    Hi, {{ Auth::user()->name }}
                </span>

                <!-- Dashboard -->
                <a href="/dashboard" class="text-gray-600 hover:text-indigo-600">
                    Dashboard
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-red-500 hover:text-red-600 text-sm font-medium">
                        Logout
                    </button>
                </form>
            @else
                <!-- Login -->
                <a href="{{ route('login') }}"
                   class="text-gray-600 hover:text-indigo-600 font-medium">
                    Login
                </a>

                <!-- Register -->
                <a href="{{ route('register') }}"
                   class="bg-indigo-600 text-white px-4 py-1.5 rounded-md hover:bg-indigo-700 text-sm">
                    Register
                </a>
            @endauth

        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-6xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 shadow mt-auto">
        <p class="text-sm text-gray-500">© 2026 EventApp</p>
    </footer>

</body>
</html>