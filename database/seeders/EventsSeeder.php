<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Concierto de rock',
                'description' => 'Gran concierto de rock con bandas locales e internacionales',
                'date' => '2023-04-15',
                'location' => 'Estadio Azteca',
                'user_id' => 1
            ],
            [
                'title' => 'Feria de tecnología',
                'description' => 'Exposición de las últimas novedades en tecnología',
                'date' => '2023-05-20',
                'location' => 'Centro de Convenciones',
                'user_id' => 1
            ],
            [
                'title' => 'Conferencia de negocios',
                'description' => 'Charlas y talleres para emprendedores y empresarios',
                'date' => '2023-06-10',
                'location' => 'Hotel Marriott',
                'user_id' => 1
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
