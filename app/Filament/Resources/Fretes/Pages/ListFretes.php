<?php

namespace App\Filament\Resources\Fretes\Pages;

use App\Filament\Resources\Fretes\FreteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFretes extends ListRecords
{
    protected static string $resource = FreteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
