<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    //
    public function getCurrentEventSpeakers(): \Illuminate\Http\JsonResponse
    {
        $speakers = Speaker::query()
            ->select('speakers.*')
            ->join('lections_has_speakers', 'speakers.speaker_id', '=', 'lections_has_speakers.speaker_id')
            ->join('lections', 'lections.lection_id', '=', 'lections_has_speakers.lection_id')
            ->join('slots', 'slots.lection_id', '=', 'lections.lection_id')
            ->join('schedules', 'schedules.schedule_id', '=', 'slots.schedule_id')
            ->join('events', 'events.event_id', '=', 'schedules.event_id')
            ->where('events.is_current', true)
            ->get();
        $speakers_data = [
            'speakers' => $speakers
        ];
        return response()->json($speakers_data);
    }
}
