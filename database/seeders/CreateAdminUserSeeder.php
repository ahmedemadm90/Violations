<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => '1007',
            'name' => 'Ahmed Emad',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('112233'),
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        $role = Role::create(['name' => 'Violations']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user = User::create([
            'id' => '1000',
            'name' => 'Mohamed Ameen',
            'email' => 'm.ameen@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '1001',
            'name' => 'Mohamed Yassen',
            'email' => 'm.yassen@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '1002',
            'name' => 'Mohamed Abdallah',
            'email' => 'm.abdallah@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '1003',
            'name' => 'Mohamed Gamal',
            'email' => 'm.gamal@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '1004',
            'name' => 'Reham Mohamed',
            'email' => 'r.mohamed@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '1008',
            'name' => 'Mostafa Essmat',
            'email' => 'm.essmat@esoc.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user = User::create([
            'id' => '9000',
            'name' => 'Gate 1',
            'email' => 'gate1@security.com',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole([$role->id]);
    }
}
