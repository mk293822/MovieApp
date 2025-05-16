<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use App\Enums\RoleEnums;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RoleEnums::User->value]);
        $adminRole = Role::create(['name' => RoleEnums::Admin->value]);
        $uploaderRole = Role::create(['name' => RoleEnums::Uploader->value]);

        $approveUploader = Permission::create(['name' => PermissionEnums::ApproveUploader->value]);
        $uploadMovies = Permission::create(['name' => PermissionEnums::UploadMovies->value]);
        $watchMovies = Permission::create(['name' => PermissionEnums::WatchMovies->value]);

        $userRole->syncPermissions([$watchMovies]);
        $uploaderRole->syncPermissions([$uploadMovies, $watchMovies]);
        $adminRole->syncPermissions([$approveUploader, $uploadMovies, $watchMovies]);
    }
}
