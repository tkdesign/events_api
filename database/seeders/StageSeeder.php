<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\ScheduleHasStage;
use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stages = [
            [
                'title' => 'Main Stage',
                'location' => 'Main Hall',
                'max_capacity' => 500,
            ],
            [
                'title' => 'Second Stage',
                'location' => 'Small Hall',
                'max_capacity' => 100,
            ],
        ];

        Schema::disableForeignKeyConstraints();
        Stage::truncate();

        foreach ($stages as $stage) {
            Stage::create($stage);
        }

        $schedule_rows = Schedule::all();
        $stage_rows = Stage::all();
        foreach ($schedule_rows as $schedule) {
            $i = 1;
            foreach ($stage_rows as $stage) {
                ScheduleHasStage::create([
                    'schedule_id' => $schedule->schedule_id,
                    'stage_id' => $stage->stage_id,
                    'visible' => 1,
                    'position' => $i
                ]);
                $i++;
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
