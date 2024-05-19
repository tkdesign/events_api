<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Schedule;
use App\Models\Slot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $slots = [
            [
                'day' => '2024-07-01',
                'start_time' => '09:00:00',
                'end_time' => '09:50:00',
                'stage_id' => '1',
                'lection_id' => '1'
            ],
            [
                'day' => '2024-07-01',
                'start_time' => '10:00:00',
                'end_time' => '10:50:00',
                'stage_id' => '1',
                'lection_id' => '2'
            ],
            [
                'day' => '2024-07-01',
                'start_time' => '11:00:00',
                'end_time' => '11:50:00',
                'stage_id' => '1',
                'lection_id' => '3'
            ],
            [
                'day' => '2024-07-01',
                'start_time' => '09:00:00',
                'end_time' => '09:50:00',
                'stage_id' => '2',
                'lection_id' => '4'
            ],
            [
                'day' => '2024-07-02',
                'start_time' => '10:00:00',
                'end_time' => '10:50:00',
                'stage_id' => '2',
                'lection_id' => '5'
            ],
            [
                'day' => '2024-07-02',
                'start_time' => '11:00:00',
                'end_time' => '11:50:00',
                'stage_id' => '2',
                'lection_id' => '6'
            ]
        ];

        Schema::disableForeignKeyConstraints();

        $event = Event::where('is_current', true)->first();
        if ($event) {
            $event_id = $event->event_id;
            $schedule = Schedule::where('event_id', $event_id)->first();
            if ($schedule) {
                Slot::truncate();
                foreach ($slots as $slot) {
                    $slot['schedule_id'] = $schedule->schedule_id;
                    Slot::create($slot);
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
