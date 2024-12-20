<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Show;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shows = [
            [
                'concerts_id' => 1,
                'start' => '2021-10-02 20:00:00',
                'end' => '2021-10-02 23:00:00'
            ],
            [
                'concerts_id' => 1,
                'start' => '2021-10-03 19:00:00',
                'end' => '2021-10-03 22:00:00'
            ],
            [
                'concerts_id' => 2,
                'start' => '2021-11-15 18:30:00',
                'end' => '2021-11-15 21:30:00'
            ],
            [
                'concerts_id' => 3,
                'start' => '2021-12-20 19:00:00',
                'end' => '2021-12-20 22:00:00'
            ],
            [
                'concerts_id' => 4,
                'start' => '2022-01-10 20:00:00',
                'end' => '2022-01-10 23:00:00'
            ]
        ];

        foreach ($shows as $show) {
            Show::create($show);
        }
    }
}
