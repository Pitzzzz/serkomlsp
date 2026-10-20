<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Artikel';

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten artikel')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(200),
                        Forms\Components\TextInput::make('category')
                            ->label('Kategori')
                            ->required()
                            ->datalist(['Panduan', 'Keamanan', 'Sistem', 'Manajemen', 'Teknologi', 'Data'])
                            ->maxLength(80),
                        Forms\Components\TextInput::make('reading_minutes')
                            ->label('Estimasi baca (menit)')
                            ->required()
                            ->numeric()
                            ->default(3)
                            ->minValue(1)
                            ->maxValue(60),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('body')
                            ->label('Isi artikel')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'undo',
                            ]),
                        Forms\Components\FileUpload::make('cover_upload')
                            ->label('Unggah sampul')
                            ->image()
                            ->disk('public')
                            ->directory('articles')
                            ->visibility('public')
                            ->imageEditor()
                            ->dehydrated(false)
                            ->afterStateUpdated(function (Set $set, $state): void {
                                if (filled($state)) {
                                    $set('cover_image', is_array($state) ? (string) collect($state)->first() : (string) $state);
                                }
                            })
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('cover_image')
                            ->label('URL / path sampul')
                            ->helperText('Opsional. Otomatis terisi setelah unggah, atau tempel URL eksternal')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampilkan sebagai unggulan')
                            ->default(false),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Tanggal terbit')
                            ->seconds(false)
                            ->helperText('Kosongkan untuk menyimpan sebagai draf'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Sampul')
                    ->height(40)
                    ->getStateUsing(fn (Article $record): ?string => $record->coverSrc()),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Terbit')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('Draf'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Unggulan'),
                Tables\Filters\Filter::make('published')
                    ->label('Sudah terbit')
                    ->query(fn ($query) => $query->whereNotNull('published_at')->where('published_at', '<=', now())),
            ])
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
