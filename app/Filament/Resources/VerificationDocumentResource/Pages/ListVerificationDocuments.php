<?php

namespace App\Filament\Resources\VerificationDocumentResource\Pages;

use App\Filament\Resources\VerificationDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVerificationDocuments extends ListRecords
{
    protected static string $resource = VerificationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
