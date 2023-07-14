<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $this->createBaseUsers();
        $this->runFactories();
    }

    public function createBaseUsers()
    {
         //Super Admin
         User::create([
            'first_name' => 'Admin',
            'last_name' => 'test',
            'email' => 'admin@test.com',
            'email_verified_at' => '2023-07-12 18:30:59',
            'email_verified' => 1,
            'password' => Hash::make('12345678'),
            'phone' => '12345678',
            'gender' =>'male',
            'address' => "Somewhere around the world.",
            'status' => User::STATUS_ACTIVE
        ])->assignRole('super_admin');

        //practitioner
        User::create([
            'first_name' => 'Doctor',
            'last_name' => 'test',
            'email' => 'doctor@test.com',
            'email_verified_at' => '2023-07-12 18:30:59',
            'email_verified' => 1,
            'password' => Hash::make('12345678'),
            'phone' => '12345678',
            'gender' =>'male',
            'state_issued_id_number' => '232123123',
            'professional_license_numbers' => '231231123',
            'professional_associations' => 'Degree',
            'category_id' =>1,
            'remote_service_offerings'=> '1',
            'on_demand_service_offerings' => '1',
            'address' => "Somewhere around the world.",
            'status' => User::STATUS_ACTIVE
        ])->assignRole('practitioner');

        //customer
        User::create([
            'first_name' => 'patient',
            'last_name' => 'test',
            'email' => 'patient@test.com',
            'email_verified_at' => '2023-07-12 18:30:59',
            'email_verified' => 1,
            'password' => Hash::make('12345678'),
            'phone' => '12345678',
            'gender' =>'male',
            'address' => "Somewhere around the world.",
            'status' => User::STATUS_ACTIVE
        ])->assignRole('patient');

    }
    public function runFactories()
    {
        User::factory()->count(5)->create()->each(function ($user) {
            $user->assignRole('practitioner');
        });

        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('patient');
        });
    }
}
