<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('produk', [
            'products' => Product::query()->orderBy('sort_order')->get(),
        ]);
    }
}
