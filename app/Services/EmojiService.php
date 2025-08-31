<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmojiService
{
    private Client $client;
    private string $baseUrl = 'https://emojihub.yurace.pro/api';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAllEmojis(): array
    {
        return Cache::remember('all_emojis', 3600, function () {
            try {
                $response = $this->client->get("{$this->baseUrl}/all");
                return json_decode($response->getBody()->getContents(), true) ?? [];
            } catch (\Exception $e) {
                Log::error('Error fetching all emojis: ' . $e->getMessage());
                return [];
            }
        });
    }

    public function getEmojisByCategory(string $category): array
    {
        $cacheKey = "emojis_category_{$category}";
        
        return Cache::remember($cacheKey, 3600, function () use ($category) {
            try {
                $response = $this->client->get("{$this->baseUrl}/all/category/{$category}");
                return json_decode($response->getBody()->getContents(), true) ?? [];
            } catch (\Exception $e) {
                Log::error("Error fetching emojis for category {$category}: " . $e->getMessage());
                return [];
            }
        });
    }

    public function searchEmojis(string $query): array
    {
        $allEmojis = $this->getAllEmojis();
        
        if (empty($query)) {
            return $allEmojis;
        }

        $query = strtolower($query);
        
        return array_filter($allEmojis, function ($emoji) use ($query) {
            return str_contains(strtolower($emoji['name'] ?? ''), $query) ||
                   str_contains(strtolower($emoji['category'] ?? ''), $query) ||
                   str_contains(strtolower($emoji['group'] ?? ''), $query);
        });
    }

    public function getCategories(): array
    {
        return Cache::remember('emoji_categories', 3600, function () {
            try {
                $response = $this->client->get("{$this->baseUrl}/all/categories");
                return json_decode($response->getBody()->getContents(), true) ?? [];
            } catch (\Exception $e) {
                Log::error('Error fetching categories: ' . $e->getMessage());
                return [];
            }
        });
    }

    public function getEmojiByName(string $category, string $name): ?array
    {
        $cacheKey = "emoji_{$category}_{$name}";
        
        return Cache::remember($cacheKey, 3600, function () use ($category, $name) {
            $emojis = $this->getEmojisByCategory($category);
            
            foreach ($emojis as $emoji) {
                if (isset($emoji['name']) && strtolower($emoji['name']) === strtolower($name)) {
                    return $emoji;
                }
            }
            
            return null;
        });
    }

    public function sortEmojis(array $emojis, string $sortBy = 'name'): array
    {
        switch ($sortBy) {
            case 'name':
                usort($emojis, fn($a, $b) => strcasecmp($a['name'] ?? '', $b['name'] ?? ''));
                break;
            case 'category':
                usort($emojis, fn($a, $b) => strcasecmp($a['category'] ?? '', $b['category'] ?? ''));
                break;
            case 'group':
                usort($emojis, fn($a, $b) => strcasecmp($a['group'] ?? '', $b['group'] ?? ''));
                break;
        }

        return $emojis;
    }
}