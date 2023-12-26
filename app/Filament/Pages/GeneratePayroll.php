<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class GeneratePayroll extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.generate-payroll';
    protected static ?string $navigationGroup = 'Payroll';
    protected static ?int $navigationSort = 2;
}
