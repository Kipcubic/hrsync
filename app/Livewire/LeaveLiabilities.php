<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Database\Query\Builder;

class LeaveLiabilities extends Component implements HasForms, HasTable
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
                TextColumn::make('liability')
                ->state(function (User $user): float {
                    return (($user->basic_salary * 12)/365)*$user->leave_balance;
                })->money('KES'),


TextColumn::make('created_at')->label('From Date')
    ->dateTime()
    ->summarize(Range::make()->minimalDateTimeDifference())
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
    public function render()
    {
        return view('livewire.leave-liabilities');
    }
}
