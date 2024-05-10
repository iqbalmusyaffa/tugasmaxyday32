<?php

namespace App\Filament\Resources\KategoriblogResource\Pages;

use App\Filament\Resources\KategoriblogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriblogs extends ListRecords
{
    protected static string $resource = KategoriblogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
