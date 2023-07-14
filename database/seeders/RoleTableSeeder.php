<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // super admin will bypass all the permissions checks from AuthServiceProvider
         Role::create(['name' => 'super_admin', 'guard_name' => 'api']);

         Role::create(['name' => 'practitioner', 'guard_name' => 'api']);
 
         Role::create(['name' => 'patient', 'guard_name' => 'api']);
    }
}
