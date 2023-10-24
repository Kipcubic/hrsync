<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Filament\Resources\LeaveResource\RelationManagers;
use App\Models\Leave;
use App\Models\LeaveType;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-right';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('leave_type_id')->relationship(name:'leavetype',titleAttribute:'name')->label('Leave Type')->live(),
                Fieldset::make('Leave Period')
                    ->schema([
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date')->afterOrEqual('start_date')->live()->afterStateUpdated(fn (Get $get, Set $set, ?string $state) => $set('duration', (new DateTime($get('end_date')))->diff(new DateTime($get('start_date')))->days+1)),

                        TextInput::make('duration')->disabled()->label('Duration (days)'),

                    ])->columns(4),

                Textarea::make('comments')->label('Comment (Optional)')->columnSpan(2),
                FileUpload::make('attachment')->columnStart(1)->hidden(function (Get $get): bool {
                    return empty(LeaveType::find($get('leave_type_id'))->attachment) ? true : false;
                })

            ])->columns(4);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('leavetype.name')->label('Leave Type')->searchable(),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }
}
