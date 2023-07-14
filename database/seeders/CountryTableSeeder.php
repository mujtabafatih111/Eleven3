<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/jsonFile/country_state_city.json');
        $jsonData = file_get_contents($path);
       
        // Parse the JSON data into a PHP array
        $countries = json_decode($jsonData, true);
        
        foreach($countries as $data)
        {
            $countrires = Country::create([
                'name' => $data['name']
            ]);
            foreach($data['states'] as $state)
            {
                $statedata = State::create([
                    'country_id' => $countrires['id'],
                    'name' => $state['name'],
                ]);

                foreach($state['cities'] as $city)
                {
                    $city = City::create([
                        'state_id' => $statedata['id'],
                        'name'    => $city['name']
                    ]);
                }
            }
        }
    }
}