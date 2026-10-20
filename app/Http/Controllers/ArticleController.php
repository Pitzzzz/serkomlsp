<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::published()->get();
        $featured = $articles->firstWhere('is_featured', true) ?? $articles->first();
        $list = $articles->when($featured, fn ($items) => $items->where('id', '!=', $featured->id))->values();

        return view('artikel', [
            'featured' => $featured,
            'articles' => $list,
        ]);
    }

    public function show(Article $article): View
    {
        abort_unless($article->published_at && $article->published_at->lte(now()), 404);

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('artikel-show', [
            'article' => $article,
            'related' => $related,
        ]);
    }
}
