<?php

namespace App\Filament\Resources\PayrollResource\Pages;

use App\Filament\Resources\PayrollResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;




class CreatePayroll extends CreateRecord
{
    protected static string $resource = PayrollResource::class;


    protected static bool $canCreateAnother = false;


}
