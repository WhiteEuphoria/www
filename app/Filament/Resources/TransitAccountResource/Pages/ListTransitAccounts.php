<?php

namespace App\Filament\Resources\TransitAccountResource\Pages;

use App\Filament\Resources\TransitAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransitAccounts extends ListRecords
{
    protected static string $resource = TransitAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
