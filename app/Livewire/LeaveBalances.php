<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                SelectFilter::make('department')
                ->relationship('department', 'name'),

                  // Select by creation date
               Filter::make('created_at')
               ->form([
                   DatePicker::make('created_from')->label('From'),
                   DatePicker::make('created_until')->label('To'),
               ])->columns(2)
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

            ],layout:FiltersLayout::AboveContent)->filtersFormColumns(3)
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    protected static string $view = 'livewire.leave-balances';
}
