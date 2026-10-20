<?php

namespace App\Filament\Resources;

use App\Filament\Actions\AdminReplyTableAction;
use App\Filament\Resources\ConsultationResource\Pages;
use App\Models\Consultation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Inbox';

    protected static ?string $navigationLabel = 'Konsultasi';

    protected static ?string $modelLabel = 'Konsultasi';

    protected static ?string $pluralModelLabel = 'Konsultasi';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::query()->where('is_read', false)->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('nama')->required()->maxLength(120),
                        Forms\Components\TextInput::make('perusahaan')->maxLength(160),
                        Forms\Components\TextInput::make('email')->email()->required()->maxLength(160),
                        Forms\Components\TextInput::make('telepon')->tel()->required()->maxLength(40),
                        Forms\Components\Select::make('product_id')
                            ->label('Produk terkait')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('layanan')->required()->maxLength(160),
                        Forms\Components\TextInput::make('anggaran')->required()->maxLength(120),
                        Forms\Components\Textarea::make('kebutuhan')->required()->rows(6)->columnSpanFull(),
                        Forms\Components\Toggle::make('is_read')->label('Sudah dibaca')->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Data pemohon')
                    ->schema([
                        TextEntry::make('nama'),
                        TextEntry::make('perusahaan')->placeholder('-'),
                        TextEntry::make('email'),
                        TextEntry::make('telepon'),
                        TextEntry::make('layanan'),
                        TextEntry::make('anggaran'),
                        TextEntry::make('kebutuhan')->columnSpanFull(),
                    ])
                    ->columns(2),
                InfolistSection::make('Riwayat balasan email')
                    ->schema([
                        RepeatableEntry::make('replies')
                            ->label('Balasan')
                            ->placeholder('Belum ada balasan.')
                            ->schema([
                                TextEntry::make('subject'),
                                TextEntry::make('recipient')->label('Dikirim ke'),
                                TextEntry::make('sent_at')->label('Terkirim')->dateTime('d M Y H:i'),
                                TextEntry::make('body')->label('Isi email')->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight(fn (Consultation $record) => $record->is_read ? null : 'bold'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('layanan')
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->placeholder('-')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Sudah dibaca'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                AdminReplyTableAction::make(),
                Tables\Actions\Action::make('markRead')
                    ->label('Tandai dibaca')
                    ->icon('heroicon-o-check')
                    ->visible(fn (Consultation $record) => ! $record->is_read)
                    ->action(function (Consultation $record): void {
                        $record->update(['is_read' => true]);
                        Notification::make()->title('Ditandai sudah dibaca')->success()->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markRead')
                        ->label('Tandai dibaca')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['is_read' => true])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'view' => Pages\ViewConsultation::route('/{record}'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
