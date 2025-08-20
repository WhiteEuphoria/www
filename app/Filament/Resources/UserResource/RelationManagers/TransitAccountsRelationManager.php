<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\RelationManagers\RelationManager; use Filament\Tables; use Filament\Tables\Table;
class TransitAccountsRelationManager extends RelationManager {
    protected static string $relationship = 'transitAccounts';
    public function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('account_details')->required()->maxLength(255),
            Forms\Components\TextInput::make('balance')->required()->numeric()->prefix('€'),
        ]);
    }
    public function table(Table $table): Table {
        return $table->recordTitleAttribute('account_details')->columns([
            Tables\Columns\TextColumn::make('account_details'), Tables\Columns\TextColumn::make('balance')->money('EUR'),
        ])->headerActions([Tables\Actions\CreateAction::make()])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }
}
