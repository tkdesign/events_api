<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $schedules = [
            [
                'event_id' => 1
            ],
            [
                'event_id' => 2
            ],
            [
                'event_id' => 3
            ]
        ];
        Schema::disableForeignKeyConstraints();
        Schedule::truncate();

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        Schema::enableForeignKeyConstraints();
    }
}
