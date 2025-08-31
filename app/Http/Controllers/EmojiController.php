<?php

namespace App\Http\Controllers;

use App\Services\EmojiService;
use Illuminate\Http\Request;

class EmojiController extends Controller
{
    private EmojiService $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $category = $request->get('category', '');
        $sortBy = $request->get('sort', 'name');

        $emojis = [];
        
        if ($category) {
            $emojis = $this->emojiService->getEmojisByCategory($category);
        } else {
            $emojis = $this->emojiService->getAllEmojis();
        }

        if ($search) {
            $emojis = $this->emojiService->searchEmojis($search);
        }

        $emojis = $this->emojiService->sortEmojis($emojis, $sortBy);
        $categories = $this->emojiService->getCategories();

        return view('emojis.index', compact('emojis', 'categories', 'search', 'category', 'sortBy'));
    }

    public function show(string $category, string $name)
    {
        $emoji = $this->emojiService->getEmojiByName($category, $name);

        if (!$emoji) {
            abort(404, 'Эмодзи не найден');
        }

        // Получаем похожие эмодзи из той же категории
        $relatedEmojis = $this->emojiService->getEmojisByCategory($category);
        
        // Исключаем текущий эмодзи и берём случайные 8
        $relatedEmojis = collect($relatedEmojis)
            ->filter(fn($e) => $e['name'] !== $name)
            ->shuffle()
            ->take(8)
            ->toArray();

        return view('emojis.show', compact('emoji', 'relatedEmojis'));
    }

    public function toggleFavorite(Request $request, string $id)
    {
        // TODO: Implement favorites functionality
        return response()->json(['status' => 'success']);
    }
}
