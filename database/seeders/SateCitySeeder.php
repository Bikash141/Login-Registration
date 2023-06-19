<?php

namespace Database\Seeders;
use App\Models\State;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stateData = [
            ['name' => 'West Bengal'],
            ['name' => 'Andhra Pradesh'],
            ['name' => 'Bihar'],
            ['name' => 'Chhattisgarh'],
            ['name' => 'Goa'],
            ['name' => 'Gujarat'],
            ['name' => 'Haryana'],
            ['name' => 'Himachal Pradesh'],
            ['name' => 'Jharkhand'],
            
        ];
        
        $cityData = [
            ['state_name' => 'West Bengal', 'name' => 'Barrackpore'],
            ['state_name' => 'West Bengal', 'name' => 'Kolkata'],
            ['state_name' => 'Andhra Pradesh', 'name' => 'Amaravati'],
            ['state_name' => 'Andhra Pradesh', 'name' => 'Chandragiri'],
            ['state_name' => 'Bihar', 'name' => 'Begusarai'],
            ['state_name' => 'Bihar', 'name' => 'Bhagalpur'],
            ['state_name' => 'Bihar', 'name' => 'Bodh Gaya'],
            ['state_name' => 'Bihar', 'name' => 'Chapra'],
            ['state_name' => 'Bihar', 'name' => 'Dehri'],
            ['state_name' => 'Bihar', 'name' => 'Motihari'],
            ['state_name' => 'Bihar', 'name' => 'Purnia'],
            ['state_name' => 'Chhattisgarh', 'name' => 'Bilaspur'],
            ['state_name' => 'Chhattisgarh', 'name' => 'Dhamtari'],
            ['state_name' => 'Goa', 'name' => 'Madgaon'],
            ['state_name' => 'Goa', 'name' => 'Panaji'],
            ['state_name' => 'Gujarat', 'name' => 'Ahmadabad'],
            ['state_name' => 'Gujarat', 'name' => 'Bharuch'],
            ['state_name' => 'Gujarat', 'name' => 'Gandhinagar'],
            ['state_name' => 'Haryana', 'name' => 'Hansi'],
            ['state_name' => 'Haryana', 'name' => 'Kaithal'],
            ['state_name' => 'Haryana', 'name' => 'Kurukshetra'],
            ['state_name' => 'Himachal Pradesh', 'name' => 'Bilaspur'],
            ['state_name' => 'Himachal Pradesh', 'name' => 'Hamirpur'],
            ['state_name' => 'Himachal Pradesh', 'name' => 'Kangra'],
            ['state_name' => 'Himachal Pradesh', 'name' => 'Nahan'],
            ['state_name' => 'Jharkhand', 'name' => 'Dhanbad'],
            ['state_name' => 'Jharkhand', 'name' => 'Rajmahal'],
        
        
        ];
        
        // Create states and cities
        foreach ($stateData as $stateItem) {
            $state = State::create(['name' => $stateItem['name']]);
        
            $cities = array_filter($cityData, function ($cityItem) use ($stateItem) {
                return $cityItem['state_name'] === $stateItem['name'];
            });
        
            foreach ($cities as $cityItem) {
                City::create([
                    'state_id' => $state->id,
                    'name' => $cityItem['name'],
                ]);
            }
        }
    }
}
