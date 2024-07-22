<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'create']);
        // Permission::create(['name' => 'unpublish']);

        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);
        $stafAdmin = Role::create(['name' => 'staffAdmin']);
        $kadis = Role::create(['name' => 'kadis']);

        $subkabib = Role::create(['name' => 'subkabib']);
        $kasi = Role::create(['name' => 'kasi']);
        $staffBagian = Role::create(['name' => 'staffBagian']);
        $admin->givePermissionTo('edit');
        $admin->givePermissionTo('delete');
        $admin->givePermissionTo('create');

        // $role2->givePermissionTo('publish articles');
        // $role2->givePermissionTo('unpublish articles');

        $superAdmin = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $users = [
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'jabatan_id' => 1],
            ['name' => 'Kabib Kepegawaian', 'email' => 'kabib.kepegawaian@example.com', 'password' => bcrypt('password'), 'jabatan_id' => 2],
            ['name' => 'Kasi Keuangan', 'email' => 'kasi.keuangan@example.com', 'password' => bcrypt('password'), 'jabatan_id' => 3],
            // Tambahkan user lainnya sesuai kebutuhan
        ];

        // create demo users 1
        $user = \App\Models\User::factory()->create([
            'name' => 'ADMINSTATOR',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($admin);

        // create demo users 2
        $user = \App\Models\User::factory()->create([
            'name' => 'Staff Adminstator',
            'email' => 'staffAdmin@example.com',
        ]);
        $user->assignRole($stafAdmin);

        // create demo users 3
        $user = \App\Models\User::factory()->create([
            'email' => 'kadis@example.com',
        ]);
        $user->assignRole($kadis);

        // contoh bidang Kepegawaian

        // Sub kepala Bagian 
        // create demo users 4
        $user = \App\Models\User::factory()->create([
            'avatar' => '1.png',
            'email' => 'subkabib@kepegawaian.com',
        ]);
        $user->assignRole($subkabib);
        // kasi Kepala saksi
        // create demo users 5
        $user = \App\Models\User::factory()->create([
            'email' => 'kasi@kepegawaian.com',
        ]);
        $user->assignRole($kasi);
        // staff kepegawaian
        // create demo users 6
        $user = \App\Models\User::factory()->create([
            'avatar' => '6.png',
            'email' => 'staff@kepegawaian.com',
        ]);
        // Sub kepala Bagian 
        // create demo users 7
        $user = \App\Models\User::factory()->create([
            'email' => 'subkabib@hukum.com',
        ]);
        $user->assignRole($subkabib);
        $user->assignRole($staffBagian);
        // create demo users 8
        $user = \App\Models\User::factory()->create([
            'avatar' => '7.png',
            'email' => 'staff1@kepegawaian.com',
        ]);
        $user->assignRole($staffBagian);
        // create demo users 9
        $user = \App\Models\User::factory()->create([
            'email' => 'staff2@kepegawaian.com',
        ]);
        $user->assignRole($staffBagian);
        // create demo users 10
        $user = \App\Models\User::factory()->create([
            'email' => 'staff3@kepegawaian.com',
        ]);
        $user->assignRole($staffBagian);
    }
}
