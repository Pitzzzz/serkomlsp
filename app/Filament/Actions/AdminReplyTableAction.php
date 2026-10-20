<?php

namespace App\Filament\Actions;

use App\Exceptions\ReplyEmailException;
use App\Models\Consultation;
use App\Models\ContactMessage;
use App\Services\AdminReplyService;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class AdminReplyTableAction
{
    public static function make(): Action
    {
        return Action::make('reply')
            ->label('Balas via email')
            ->icon('heroicon-o-paper-airplane')
            ->color('success')
            ->form([
                Textarea::make('body')
                    ->label('Isi balasan')
                    ->required()
                    ->minLength(1)
                    ->maxLength(10000)
                    ->rows(8),
            ])
            ->modalHeading(fn (ContactMessage|Consultation $record): string => 'Balas '.$record->nama)
            ->modalDescription(fn (ContactMessage|Consultation $record): string => 'Email akan dikirim ke '.$record->email.'.')
            ->action(function (ContactMessage|Consultation $record, array $data): void {
                try {
                    app(AdminReplyService::class)->send($record, $data['body']);
                } catch (ReplyEmailException $exception) {
                    Notification::make()
                        ->title('Balasan gagal dikirim')
                        ->body($exception->getMessage())
                        ->danger()
                        ->send();

                    return;
                }

                Notification::make()
                    ->title('Balasan email terkirim')
                    ->success()
                    ->send();
            });
    }
}
