<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 shadow-md">
            <div class="p-6">
                <a href="{{route('welcome')}}">
                    <h1 class="text-lg font-bold text-white text-center">Post Share</h1>
                </a>
            </div>
            <nav class="mt-6">
                <!-- Sidebar Links -->
                <a href="{{route('posts.index')}}"
                    class="block py-2.5 px-4 rounded
                {{ request()->routeIs('posts.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    Posts
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="block py-2.5 px-4 rounded
                {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2.5 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-gray-800 text-xl font-semibold"></h2>
                    <div class="relative">

                        <button
                            id="profileButton"
                            class="flex items-center focus:outline-none"
                            onclick="toggleDropdown()">
                            <div class="flex items-center">
                                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                                <img
                                    src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://via.placeholder.com/40' }}" alt="Profile Photo" alt="Profile Photo"
                                    class="h-10 w-10 rounded-full border-2 border-gray-300">
                            </div>
                        </button>
                        <!-- Dropdown Menu -->
                        <div
                            id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Page Content -->
            <main class="flex-1 bg-gray-50 overflow-y-auto">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4">
                    {{ session('error') }}
                </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>