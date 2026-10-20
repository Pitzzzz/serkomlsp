<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('kontak', [
            'contact' => SiteSetting::contact(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'telepon' => ['nullable', 'string', 'max:40'],
            'perusahaan' => ['nullable', 'string', 'max:160'],
            'topik' => ['required', 'string', 'max:160'],
            'pesan' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return redirect()
            ->route('kontak')
            ->with('success', 'Pesan terkirim. Tim kami akan membalas pada hari kerja.');
    }
}
