<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Concerts;
class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $concerts = [
            [
                'artist' => 'Opus',
                'location_id' => 1
            ],
            [
                'artist' => 'Mozart Symphony',
                'location_id' => 2
            ],
            [
                'artist' => 'Jazz Ensemble',
                'location_id' => 3
            ],
            [
                'artist' => 'Rock Band',
                'location_id' => 4
            ]
        ];

        foreach ($concerts as $concert) {
            Concerts::create($concert);
        }
    }
}
