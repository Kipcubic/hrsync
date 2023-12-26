<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class GeneratePayroll extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->headerActions([
                BulkAction::make('delete')
    ->requiresConfirmation()
    ->action(fn (User $records) => $records->each->delete())
            ])
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([

            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.generate-payroll');
    }
}
