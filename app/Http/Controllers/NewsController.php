<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
   public function index()
{
    $response = Http::get('https://newsapi.org/v2/top-headlines', [
        'category' => 'technology',
        'apiKey' => env('NEWS_API_KEY'),
        'pageSize' => 12,
    ]);

    $articles = collect($response->json()['articles'] ?? [])
    ->filter(fn($a) => $a['urlToImage']);


    return view('news', compact('articles'));
}

}

