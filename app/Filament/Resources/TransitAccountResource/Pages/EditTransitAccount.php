<?php

namespace App\Filament\Resources\TransitAccountResource\Pages;

use App\Filament\Resources\TransitAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransitAccount extends EditRecord
{
    protected static string $resource = TransitAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
