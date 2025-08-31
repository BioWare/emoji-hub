<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Emoji Hub')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl">😊</span>
                        <span class="ml-2 text-xl font-semibold text-gray-900">Emoji Hub</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        Главная
                    </a>
                    <a href="{{ route('emojis.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('emojis.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        Эмодзи
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-600">
                © 2024 Emoji Hub. Сделано с ❤️ для изучения эмодзи
            </p>
        </div>
    </footer>
</body>
</html>