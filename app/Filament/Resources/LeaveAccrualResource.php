<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveAccrualResource\Pages;
use App\Models\LeaveAccrual;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class LeaveAccrualResource extends Resource
{
    protected static ?string $model = LeaveAccrual::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Leave';


    public static function canCreate(): bool
   {
      return false;
   }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Name')->searchable(['first_name','last_name']),
                TextColumn::make('accrual_date'),
                TextColumn::make('leave_days')->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLeaveAccruals::route('/'),
            // 'create' => Pages\CreateLeaveAccrual::route('/create'),
            // 'edit' => Pages\EditLeaveAccrual::route('/{record}/edit'),
        ];
    }
}
