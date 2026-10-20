<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi produk')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(160)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(160),
                        Forms\Components\TextInput::make('label')
                            ->label('Label')
                            ->required()
                            ->helperText('Contoh: 01 / Website')
                            ->maxLength(80),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi singkat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('features')
                            ->label('Fitur')
                            ->required()
                            ->placeholder('Tambah fitur')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('price_from')
                            ->label('Harga mulai dari')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        Forms\Components\TextInput::make('budget_range')
                            ->label('Rentang anggaran')
                            ->required()
                            ->helperText('Ditampilkan di form konsultasi')
                            ->maxLength(120),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_highlighted')
                            ->label('Sorot sebagai rekomendasi')
                            ->default(false),
                        Forms\Components\TextInput::make('highlight_note')
                            ->label('Catatan sorotan')
                            ->helperText('Contoh: paling sering dipilih')
                            ->maxLength(120),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Label')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price_from')
                    ->label('Harga mulai')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget_range')
                    ->label('Anggaran')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_highlighted')
                    ->label('Sorotan')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
