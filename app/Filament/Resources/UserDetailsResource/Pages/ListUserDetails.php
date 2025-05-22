<?php

namespace App\Filament\Resources\UserDetailsResource\Pages;

use App\Filament\Resources\UserDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserDetails extends ListRecords
{
    protected static string $resource = UserDetailsResource::class;

    protected function canCreate(): bool
    {
        return false;
    }

    public function getTitle(): string
    {
        return 'Approve Admin';
    }
}
