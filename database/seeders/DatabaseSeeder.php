<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RoleModel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create 'Admin' role
        RoleModel::create([
            'id' => 1,
            'name' => 'Admin'
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'role_id' => 1
        ]);

        // Call PermissionSeeder
        $this->call(PermissionSeeder::class);

        // Assign permissions to Admin role
        $this->assignPermissionsToAdmin();
    }

    /**
     * Assign permissions to the Admin role.
     */
    public function assignPermissionsToAdmin(): void
    {
        $adminRoleId = 1; // Assuming 'Admin' role has id 1

        // Permissions you want to assign to Admin (add, edit, delete permissions, etc.)
        $permissions = [
            1,  // View Dashboard
            2,  // Add User
            3,  // Edit User
            4,  // Delete User
            5,  // View Users
            6,  // Add Role
            7,  // Edit Role
            8,  // Delete Role
            9,  // View Roles
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
            31,
            32,
            33,
            34,
            35,
            36,
            37,
            38,
            39,
            40,
            41,
            42,
            43,
            44,
            45,
            46,
            47,
            48,
            49,
            50,
            51,
            52,
            53,
            54,
            55,
            56,
            57,
            58,
            59,
            60,
            61,
            62,
            63,
            64,
            65,
            66,
            67,
            68,
            69,
            70,
            71,
            72,
            73,
            74,
            75,
            76,
            77,

            // Add more permission IDs as needed
        ];

        foreach ($permissions as $permissionId) {
            DB::table('permission_role')->updateOrInsert(
                ['role_id' => $adminRoleId, 'permission_id' => $permissionId],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
