<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\RelationManagers\RelationManager; use Filament\Tables; use Filament\Tables\Table;
class AccountsRelationManager extends RelationManager {
    protected static string $relationship = 'accounts';
    public function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Наименование (Транзитный, Брокерский...)')->required(),
            Forms\Components\TextInput::make('number')->label('Номер счёта')->required(),
            Forms\Components\TextInput::make('bank')->label('Банк хранения')->required(),
            Forms\Components\TextInput::make('client_initials')->label('Инициалы клиента')->required(),
            Forms\Components\TextInput::make('broker_initials')->label('Инициалы от брокера')->required(),
            Forms\Components\DatePicker::make('term')->label('Срок действия')->required(),
            Forms\Components\Select::make('status')->options(['Active' => 'Active', 'Hold' => 'Hold', 'Blocked' => 'Blocked'])->required(),
        ]);
    }
    public function table(Table $table): Table {
        return $table->recordTitleAttribute('name')->columns([
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'Active' => 'success', 'Hold' => 'warning', 'Blocked' => 'danger',
            }),
        ])->headerActions([Tables\Actions\CreateAction::make()])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }
}
