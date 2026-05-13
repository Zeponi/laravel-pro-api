<?php

namespace App\Filament\Resources\Fretes\Pages;

use App\Filament\Resources\Fretes\FreteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFrete extends ViewRecord
{
    protected static string $resource = FreteResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
