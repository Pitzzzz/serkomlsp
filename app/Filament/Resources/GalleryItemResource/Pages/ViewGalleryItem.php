<?php

namespace App\Filament\Resources\GalleryItemResource\Pages;

use App\Filament\Resources\GalleryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGalleryItem extends ViewRecord
{
    protected static string $resource = GalleryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
