<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold text-blue-600">
                Post Share
            </a>
            <div>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 mx-2">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 mx-2">Register</a>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            {{-- Ici, on insère le contenu spécifique des pages enfant --}}
            @yield('content')
        </div>
    </main>
    <!-- Footer -->
    <footer class="text-center py-4 text-gray-500">
        &copy; {{ date('Y') }} Post Share. All rights reserved.
    </footer>
</body>
</html>
