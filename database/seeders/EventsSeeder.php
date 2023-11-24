<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $now = \Carbon\Carbon::now();
        $events = [
            [1,'Presentacion bebida'        , 'presentacion-bebida'     ,'descripcion','2022-10-12','2022-10-20','3','08:00:00','17:00:00','activo','1','127'],
        ]; 

        $events = array_map(function($event) use ($now) {
            return [
                'id' => $event[0],
                'name' => $event[1],
                'slug' => $event[2],
                'description' => $event[3],
                'start_date' => $event[4],
                'end_date' => $event[5],
                'number_days' => $event[6],
                'start_time' => $event[7],
                'time_end' => $event[8],
                'state' => $event[9],
                'sponsor_id' => $event[10],
                'city_id' => $event[11],
                'updated_at' => $now,
                'created_at' => $now,
            ];
         }, $events);

        \DB::table('events')->insert($events);
    }
}
