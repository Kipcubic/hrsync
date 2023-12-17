<?php

namespace App\Filament\Resources\LeaveAccrualResource\Pages;

use App\Filament\Resources\LeaveAccrualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaveAccrual extends EditRecord
{
    protected static string $resource = LeaveAccrualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
