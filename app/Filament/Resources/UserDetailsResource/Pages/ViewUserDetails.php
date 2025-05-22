<?php

namespace App\Filament\Resources\UserDetailsResource\Pages;

use App\Enums\ApprovingEnum;
use App\Enums\RoleEnums;
use App\Filament\Resources\UserDetailsResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Radio;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ViewUserDetails extends ViewRecord
{
    protected static string $resource = UserDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Approve Admin')
                ->form([
                    Radio::make('approve_admin')
                        ->label('Approve Admin')
                        ->default(fn($record) => $record->approve)
                        ->options([
                            'ACCEPT' => ApprovingEnum::Accept->value,
                            'REJECT' => ApprovingEnum::Reject->value,
                        ])
                        ->required(),
                ])
                ->visible(fn($record) => Filament::auth()->id() !== $record->user_id)
            ->requiresConfirmation()
            ->action(function($data, $record){
                $admin = $data['approve_admin'];

                $record->approved_by = Filament::auth()->id();
                $record->approve = $admin;
                $record->save();

                if($admin === ApprovingEnum::Accept){
                    $record->user->syncRoles(RoleEnums::Admin->value);
                } elseif ($admin === ApprovingEnum::Reject){
                    $record->user->removeRole(RoleEnums::Admin->value);
                }
            }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = User::with('details')->find($data['user_id']);

        unset($data);
        $data = $user->toArray();

        $data['role'] = Str::ucfirst(strtolower($user->getRoleNames()[0]));

        return $data;
    }
}
