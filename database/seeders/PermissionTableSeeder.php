<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-add',
            'user-delete',
            'user-edit',
            'user-profile',

            'role-edit',
            'role-list',
            'role-add',
            'role-delete',
            
            'department-edit',
            'department-list',
            'department-add',
            'department-delete',

            'audit-trail',
        ];
        
        foreach($permissions as $p){
            Permission::create(['name'=>$p]);
        }
    }
}