<?php

namespace App\Filament\Resources\CategorisResource\Pages;

use App\Filament\Resources\CategorisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoris extends EditRecord
{
    protected static string $resource = CategorisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
