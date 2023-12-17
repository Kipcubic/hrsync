<?php

namespace App\Filament\Resources\LeaveAccrualResource\Pages;

use App\Filament\Resources\LeaveAccrualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaveAccruals extends ListRecords
{
    protected static string $resource = LeaveAccrualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
