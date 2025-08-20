<?php
namespace App\Filament\Resources;
use App\Filament\Resources\WithdrawalResource\Pages;
use App\Models\Withdrawal; use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\Resource; use Filament\Tables; use Filament\Tables\Table;
class WithdrawalResource extends Resource {
    protected static ?string $model = Withdrawal::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
            Forms\Components\TextInput::make('amount')->numeric()->prefix('€')->required(),
            Forms\Components\Textarea::make('requisites')->required()->columnSpanFull(),
            Forms\Components\Select::make('status')->options(['В обработке' => 'В обработке', 'Выполнено' => 'Выполнено', 'Отклонено' => 'Отклонено'])->required(),
        ]);
    }
    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->sortable(),
            Tables\Columns\TextColumn::make('amount')->money('EUR')->sortable(),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'В обработке' => 'warning', 'Выполнено' => 'success', 'Отклонено' => 'danger',
            }),
        ])->actions([Tables\Actions\EditAction::make()]);
    }
    public static function getPages(): array { return ['index' => Pages\ListWithdrawals::route('/'), 'create' => Pages\CreateWithdrawal::route('/create'), 'edit' => Pages\EditWithdrawal::route('/{record}/edit')]; }
}
