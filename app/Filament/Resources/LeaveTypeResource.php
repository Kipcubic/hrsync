<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveTypeResource\Pages;
use App\Filament\Resources\LeaveTypeResource\RelationManagers;
use App\Models\EmploymentType;
use App\Models\LeaveType;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveTypeResource extends Resource
{
    protected static ?string $model = LeaveType::class;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Leave Type Name')->required()->unique(ignoreRecord:true),


                Select::make('employment_type_id')->label('Employment Type')->relationship(name:'employmenttype',titleAttribute:'name')->createOptionForm([
                    TextInput::make('name')
                ])->searchable()->preload()->multiple(),


                Select::make('gender')->options([
                    'all'=>'All',
                    'male'=>'Male',
                    'female'=>'Female'
                ]),

                TextInput::make('max_days_year')->label('Maximum No. of Days in A year'),


                // TextInput::make('max_negative_balance')->label('Maximum Negative Balance'),
                Toggle::make('attachment')->label('Mandatory Attachment')->columnStart(1),


                Section::make('Is the leave type accrues?')
                ->schema([
                    Toggle::make('accrues')->label('The days accrues')->columnStart(1),


                ]),

                    Select::make('days_accrued')->label('Days to Accrue:')->options([
                    'monthly'=>'Monthly',
                    'yearly'=>'Yearly'
                ])->hidden(fn (Get $get): bool => ! $get('accrues')),
                Select::make('accrual_registered_at')->options([
                    'year_start'=>'Start of the Year',
                    'contract_start'=>'Start of the Contract'
                ])->required()->hidden(fn (Get $get): bool => ! $get('accrues')),

                Section::make('When Calculating Leave Days')
                ->schema([
                    Checkbox::make('off_days')->label('Exclude Employees Off-days')->columnSpan(2),
                    Checkbox::make('holidays')->label('Exclude Holidays'),
                    Checkbox::make('weekends')->label('Include Weekends')->columnSpan(2),

                ]),

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('gender'),
                TextColumn::make('max_days_year'),
                TextColumn::make('max_negative_balance'),
                ToggleColumn::make('attachment')->label('Mandatory Attachment'),
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
            'index' => Pages\ListLeaveTypes::route('/'),
            'create' => Pages\CreateLeaveType::route('/create'),
            'edit' => Pages\EditLeaveType::route('/{record}/edit'),
        ];
    }
}
