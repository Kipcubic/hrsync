<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollResource\Pages;

use App\Models\Payroll;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationIcon = 'heroicon-s-circle-stack';

    protected static ?string $navigationGroup = 'Payroll';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Fieldset::make('Select Payroll Month')->schema([
                    DatePicker::make('payroll month')->format('m/Y')

                ]),
                Fieldset::make('Select Employees')->schema([
                    Select::make('employees')->options(
                        User::all()->pluck('first_name', 'id')

                    )->searchable()->multiple()
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {

        return [
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),

        ];
    }






}
