<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            LanguageSeeder::class,
            RoleSeeder::class,
            UsersSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
            AccessTokenSeeder::class,
            ActionTakenSeeder::class,
            ADROutcomeSeeder::class,
            ADRSeriousReasonSeeder::class,
            GenderSeeder::class,
            DurationSeeder::class,
            AdverseEventSeeder::class,
            DefectSeeder::class,
            AgeGroupSeeder::class,
        ]);
    }
}
