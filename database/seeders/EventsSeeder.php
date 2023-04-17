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
                'user_id' => 2
            ],
            [
                'title' => 'Festival de cine',
                'description' => 'Proyección de películas de todo el mundo y actividades relacionadas al cine',
                'date' => '2023-07-25',
                'location' => 'Cineteca Nacional',
                'user_id' => 2
            ],
            [
                'title' => 'Partido de futbol',
                'description' => 'Partido de la liga local entre los equipos más importantes',
                'date' => '2023-08-12',
                'location' => 'Estadio Olímpico Universitario',
                'user_id' => 3
            ],
            [
                'title' => 'Exposición de arte moderno',
                'description' => 'Muestra de obras de artistas contemporáneos',
                'date' => '2023-09-05',
                'location' => 'Museo de Arte Moderno',
                'user_id' => 3
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
