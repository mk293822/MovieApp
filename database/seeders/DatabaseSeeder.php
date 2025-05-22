<?php

namespace Database\Seeders;

use App\Enums\ApprovingEnum;
use App\Enums\RoleEnums;
use App\Models\Movie;
use App\Models\MovieDetail;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class,
        ]);

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                UserDetails::factory()->create([
                    'user_id' => $user->id,
                ]);

                $user->assignRole(RoleEnums::User->value);
            })
        ;

        $user = User::factory()->create([
            'name' => 'minkhant',
            'email' => 'mkt293822@gmail.com',
        ])->assignRole(RoleEnums::Admin->value);

        UserDetails::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Min Khant Thaw',
            'approve' => ApprovingEnum::Accept,
            'approved_by' => 1,
        ]);

        $user1 = User::factory()->create([
            'email' => 'mkt293821@gmail.com',
        ])->assignRole(RoleEnums::User->value);

        UserDetails::factory()->create([
            'user_id' => $user1->id,
            'approve' => ApprovingEnum::Pending,
        ]);

        Movie::factory()
            ->count(30)
            ->create()
            ->each(function ($movie) {
                MovieDetail::factory()->create([
                'movie_id' => $movie->id,
                ]);
            })
        ;
    }
}
