<?php

namespace App\Filament\Resources\Fretes\RelationManagers;

use App\Enums\FreteStatus;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EtapasRelationManager extends RelationManager
{
    protected static string $relationship = 'etapas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('descricao')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->label('Tipo da Etapa')
                    ->options(FreteStatus::toNameValueArray())
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('descricao')
            ->columns([
                TextColumn::make('descricao')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->visible(function(){
                        $frete = $this->getOwnerRecord();

                        return $frete->status !== FreteStatus::ENTREGUE;
                    })
                    ->after(function(array $data, Model $etapa) {
                        $tipoEtapa = $data['status'];
                        $novoFreteStatus = FreteStatus::fromName($tipoEtapa);

                        $etapa->frete->update(['status' => $novoFreteStatus]);

                        return redirect(request()->header('Referer'));
                    }),
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
