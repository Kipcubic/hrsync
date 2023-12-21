<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;

use Filament\Tables\SummarizesRecords;
use Illuminate\Support\Facades\DB;

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
                        return (($user->basic_salary * 12) / 365) * $user->leave_balance;
                    })->money('KES'),


            ])

            ->filters([

              // Select by creation date
               Filter::make('created_at')
               ->form([
                   DatePicker::make('created_from')->label('From'),
                   DatePicker::make('created_until')->label('To'),
               ])->columns()
               ->query(function (Builder $query, array $data): Builder {
                   return $query
                       ->when(
                           $data['created_from'],
                           fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                       )
                       ->when(
                           $data['created_until'],
                           fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                       );
               }),
                // Select by  department
                SelectFilter::make('department')
                    ->relationship('department', 'name'),


            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(3)
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
