<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Galeri';

    protected static ?string $modelLabel = 'Item galeri';

    protected static ?string $pluralModelLabel = 'Galeri';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Item galeri')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(160),
                        Forms\Components\TextInput::make('category')
                            ->label('Kategori')
                            ->required()
                            ->datalist(['Kegiatan', 'Proses', 'Prestasi', 'Dokumentasi', 'Fasilitas'])
                            ->maxLength(80),
                        Forms\Components\FileUpload::make('image_upload')
                            ->label('Unggah gambar')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->visibility('public')
                            ->imageEditor()
                            ->dehydrated(false)
                            ->afterStateUpdated(function (Set $set, $state): void {
                                if (filled($state)) {
                                    $set('image_url', is_array($state) ? (string) collect($state)->first() : (string) $state);
                                }
                            })
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('image_url')
                            ->label('URL / path gambar')
                            ->required()
                            ->helperText('Otomatis terisi setelah unggah, atau tempel URL eksternal')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('span')
                            ->label('Lebar kolom (desktop)')
                            ->options([
                                'lg:col-span-4' => '1/3 (col-span-4)',
                                'lg:col-span-5' => 'Lebih sempit (col-span-5)',
                                'lg:col-span-7' => 'Lebih lebar (col-span-7)',
                                'lg:col-span-12' => 'Penuh (col-span-12)',
                            ])
                            ->required()
                            ->default('lg:col-span-4'),
                        Forms\Components\Select::make('aspect')
                            ->label('Rasio aspek')
                            ->options([
                                'aspect-[4/3]' => '4:3',
                                'aspect-[4/3] lg:h-full' => '4:3 penuh tinggi',
                                'aspect-[16/10]' => '16:10',
                                'aspect-square' => '1:1',
                            ])
                            ->required()
                            ->default('aspect-[4/3]'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->height(48)
                    ->getStateUsing(fn (GalleryItem $record): string => $record->imageSrc()),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'view' => Pages\ViewGalleryItem::route('/{record}'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
