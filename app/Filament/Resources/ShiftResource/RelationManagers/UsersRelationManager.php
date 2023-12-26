<?php

namespace App\Filament\Resources\ShiftResource\RelationManagers;

use App\Models\User;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';


    public function isReadOnly(): bool
{
    return false;
}
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->heading('Employees')
            // ->recordTitleAttribute('first_name')
            ->recordTitle(fn (User $record): string => "{$record->name} ({$record->staff_number})")

            ->description('These are the employees assigned in this shift.')

            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable('first_name'),
                Tables\Columns\TextColumn::make('staff_number'),
                Tables\Columns\TextColumn::make('department.name'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->label('Add Employees')->recordSelectSearchColumns(['first_name','staff_number','middle_name','last_name'])
                ->recordSelect(
                    fn (Select $select) => $select->placeholder('Select the employee'),
                )->modalHeading('Add Employees to this shift')
                ->modalSubmitActionLabel('Assign Shift')
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->attachAnother(false)

                ,
            ])
            ->actions([
                Tables\Actions\DetachAction::make()->label('Remove')->label('Remove User')->modalSubmitActionLabel('Yes, remove')
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))



                ,
                // Tables\Actions\ViewAction::make(),

                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()->label('Remove all'),
                ]),
            ]);
    }
}
