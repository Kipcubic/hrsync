<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Resources\ShiftResource\RelationManagers;
use App\Filament\Resources\ShiftResource\RelationManagers\UsersRelationManager;
use App\Models\Shift;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Infolists\Components\Section as InfoSection;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ShiftResource extends Resource
{
    protected static ?string $model = Shift::class;

    protected static ?string $navigationIcon = 'heroicon-m-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Shift Name'),
                Toggle::make('flexible')->columnSpan(2),
                Fieldset::make('Start and End Time')->schema([
                    TimePicker::make('start_time'),
                    TimePicker::make('end_time'),
                ])->columns(4)->hidden(fn (Get $get)=>$get('flexible')==true),
                Toggle::make('active')->label('Is Active?'),


    //             Section::make('Employees')
    // ->description('Employees assigned to this shift')
    // ->schema([
    //     CheckboxList::make('users')->label('Employees')
    //     ->relationship('users','first_name')->searchable()


    // ])

            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Infolists\Components\TextEntry::make('name')->columnSpanFull(),
            InfoSection::make('Shift Start and End time')
                    ->schema([
                        Infolists\Components\TextEntry::make('start_time')->columns(1),
                        Infolists\Components\TextEntry::make('end_time')->columns(2),
                    ])->columns(2)
        ]);

}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('start_time'),
                TextColumn::make('end_time'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),

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
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShifts::route('/'),
            'create' => Pages\CreateShift::route('/create'),
            'view' => Pages\ViewShift::route('/{record}'),
            'edit' => Pages\EditShift::route('/{record}/edit'),
        ];
    }
}
