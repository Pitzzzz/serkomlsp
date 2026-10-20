<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'products' => Product::query()->orderBy('sort_order')->take(5)->get(),
            'galleryItems' => GalleryItem::query()->orderBy('sort_order')->take(2)->get(),
            'articles' => Article::published()->take(3)->get(),
        ]);
    }
}
