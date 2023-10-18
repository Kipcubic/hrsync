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
                Select::make('gender')->options([
                    'all'=>'All',
                    'male'=>'Male',
                    'female'=>'Female'
                ]),
                Select::make('days_accrued')->label('Days to Accrue:')->options([
                    'monthly'=>'Monthly',
                    'yearly'=>'Yearly'
                ]),
                TextInput::make('max_days_year')->label('Maximum No. of Days in A year'),
                TextInput::make('max_days_carried'),
                Select::make('accrual_registered_at')->options([
                    'year_start'=>'Start of the Year',
                    'contract_start'=>'Start of the Contract'
                ])->required(),

                Select::make('employment_type_id')->label('Employment Type')->relationship(name:'employmenttype',titleAttribute:'name')->createOptionForm([
                    TextInput::make('name')
                ])->searchable()->preload()->multiple(),
                TextInput::make('max_negative_balance')->label('Maximum Negative Balance'),
                Toggle::make('attachment')->label('Mandatory Attachment'),

                Section::make('When Calculating Leave Days')
                ->schema([
                    Checkbox::make('off_days')->label('Exclude Employees Off-days')->columnSpan(4),
                    Checkbox::make('holidays')->label('Exclude Holidays'),
                ]),

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
