<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use DB;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected function createSubCategories() {
        //Sub-categories for General Medicine:
        SubCategory::create([
            'category_id' => '1',
            'name' => 'Internal Medicine',
            'slug' => 'internal-medicine',
            
        ]);
        SubCategory::create([
            'category_id' => '1',
            'name' => 'Family Medicine',
            'slug' => 'family-medicine',
            
        ]);
        //Sub-categories for Pediatrics:
        SubCategory::create([
            'category_id' => '2',
            'name' => 'Pediatrician',
            'slug' => 'pediatrician',
            
        ]);
        SubCategory::create([
            'category_id' => '2',
            'name' => 'Neonatology',
            'slug' => 'neonatology',
            
        ]);
        //Sub-categories for Cardiology:
        SubCategory::create([
            'category_id' => '3',
            'name' => 'Cardiologist',
            'slug' => 'cardiologist',
            
        ]);
        SubCategory::create([
            'category_id' => '3',
            'name' => 'Interventional Cardiology',
            'slug' => 'interventional-cardiology',
            
        ]);  
        //Sub-categories for Dermatology:
        SubCategory::create([
            'category_id' => '4',
            'name' => 'Dermatologist',
            'slug' => 'dermatologist',
            
        ]);
        SubCategory::create([
            'category_id' => '4',
            'name' => 'Cosmetology',
            'slug' => 'cosmetology',
            
        ]);  
        //Sub-categories for Orthopedics:
        SubCategory::create([
            'category_id' => '5',
            'name' => 'Orthopedic Surgeon',
            'slug' => 'orthopedic-surgeon',
            
        ]);
        SubCategory::create([
            'category_id' => '5',
            'name' => 'Sports Medicine',
            'slug' => 'sports-medicine',
            
        ]);  
        //Sub-categories for Gynecology:
        SubCategory::create([
            'category_id' => '6',
            'name' => 'Gynecologist',
            'slug' => 'gynecologist',
            
        ]);
        SubCategory::create([
            'category_id' => '6',
            'name' => 'Obstetrics',
            'slug' => 'obstetrics',
            
        ]);  
        //Sub-categories for Ophthalmology:
        SubCategory::create([
            'category_id' => '7',
            'name' => 'Ophthalmologist',
            'slug' => 'ophthalmologist',
            
        ]);
        SubCategory::create([
            'category_id' => '7',
            'name' => 'Optometry',
            'slug' => 'optometry',
            
        ]);  
        //Sub-categories for Dentistry:
        SubCategory::create([
            'category_id' => '8',
            'name' => 'Dentist',
            'slug' => 'dentist',
            
        ]);
        SubCategory::create([
            'category_id' => '8',
            'name' => 'Oral and Maxillofacial Surgery',
            'slug' => 'oral-and-maxillofacial-surgery',
            
        ]);  
        //Sub-categories for Psychiatry:
        SubCategory::create([
            'category_id' => '9',
            'name' => 'Psychiatrist',
            'slug' => 'psychiatrist',
            
        ]);
        SubCategory::create([
            'category_id' => '9',
            'name' => 'Psychotherapy',
            'slug' => 'psychotherapy',
            
        ]); 
        //Sub-categories for Neurology: 
        SubCategory::create([
            'category_id' => '10',
            'name' => 'Neurologist',
            'slug' => 'neurologist',
            
        ]);
        SubCategory::create([
            'category_id' => '10',
            'name' => 'Neurosurgery',
            'slug' => 'neurosurgery',
            
        ]);
    }
    public function run(): void
    {
        $this->createSubCategories();
    }
}
