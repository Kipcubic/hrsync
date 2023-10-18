<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', User::count())->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('Employees on Leave', '21')->description('1 increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('Shifts', '3'),
        ];
    }
}
