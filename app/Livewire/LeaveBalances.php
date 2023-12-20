<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;


class LeaveBalances extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')->searchable('first_name'),
                TextColumn::make('staff_number'),
                TextColumn::make('department.name'),
                TextColumn::make('leave_balance')->label('Leave Balance (days) '),

            ])
            ->filters([

                 // Select by  department
                  // Filter by Leave Type
                SelectFilter::make('department')
                ->relationship('department', 'name'),

            ],layout:FiltersLayout::AboveContent)
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    protected static string $view = 'livewire.leave-balances';
}
