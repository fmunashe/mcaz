<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Healthcare Worker'],
            ['id' => 2, 'name' => 'Patient'],
            ['id' => 3, 'name' => 'Investigator'],
            ['id' => 4, 'name' => 'Sponsor'],
            ['id' => 5, 'name' => 'Other'],
            ['id' => 6, 'name' => 'Admin'],
            ['id' => 7, 'name' => 'User']
        ];
        foreach ($roles as $role) {
            Role::query()->firstOrCreate($role);
        }
    }
}
