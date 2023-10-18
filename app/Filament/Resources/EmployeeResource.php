<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use Filament\Forms\Components\Tabs;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\TextColumn;

class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $recordTitleAttribute = 'first_name';


    protected static ?string $modelLabel = 'Employee';



    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Employees')
                    ->tabs([
                        Tabs\Tab::make('Personal Details')
                        ->icon('heroicon-s-user-circle')
                        ->iconPosition(IconPosition::After)
                            ->schema([
                                Section::make('Employee Personal Details')
                                    ->description('Employee personal details')
                                    ->schema([
                                        Forms\Components\TextInput::make('first_name'),
                                        Forms\Components\TextInput::make('middle_name'),
                                        Forms\Components\TextInput::make('last_name'),
                                        Forms\Components\DatePicker::make('dob')->label(__('Date of Birth')),
                                        Forms\Components\TextInput::make('national_id')->columnStart(1)->label('National ID'),
                                        Forms\Components\TextInput::make('mobile_number')->tel(),
                                        Select::make('gender')
                                            ->options([
                                                'male' => 'Male',
                                                'female' => 'Female',
                                                'other' => 'Other',
                                            ]),
                                        Section::make('Employee Statutory Details')
                                        ->description('Employee Statutory details')
                                        ->schema([
                                            Forms\Components\TextInput::make('kra_pin')->label('KRA Pin'),
                                            Forms\Components\TextInput::make('nssf_no')->label('NSSF Number'),
                                            Forms\Components\TextInput::make('nhif_no')->label('NHIF Number'),
                                        ])->columns(3)

                                    ])->columns(4)
                            ]),
                        Tabs\Tab::make('Salary Details')
                        ->icon('heroicon-m-wallet')
                        ->iconPosition(IconPosition::After)
                            ->schema([
                                Section::make('Contract Details')
                                ->description('Contract details')
                                ->schema([
                                    Select::make('employment_type_id')->label('Employment Type')
                                                            ->relationship(name: 'employmenttype', titleAttribute: 'name')

                                                            ->createOptionForm([
                                                                Forms\Components\TextInput::make('name')
                                                                    ->required(),
                                                            ])
                                                            ->searchable()
                                                            ,
                                    Forms\Components\Select::make('currency')->options([
                                        'KES'=>'KES',
                                        'USD'=>'USD'
                                    ]),
                                    Forms\Components\TextInput::make('basic_salary')->label('Monthly Salary'),

                                    Section::make('Bank Details')
                                    ->description('Employee Bank details')
                                    ->schema([
                                        Forms\Components\TextInput::make('account_name'),
                                        Select::make('bank_id')->relationship(name:'bank',titleAttribute:'name')->searchable()->createOptionForm([
                                            Forms\Components\TextInput::make('name')
                                                ->required(),

                                        ]),
                                        Forms\Components\TextInput::make('account_no')->label('Account Number'),
                                        Forms\Components\TextInput::make('bank_branch'),
                                        Forms\Components\TextInput::make('sort_code'),


                                    ])->columns(3)

                                ])->columns(4)

                            ]),
                        Tabs\Tab::make('HR Details')
                            ->schema([
                                Section::make('HR  Details')
                                ->description('Human resource details')
                                ->schema([
                                    Forms\Components\TextInput::make('job_title'),
                                    DatePicker::make('employment_date'),
                                    Forms\Components\TextInput::make('staff_number'),


                                    Section::make('Department Details')
                                    ->description('Department details')
                                    ->schema([
                                        Select::make('department_id')
                                        ->relationship(name: 'department', titleAttribute: 'name')

                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('name')
                                                ->required(),

                                        ])
                                        ->searchable(),
                                        Forms\Components\TextInput::make('reports_to'),

                                    ])->columns(3)

                                ])->columns(4)
                            ]),

                        Tabs\Tab::make('Contact Details')
                            ->schema([
                                Section::make('Contact Details')
                                ->description('Contact details')
                                ->schema([
                                    Forms\Components\TextInput::make('email'),
                                    Forms\Components\TextInput::make('p_email')->label('Personal Email'),
                                    Forms\Components\TextInput::make('address'),
                                    Forms\Components\TextInput::make('ex_no')->label('Extension Number'),
                                ])->columns(4)
                            ]),

                        Tabs\Tab::make('Documents')
                        ->icon('heroicon-o-document')
                        ->iconPosition(IconPosition::After)
                            ->schema([
                                Section::make('')
                                ->schema([
                                    Repeater::make('documents')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('name')->columns(4),
                                        FileUpload::make('link')->label('Document')->openable()
                                    ])->columnSpanFull()
                                ])->columns(4)
                            ]),

                        Tabs\Tab::make('Deductions')
                            ->schema([
                                Section::make('Contract Details')
                                ->description('Contract details')
                                ->schema([

                                ])->columns(4)
                            ]),


                        Tabs\Tab::make('Benefits')
                            ->schema([
                                Section::make('Benefits Details')
                                ->description('Benefits details')
                                ->schema([


                                ])->columns(4)
                            ]),


                        Tabs\Tab::make('Loans')
                            ->schema([
                                Section::make('Contract Details')
                                ->description('Contract details')
                                ->schema([


                                ])->columns(4)
                            ]),

                        Tabs\Tab::make('Credentials')
                        ->icon('heroicon-o-finger-print')
                        ->iconPosition(IconPosition::After)
                            ->schema([
                                Section::make('Credentials Details')
                                ->description('Credentials details')
                                ->schema([


                                ])->columns(4)
                            ]),
                    ])->columnSpanFull()
                    ->persistTabInQueryString()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('staff_number')->default('N/A'),
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name'),
                TextColumn::make('job_title')->default('N/A'),
                TextColumn::make('department.name')->default('N/A')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
