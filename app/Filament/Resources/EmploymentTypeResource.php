<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmploymentTypeResource\Pages;
use App\Models\EmploymentType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class EmploymentTypeResource extends Resource
{
    protected static ?string $model = EmploymentType::class;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('accrual_days')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('accrual_days')->label('Days to Accrue (Monthly)')
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
            'index' => Pages\ListEmploymentTypes::route('/'),
            'create' => Pages\CreateEmploymentType::route('/create'),
            'edit' => Pages\EditEmploymentType::route('/{record}/edit'),
        ];
    }
}
