<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'omarbadr',
            'email' => 'omar@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $role = Role::create(['name' => 'Admin']);
        
        $permissions = Permission::pluck('id','id')->all();
        dd($permissions);
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
