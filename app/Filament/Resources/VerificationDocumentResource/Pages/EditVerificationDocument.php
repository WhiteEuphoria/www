<?php

namespace App\Filament\Resources\VerificationDocumentResource\Pages;

use App\Filament\Resources\VerificationDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerificationDocument extends EditRecord
{
    protected static string $resource = VerificationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
