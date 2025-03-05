<?php

namespace App\Filament\Resources\AskPermissionResource\Pages;

use App\Filament\Resources\AskPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAskPermission extends EditRecord
{
    protected static string $resource = AskPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
