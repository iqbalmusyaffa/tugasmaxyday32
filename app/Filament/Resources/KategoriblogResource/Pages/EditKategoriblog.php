<?php

namespace App\Filament\Resources\KategoriblogResource\Pages;

use App\Filament\Resources\KategoriblogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriblog extends EditRecord
{
    protected static string $resource = KategoriblogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
