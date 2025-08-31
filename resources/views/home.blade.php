@extends('layouts.app')

@section('title', 'Добро пожаловать в Emoji Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center py-16">
        <div class="flex justify-center space-x-2 text-6xl mb-8">
            <span class="animate-bounce">😀</span>
            <span class="animate-bounce" style="animation-delay: 0.1s">😎</span>
            <span class="animate-bounce" style="animation-delay: 0.2s">🥳</span>
            <span class="animate-bounce" style="animation-delay: 0.3s">😍</span>
            <span class="animate-bounce" style="animation-delay: 0.4s">🤗</span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
            Добро пожаловать в 
            <span class="text-blue-600">Emoji Hub</span>
        </h1>
        
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Исследуйте мир эмодзи! Найдите идеальный эмодзи для любой ситуации, 
            изучите их значения и добавляйте в избранное.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('emojis.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                <span class="mr-2">🚀</span>
                Исследовать эмодзи
            </a>
            <a href="#features" class="inline-flex items-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <span class="mr-2">📖</span>
                Узнать больше
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Возможности</h2>
            <p class="text-lg text-gray-600">Всё что нужно для работы с эмодзи</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-sm border">
                <div class="text-4xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold mb-2">Поиск и фильтрация</h3>
                <p class="text-gray-600">Быстро найдите нужный эмодзи по названию или категории</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-lg shadow-sm border">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-xl font-semibold mb-2">Подробная информация</h3>
                <p class="text-gray-600">Узнайте значение, категорию и варианты отображения каждого эмодзи</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-lg shadow-sm border">
                <div class="text-4xl mb-4">❤️</div>
                <h3 class="text-xl font-semibold mb-2">Избранное</h3>
                <p class="text-gray-600">Сохраняйте любимые эмодзи для быстрого доступа</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-blue-50 rounded-lg p-8 mb-16">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">В нашей базе</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <div class="text-3xl font-bold text-blue-600">1800+</div>
                    <div class="text-gray-600">Эмодзи</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-600">10+</div>
                    <div class="text-gray-600">Категорий</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-600">100%</div>
                    <div class="text-gray-600">Бесплатно</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection