<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use DateTime;
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
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\FiltersLayout;




class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;

    // protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-right';


    protected static ?string $navigationGroup = 'Leave';


    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('leave_type_id')->relationship(name: 'leavetype', titleAttribute: 'name')->label('Leave Type')->live(),
                Fieldset::make('Leave Period')
                    ->schema([
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date')->afterOrEqual('start_date')->live()->afterStateUpdated(fn (Get $get, Set $set, ?string $state) => $set('duration', (new DateTime($get('end_date')))->diff(new DateTime($get('start_date')))->days + 1)),

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
                TextColumn::make('user.name')->label('Name'),
                TextColumn::make('leavetype.name')->label('Leave Type')->searchable(),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                TextColumn::make('created_at')->label('Applied')->since(),
                TextColumn::make('statusString')->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'info',
                        'Approved' => 'success',
                        'Withdrawn' => 'warning',
                        'Rejected' => 'danger',
                    }),
            ])
            ->filters([

                // Flter by status
                SelectFilter::make('status')
                    ->options([
                        '0' => 'Pending',
                        '1' => 'Approved',
                        '2' => 'Withdrawn',
                        '3' => 'Rejected',
                    ]),
                // Filter by Leave Type
                SelectFilter::make('leavetype')
                    ->relationship('leavetype', 'name'),


            // Filter by department



                // Select by date
                // Filter::make('created_at')
                //     ->form([
                //         DatePicker::make('created_from'),
                //         DatePicker::make('created_until'),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                //             ->when(
                //                 $data['created_from'],
                //                 fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //             )
                //             ->when(
                //                 $data['created_until'],
                //                 fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //             );
                //     }),
                    // SelectFilter::make('News')
                    // ->options([
                    //     '0' => 'Pending',
                    //     '1' => 'Approved',
                    //     '2' => 'Withdrawn',
                    //     '3' => 'Rejected',
                    // ]),

                ],layout:FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),

                // Approve
                Tables\Actions\Action::make('Approve')
                    ->action(function (Leave $leave) {
                        $leave->status = 1;
                        $leave->save();
                    })->icon('heroicon-o-check-circle')
                    ->button()
                    ->outlined()
                    ->requiresConfirmation()

                    ->size(ActionSize::Small),

                // Reject
                Tables\Actions\Action::make('Reject')
                    ->action(function (Leave $leave) {
                        $leave->status = 3;
                        $leave->save();
                    })->icon('heroicon-o-check-circle')
                    ->button()
                    ->color('danger')
                    ->requiresConfirmation()
                    ->outlined()
                    ->size(ActionSize::Small),


                // Withdraw
                Tables\Actions\Action::make('Withdraw')
                    ->action(function (Leave $leave) {
                        $leave->status = 2;
                        $leave->save();
                    })->icon('heroicon-o-check-circle')
                    ->button()
                    ->color('warning')
                    ->requiresConfirmation()
                    ->outlined()
                    ->size(ActionSize::Small)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
