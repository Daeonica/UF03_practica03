<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendee;


class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Attendee::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'event_id' => 1,
        ]);

        Attendee::create([
            'name' => 'María Gómez',
            'email' => 'maria@example.com',
            'event_id' => 2,
        ]);
    }
}
