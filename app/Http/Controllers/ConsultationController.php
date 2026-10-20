<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function create(Request $request): View
    {
        $products = Product::query()->orderBy('sort_order')->get();
        $selected = null;

        if ($request->filled('paket')) {
            $selected = $products->firstWhere('slug', $request->string('paket')->toString());
        }

        return view('konsultasi', [
            'products' => $products,
            'selectedProduct' => $selected,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'product_id' => $request->filled('product_id') ? $request->input('product_id') : null,
        ]);

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'perusahaan' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'telepon' => ['required', 'string', 'max:40'],
            'product_id' => ['nullable', 'exists:products,id'],
            'layanan' => ['required', 'string', 'max:160'],
            'anggaran' => ['required', 'string', 'max:120'],
            'kebutuhan' => ['required', 'string', 'max:5000'],
        ]);

        if (! empty($data['product_id'])) {
            $product = Product::query()->find($data['product_id']);
            if ($product) {
                $data['layanan'] = $product->name;
                $data['anggaran'] = $product->budget_range;
            }
        }

        Consultation::query()->create($data);

        return redirect()
            ->route('konsultasi')
            ->with('success', 'Permintaan konsultasi terkirim. Tim kami akan menghubungi Anda maksimal 1 hari kerja.');
    }
}
