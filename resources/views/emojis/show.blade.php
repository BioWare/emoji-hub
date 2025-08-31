@extends('layouts.app')

@section('title', $emoji['name'] . ' - Emoji Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    Главная
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('emojis.index') }}" class="text-gray-700 hover:text-blue-600">
                        Эмодзи
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500">{{ $emoji['name'] }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm border p-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Left Column - Emoji Display -->
            <div class="text-center">
                <div class="text-8xl mb-6">
                    @if(isset($emoji['htmlCode']) && is_array($emoji['htmlCode']))
                        {!! $emoji['htmlCode'][0] !!}
                    @else
                        {{ $emoji['unicode'][0] ?? '❓' }}
                    @endif
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $emoji['name'] }}</h1>
                
                <!-- Category and Group -->
                <div class="flex justify-center space-x-2 mb-6">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">
                        {{ ucfirst($emoji['category']) }}
                    </span>
                    @if(isset($emoji['group']) && $emoji['group'] !== $emoji['category'])
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">
                            {{ ucfirst($emoji['group']) }}
                        </span>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <button onclick="copyToClipboard('{{ $emoji['htmlCode'][0] ?? '' }}')" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        📋 Копировать HTML
                    </button>
                    <button onclick="copyToClipboard('{{ $emoji['unicode'][0] ?? '' }}')" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        🔤 Копировать Unicode
                    </button>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Детали эмодзи</h2>

                <!-- Information Grid -->
                <div class="space-y-4">
                    <div class="border-b pb-3">
                        <dt class="text-sm font-medium text-gray-500">Название</dt>
                        <dd class="text-lg text-gray-900">{{ $emoji['name'] }}</dd>
                    </div>

                    <div class="border-b pb-3">
                        <dt class="text-sm font-medium text-gray-500">Категория</dt>
                        <dd class="text-lg text-gray-900">{{ ucfirst($emoji['category']) }}</dd>
                    </div>

                    @if(isset($emoji['group']))
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Группа</dt>
                            <dd class="text-lg text-gray-900">{{ ucfirst($emoji['group']) }}</dd>
                        </div>
                    @endif

                    @if(isset($emoji['htmlCode']) && is_array($emoji['htmlCode']))
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">HTML код</dt>
                            <dd class="text-lg text-gray-900 font-mono bg-gray-100 p-2 rounded">
                                {{ implode(', ', $emoji['htmlCode']) }}
                            </dd>
                        </div>
                    @endif

                    @if(isset($emoji['unicode']) && is_array($emoji['unicode']))
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Unicode</dt>
                            <dd class="text-lg text-gray-900 font-mono bg-gray-100 p-2 rounded">
                                {{ implode(', ', $emoji['unicode']) }}
                            </dd>
                        </div>
                    @endif
                </div>

                <!-- Different Display Styles -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Варианты отображения</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-white rounded border">
                            <div class="text-3xl mb-2">
                                @if(isset($emoji['htmlCode']) && is_array($emoji['htmlCode']))
                                    {!! $emoji['htmlCode'][0] !!}
                                @endif
                            </div>
                            <span class="text-sm text-gray-600">HTML</span>
                        </div>
                        <div class="text-center p-3 bg-white rounded border">
                            <div class="text-3xl mb-2">
                                {{ $emoji['unicode'][0] ?? '❓' }}
                            </div>
                            <span class="text-sm text-gray-600">Unicode</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Emojis -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Другие эмодзи из категории "{{ ucfirst($emoji['category']) }}"</h2>
        
        @if(isset($relatedEmojis) && count($relatedEmojis) > 0)
            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4">
                @foreach($relatedEmojis as $relatedEmoji)
                    <div class="bg-white rounded-lg border shadow-sm hover:shadow-md transition-shadow p-3 text-center group">
                        <a href="{{ route('emojis.show', ['category' => $relatedEmoji['category'], 'name' => $relatedEmoji['name']]) }}" 
                           class="block">
                            <!-- Emoji Display -->
                            <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">
                                @if(isset($relatedEmoji['htmlCode']) && is_array($relatedEmoji['htmlCode']))
                                    {!! $relatedEmoji['htmlCode'][0] !!}
                                @else
                                    {{ $relatedEmoji['unicode'][0] ?? '❓' }}
                                @endif
                            </div>
                            
                            <!-- Emoji Name -->
                            <div class="text-xs text-gray-600 line-clamp-2">
                                {{ $relatedEmoji['name'] }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <div class="text-4xl mb-2">🤔</div>
                <p>Похожие эмодзи не найдены</p>
            </div>
        @endif
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '✅ Скопировано!';
        button.classList.add('bg-green-700');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-700');
        }, 2000);
    }).catch(function(err) {
        console.error('Не удалось скопировать: ', err);
        alert('Не удалось скопировать в буфер обмена');
    });
}
</script>
@endsection