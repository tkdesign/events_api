<?php

namespace Database\Seeders;

use App\Models\Schedule;
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
                'title' => 'Schedule 2022',
                'event_id' => 1
            ],
            [
                'title' => 'Schedule 2023',
                'event_id' => 2
            ],
            [
                'title' => 'Schedule 2024',
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
