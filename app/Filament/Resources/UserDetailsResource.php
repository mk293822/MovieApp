<?php

namespace App\Filament\Resources;

use App\Enums\ApprovingEnum;
use App\Enums\PermissionEnums;
use App\Enums\RoleEnums;
use App\Filament\Resources\UserDetailsResource\Pages;
use App\Filament\Resources\UserDetailsResource\RelationManagers;
use App\Models\User;
use App\Models\UserDetails;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserDetailsResource extends Resource
{
    protected static ?string $model = UserDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Approve Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('details.avatar')
                ->image()
                ->columnSpan(2),
                TextInput::make('name')->label('User Name'),
                TextInput::make('details.full_name'),
                TextInput::make('email')->email(),
            TextInput::make('details.approved_by')
                ->default('')
                ->formatStateUsing(
                    function ($state) {
                        if (!$state) {
                            return '-'; // or 'Not Approved', 'Pending', etc.
                        }

                        $user = User::find($state);
                        return $user?->details->full_name ?? 'Unknown';
                    }
                ),
                TextInput::make('role'),
            Radio::make('details.approve')
                ->label(fn($record) => 'Approved As ' . Str::ucfirst(strtolower($record->user->getRoleNames()[0])))
                ->default(fn($record) => $record->approve)
                ->columnSpan(2)
                ->options([
                    'ACCEPT' => ApprovingEnum::Accept->value,
                    'REJECT' => ApprovingEnum::Reject->value,
                    'PENDING' => ApprovingEnum::Pending->value,
                ])->inline(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(fn ($query)=>$query->whereNot('approve', null)->orderByDesc('created_at'))
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No.')
                ->alignCenter()
                ->rowIndex()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->default('')
                    ->sortable()
                    ,
            IconColumn::make('is_banned')
                ->boolean()
                ->color(fn($state) => $state ? 'danger' : 'success') // Color based on the boolean state
                ->tooltip(fn($state) => $state ? 'Banned' : 'Not Banned'),
                Tables\Columns\TextColumn::make('approved_by')
                ->label('Approved By')
                ->sortable()
                ->default('')
                ->formatStateUsing(function ($state) {
                    if (!$state) {
                        return '-'; // or 'Not Approved', 'Pending', etc.
                    }

                    $user = User::find($state);
                    return $user?->name ?? 'Unknown';
                }
            )->toggleable(isToggledHiddenByDefault: true),
            IconColumn::make('approve')
                ->label('Approve')
                ->boolean()
                ->icon(fn(ApprovingEnum $state): string => match ($state) {
                    ApprovingEnum::Accept => 'heroicon-o-check-circle',
                    ApprovingEnum::Reject => 'heroicon-o-x-circle',
                    ApprovingEnum::Pending => 'heroicon-o-clock',
                    default => 'heroicon-o-question-mark-circle',
                })
                ->color(fn(ApprovingEnum $state): string => match ($state) {
                    ApprovingEnum::Accept => 'success',
                    ApprovingEnum::Reject => 'danger',
                    ApprovingEnum::Pending => 'warning',
                    default => 'gray',
                })->tooltip(fn(ApprovingEnum $state): string => $state->value),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\Action::make('approve_Uploader')
                ->form([
                    Radio::make('approve_uploader')
                    ->label('Approve Uploader')
                        ->default(fn($record)=> $record->approve)
                        ->options([
                            'ACCEPT' => ApprovingEnum::Accept->value,
                            'REJECT' => ApprovingEnum::Reject->value,
                        ])
                        ->required(),
                ])
                ->visible(fn($record) =>
                   Filament::auth()->user()->hasRole(RoleEnums::Admin->value) &&
                   Filament::auth()->id() !== $record->user_id)
                ->action(function($data, $record){
                    $record->approve = $data['approve_uploader'];
                    $record->approved_by = Auth::id();
                    $record->save();

                    $user = $record->user;

                    if ($data['approve_uploader'] === ApprovingEnum::Accept) {
                        $user->syncRoles(RoleEnums::Uploader->value);
                    } elseif ($data['approve_uploader'] === ApprovingEnum::Reject) {
                        $user->removeRole(RoleEnums::Uploader->value);
                    }
                    Notification::make()->title('Approved Successfully')->success()->send();
                }),
            Tables\Actions\Action::make('ban')
                ->label(fn($record) => $record->is_banned ? 'UnBan' : 'Ban')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn($record) =>
                Filament::auth()->user()->hasRole(RoleEnums::Admin->value) &&
                Filament::auth()->id() !== $record->user_id)
                ->action(function ($data, $record) {
                    // Toggle the banned status
                    $record->is_banned = !$record->is_banned;
                    $record->save();

                    // Send a success notification
                    Notification::make()
                        ->title($record->is_banned ? 'Banned Successfully' : 'UnBanned Successfully')
                        ->success()
                        ->send();
                })
                ,
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
            'index' => Pages\ListUserDetails::route('/'),
            'view' => Pages\ViewUserDetails::route('/{record}')
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();
        return $user && $user->hasRole(RoleEnums::Admin);
    }
}
