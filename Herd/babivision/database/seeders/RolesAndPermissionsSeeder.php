<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Clear cached permissions (important when rerunning seeds)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2) Define your permissions (granular capabilities used in middleware checks)
        $permissions = [
            'manage products', 'view products',
            'manage orders', 'view orders',
            'manage prescriptions', 'view prescriptions',
            'manage appointments', 'view appointments'
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 3) Create roles
        $admin = Role::firstOrCreate(['name' => 'Elio']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $customer = Role::firstOrCreate(['name' => 'customer']);

        // 4) Attach permissions to roles (use sync to keep idempotent)
        $admin->syncPermissions($permissions); // admin gets everything

        // Staff: typical operational permissions (example)
        $staff->syncPermissions([
            'manage products', 'view products',
            'manage prescriptions', 'view prescriptions',
            'view orders'
        ]);

        // Customer: read-only capabilities
        $customer->syncPermissions([
            'view products', 'view orders', 'view prescriptions', 'view appointments'
        ]);

        // 5) Create a safe default admin user (only for local/dev)
        $adminEmail = 'admin@babivision.test';
        $adminUser = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // change in prod!
            ]
        );

        // Assign the role (idempotent)
        if (! $adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }
    }
}