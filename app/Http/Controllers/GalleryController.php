<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::query()->orderBy('sort_order')->get();

        return view('galeri', [
            'items' => $items,
        ]);
    }
}
