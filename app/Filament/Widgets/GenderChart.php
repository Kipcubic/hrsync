<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class GenderChart extends ChartWidget
{
    protected static ?string $heading = 'Gender Distribution';
    protected static ?int $sort = 3;

    protected static ?string $maxHeight = '255px';


    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Gender Distribution',
                    'data' => [User::where('gender','male')->count(),User::where('gender','female')->count()],
                ],
            ],
            'labels' => ['Male', 'Female'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
