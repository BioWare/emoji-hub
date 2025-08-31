@extends('layouts.app')

@section('title', 'Каталог эмодзи - Emoji Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Каталог эмодзи</h1>
        <p class="text-gray-600">Исследуйте коллекцию из {{ count($emojis) }} эмодзи</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border p-6 mb-8" x-data="{ showFilters: false }">
        <form method="GET" class="space-y-4">
            <!-- Search Bar -->
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Поиск эмодзи по названию..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Toggle Filters Button -->
            <button type="button" 
                    @click="showFilters = !showFilters"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                </svg>
                Фильтры
            </button>

            <!-- Filters Section -->
            <div x-show="showFilters" x-transition class="grid md:grid-cols-2 gap-4">
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Все категории</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Сортировка</label>
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>По названию</option>
                        <option value="category" {{ $sortBy === 'category' ? 'selected' : '' }}>По категории</option>
                        <option value="group" {{ $sortBy === 'group' ? 'selected' : '' }}>По группе</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Применить фильтры
            </button>
        </form>
    </div>

    <!-- Results -->
    @if(count($emojis) > 0)
        <!-- Emoji Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4">
            @foreach($emojis as $emoji)
                <div class="bg-white rounded-lg border shadow-sm hover:shadow-md transition-shadow p-4 text-center group">
                    <a href="{{ route('emojis.show', ['category' => $emoji['category'], 'name' => $emoji['name']]) }}" 
                       class="block">
                        <!-- Emoji Display -->
                        <div class="text-4xl mb-2 group-hover:scale-110 transition-transform">
                            @if(isset($emoji['htmlCode']) && is_array($emoji['htmlCode']))
                                {!! $emoji['htmlCode'][0] !!}
                            @else
                                {{ $emoji['unicode'][0] ?? '❓' }}
                            @endif
                        </div>
                        
                        <!-- Emoji Name -->
                        <h3 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">
                            {{ $emoji['name'] }}
                        </h3>
                        
                        <!-- Category Badge -->
                        <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">
                            {{ ucfirst($emoji['category']) }}
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="text-6xl mb-4">😕</div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Эмодзи не найдены</h3>
            <p class="text-gray-600 mb-4">Попробуйте изменить поисковый запрос или фильтры</p>
            <a href="{{ route('emojis.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Сбросить фильтры
            </a>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection