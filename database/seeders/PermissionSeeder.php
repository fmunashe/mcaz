<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'title' => 'auth_profile_edit'],
            ['id' => 2, 'title' => 'user_management_access'],
            ['id' => 3, 'title' => 'user_management_edit'],
            ['id' => 4, 'title' => 'user_management_delete'],
            ['id' => 5, 'title' => 'user_management_create'],
            ['id' => 6, 'title' => 'adr_create'],
            ['id' => 7, 'title' => 'adr_access'],
            ['id' => 8, 'title' => 'adr_edit'],
            ['id' => 9, 'title' => 'adr_delete'],
            ['id' => 10, 'title' => 'aefi_create'],
            ['id' => 11, 'title' => 'aefi_access'],
            ['id' => 12, 'title' => 'aefi_edit'],
            ['id' => 13, 'title' => 'aefi_delete'],
            ['id' => 14, 'title' => 'product_defect_create'],
            ['id' => 15, 'title' => 'product_defect_access'],
            ['id' => 16, 'title' => 'product_defect_edit'],
            ['id' => 17, 'title' => 'product_defect_delete'],
            ['id' => 18, 'title' => 'customer_complaints_create'],
            ['id' => 19, 'title' => 'customer_complaints_access'],
            ['id' => 20, 'title' => 'customer_complaints_edit'],
            ['id' => 21, 'title' => 'customer_complaints_delete'],
            ['id' => 22, 'title' => 'client_access'],
            ['id' => 23, 'title' => 'client_edit'],
            ['id' => 24, 'title' => 'client_delete'],
            ['id' => 25, 'title' => 'client_create'],
            ['id' => 26, 'title' => 'client_show']
        ];

        Permission::insert($permissions);
    }
}
