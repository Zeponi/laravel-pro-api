<?php

namespace App\Filament\Resources\Fretes;

use App\Filament\Resources\Fretes\Pages\CreateFrete;
use App\Filament\Resources\Fretes\Pages\EditFrete;
use App\Filament\Resources\Fretes\Pages\ListFretes;
use App\Filament\Resources\Fretes\Pages\ViewFrete;
use App\Filament\Resources\Fretes\RelationManagers\EtapasRelationManager;
use App\Filament\Resources\Fretes\Schemas\FreteForm;
use App\Filament\Resources\Fretes\Schemas\FreteInfolist;
use App\Filament\Resources\Fretes\Tables\FretesTable;
use App\Models\Etapa;
use App\Models\Frete;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FreteResource extends Resource
{
    protected static ?string $model = Frete::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FreteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FreteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FretesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            EtapasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFretes::route('/'),
            'create' => CreateFrete::route('/create'),
            'view' => ViewFrete::route('/{record}'),
        ];
    }
}
