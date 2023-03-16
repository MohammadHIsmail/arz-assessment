<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@arzgt.com',
            'password' => Hash::make('secret'),
            'name'=> 'admin',
            'phone'=> '00000000',
            'gender'=> 'male',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}