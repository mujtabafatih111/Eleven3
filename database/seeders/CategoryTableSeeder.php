<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function createCategory()  {
        Category::create([
            'name' => 'General Medicine',
            'slug' => 'general medicine',
            'status'=> Category::STATUS_ACTIVE,
             
        ]);

        Category::create([
            'name' => 'Pediatrics',
            'slug' => 'Pediatrics',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Cardiology',
            'slug' => 'cardiology',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Dermatology',
            'slug' => 'dermatology',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Orthopedics',
            'slug' => 'orthopedics',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Gynecology',
            'slug' => 'gynecology',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Ophthalmology',
            'slug' => 'ophthalmology',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Dentistry',
            'slug' => 'dentistry',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Psychiatry',
            'slug' => 'psychiatry',
            'status'=> Category::STATUS_ACTIVE
            
        ]);

        Category::create([
            'name' => 'Neurology',
            'slug' => 'neurology',
            'status'=> Category::STATUS_ACTIVE
            
        ]);
    }
    public function run(): void
    {
        $this->createCategory();
    }

    
}
