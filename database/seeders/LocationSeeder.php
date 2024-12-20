<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Opera Graz'],
            ['name' => 'Royal Albert Hall'],
            ['name' => 'Sydney Opera House'],
            ['name' => 'Carnegie Hall']
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
