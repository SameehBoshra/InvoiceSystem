<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdmainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Sameeh Boshra',
            'email' => 'sameehb65@gmail.com',
            'password' => bcrypt('PasswordMo7a'),
            'roles_name' => ["owner"],
            'Status' => 'مفعل',
            ]);

            $role = Role::create(['name' => 'owner']);

            $permissions = Permission::pluck('id','id')->all();

            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);
    }
}
