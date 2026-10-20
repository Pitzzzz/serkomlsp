<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-site-settings';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Kontak & Kantor';

    protected static ?string $title = 'Kontak & Kantor';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $contact = SiteSetting::contact();

        $this->form->fill([
            'company_name' => $contact['company_name'],
            'contact_email' => $contact['email'],
            'contact_phone' => $contact['phone'],
            'contact_phone_href' => $contact['phone_href'],
            'contact_address' => $contact['address'],
            'contact_city' => $contact['city'],
            'working_hours' => $contact['working_hours'],
            'office_image' => $contact['office_image'],
            'office_coords' => $contact['office_coords'],
            'support_note' => $contact['support_note'],
            'legal_note' => $contact['legal_note'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi kontak')
                    ->description('Ditampilkan di halaman Kontak dan footer website.')
                    ->schema([
                        Forms\Components\TextInput::make('company_name')
                            ->label('Nama perusahaan')
                            ->required(),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Telepon (tampil)')
                            ->required(),
                        Forms\Components\TextInput::make('contact_phone_href')
                            ->label('Telepon (tautan tel:)')
                            ->helperText('Angka saja, tanpa spasi. Contoh: 02510000000')
                            ->required(),
                        Forms\Components\Textarea::make('contact_address')
                            ->label('Alamat lengkap')
                            ->rows(2)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('contact_city')
                            ->label('Kota (footer)')
                            ->required(),
                        Forms\Components\TextInput::make('working_hours')
                            ->label('Jam kerja')
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Kantor')
                    ->schema([
                        Forms\Components\TextInput::make('office_image')
                            ->label('URL gambar kantor')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('office_coords')
                            ->label('Koordinat'),
                        Forms\Components\Textarea::make('support_note')
                            ->label('Catatan dukungan klien')
                            ->rows(2),
                        Forms\Components\Textarea::make('legal_note')
                            ->label('Catatan legalitas')
                            ->rows(2),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::setValue($key, $value);
        }

        Notification::make()
            ->title('Pengaturan kontak disimpan')
            ->success()
            ->send();
    }
}
