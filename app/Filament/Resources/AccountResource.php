<?php
namespace App\Filament\Resources;
use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account; use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\Resource; use Filament\Tables; use Filament\Tables\Table;
class AccountResource extends Resource {
    protected static ?string $model = Account::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
            Forms\Components\TextInput::make('name')->label('Наименование (Транзитный, Брокерский...)')->required(),
            Forms\Components\TextInput::make('number')->label('Номер счёта')->required(),
            Forms\Components\TextInput::make('bank')->label('Банк хранения')->required(),
            Forms\Components\TextInput::make('client_initials')->label('Инициалы клиента')->required(),
            Forms\Components\TextInput::make('broker_initials')->label('Инициалы от брокера')->required(),
            Forms\Components\DatePicker::make('term')->label('Срок действия')->required(),
            Forms\Components\Select::make('status')->options(['Active' => 'Active', 'Hold' => 'Hold', 'Blocked' => 'Blocked'])->required(),
        ]);
    }
    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->sortable(),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'Active' => 'success', 'Hold' => 'warning', 'Blocked' => 'danger',
            }),
        ])->actions([Tables\Actions\EditAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }
    public static function getRelations(): array { return []; }
    public static function getPages(): array { return ['index' => Pages\ListAccounts::route('/'), 'create' => Pages\CreateAccount::route('/create'), 'edit' => Pages\EditAccount::route('/{record}/edit')]; }
}
