<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Lection;
use App\Models\Schedule;
use App\Models\Slot;
use App\Models\Speaker;
use App\Models\Stage;
use Illuminate\Http\Request;

/*
{
   "stages":[
      {
         "stage_id":"1",
         "title":"Main Stage",
         "location":"Main Hall",
         "max_capacity":500,
         "slots":[
            {
               "slot_id":"1",
               "day":"2024-07-01",
               "start_time":"09:00:00",
               "end_time":"09:50:00",
               "lection":{
                  "lection_id":"1",
                  "title":"The Future of Technology",
                  "short_desc":"The Future of Technology is a talk about the future of technology. This talk will cover the latest trends in technology and what we can expect to see in the future.",
                  "desc":"John Doe is a technology enthusiast. He has been working in the technology industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for technology.",
                  "image": "https://picsum.photos/300/200?image=60",
                  "capacity":100,
                  "speaker":{
                     "speaker_id":1,
                     "titul":"Ing.",
                     "first_name":"Sofia",
                     "last_name":" Taylor",
                     "company":"Google",
                     "occupation":"Designer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"sofia.taylor@google.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/4.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/4.jpg"
                  }
               }
            },
            {
               "slot_id":"2",
               "day":"2024-07-01",
               "start_time":"10:00:00",
               "end_time":"10:50:00",
               "lection":{
                  "lection_id":"2",
                  "title":"The Future of Business",
                  "short_desc":"The Future of Business is a talk about the future of business. This talk will cover the latest trends in business and what we can expect to see in the future.",
                  "desc":"Jane Doe is a business expert. She has been working in the business industry for over 10 years. She has worked with some of the biggest companies in the world. She is a well-known speaker and has spoken at many events around the world. She is known for her knowledge and passion for business.",
                  "image": "https://picsum.photos/300/200?image=59",
                  "capacity":300,
                  "speaker":{
                     "speaker_id":2,
                     "titul":"Mgr.",
                     "first_name":"Ava",
                     "last_name":"Jones",
                     "company":"Google",
                     "occupation":"Developer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"a.jones@google.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/1.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/1.jpg"
                  }
               }
            },
            {
               "slot_id":"3",
               "day":"2024-07-01",
               "start_time":"11:00:00",
               "end_time":"11:50:00",
               "lection":{
                  "lection_id":"3",
                  "title":"The Future of Marketing",
                  "short_desc":"The Future of Marketing is a talk about the future of marketing. This talk will cover the latest trends in marketing and what we can expect to see in the future.",
                  "desc":"Jack Doe is a marketing expert. He has been working in the marketing industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for marketing.",
                  "image": "https://picsum.photos/300/200?image=58",
                  "capacity":200,
                  "speaker":{
                     "speaker_id":3,
                     "titul":"Bc.",
                     "first_name":"Olivia",
                     "last_name":"Smith",
                     "company":"IBM",
                     "occupation":"Developer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"o.smith@ibm.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/2.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/2.jpg"
                  }
               }
            }
         ]
      },
      {
         "stage_id":"2",
         "title":"Second Stage",
         "location":"Small Hall",
         "max_capacity":100,
         "slots":[
            {
               "slot_id":"4",
               "day":"2024-07-01",
               "start_time":"09:00:00",
               "end_time":"09:50:00",
               "lection":{
                  "lection_id":"4",
                  "title":"The Future of Technology",
                  "short_desc":"The Future of Technology is a talk about the future of technology. This talk will cover the latest trends in technology and what we can expect to see in the future.",
                  "desc":"John Doe is a technology enthusiast. He has been working in the technology industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for technology.",
                  "image": "https://picsum.photos/300/200?image=55",
                  "capacity":100,
                  "speaker":{
                     "speaker_id":4,
                     "titul":"Ing.",
                     "first_name":"Mia",
                     "last_name":"Brown",
                     "company":"Microsoft",
                     "occupation":"Designer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"m.brown@microsoft.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/3.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/3.jpg"
                  }
               }
            },
            {
               "slot_id":"5",
               "day":"2024-07-02",
               "start_time":"10:00:00",
               "end_time":"10:50:00",
               "lection":{
                  "lection_id":"5",
                  "title":"The Future of Business",
                  "short_desc":"The Future of Business is a talk about the future of business. This talk will cover the latest trends in business and what we can expect to see in the future.",
                  "desc":"Jane Doe is a business expert. She has been working in the business industry for over 10 years. She has worked with some of the biggest companies in the world. She is a well-known speaker and has spoken at many events around the world. She is known for her knowledge and passion for business.",
                  "image": "https://picsum.photos/300/200?image=56",
                  "capacity":300,
                  "speaker":{
                     "speaker_id":5,
                     "titul":"Ing.",
                     "first_name":"Amelia",
                     "last_name":"Wilson",
                     "company":"Google",
                     "occupation":"Developer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"a.wilson@google.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/4.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/4.jpg"
                  }
               }
            },
            {
               "slot_id":"6",
               "day":"2024-07-02",
               "start_time":"11:00:00",
               "end_time":"11:50:00",
               "lection":{
                  "lection_id":"6",
                  "title":"The Future of Marketing",
                  "short_desc":"The Future of Marketing is a talk about the future of marketing. This talk will cover the latest trends in marketing and what we can expect to see in the future.",
                  "desc":"Jack Doe is a marketing expert. He has been working in the marketing industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for marketing.",
                  "image": "https://picsum.photos/300/200?image=57",
                  "capacity":200,
                  "speaker":{
                     "speaker_id":6,
                     "titul":"Ing.",
                     "first_name":"Emily",
                     "last_name":"Moore",
                     "company":"ESET",
                     "occupation":"Designer",
                     "short_desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "desc":"The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                     "email":"e.moore@eset.com",
                     "phone":"+02 596 355 32",
                     "facebook":"https://www.facebook.com",
                     "instagram":"https://www.instagram.com",
                     "linkedin":"https://www.linkedin.com",
                     "image":"https://cdn.vuetifyjs.com/images/lists/3.jpg",
                     "thumbnail":"https://cdn.vuetifyjs.com/images/lists/3.jpg"
                  }
               }
            }
         ]
      }
   ]
}
*/

class ScheduleController extends Controller
{
    //
    public function getCurrentEventSchedule(): \Illuminate\Http\JsonResponse
    {
        $stages = Stage::query()
            ->select(['stages.*','schedules.schedule_id'])
            ->join('schedules_has_stages', 'schedules_has_stages.stage_id', '=', 'stages.stage_id')
            ->join('schedules', 'schedules.schedule_id', '=', 'schedules_has_stages.schedule_id')
            ->join('events', 'events.event_id', '=', 'schedules.event_id')
            ->where('events.is_current', '=', true)
            ->get();
        $stages_data = [];
        foreach ($stages as $stage) {
            $stage_data = [
                'stage_id' => $stage->stage_id,
                'title' => $stage->title,
                'location' => $stage->location,
                'max_capacity' => $stage->max_capacity,
            ];
            $slots_data = [];
            $slots = Slot::query()
                ->select('slots.*')
                ->where('slots.stage_id', '=', $stage->stage_id)
                ->where('slots.schedule_id', '=', $stage->schedule_id)->get();
            foreach ($slots as $slot) {
                $slot_data = [
                    'slot_id' => $slot->slot_id,
                    'day' => $slot->day->format('Y-m-d'),
                    'start_time' => $slot->start_time->format('H:i:s'),
                    'end_time' => $slot->end_time->format('H:i:s'),
                ];
                $lection = Lection::query()
                    ->select('lections.*')
                    ->join('slots', 'slots.lection_id', '=', 'lections.lection_id')
                    ->where('slots.slot_id', '=', $slot->slot_id)->first();
                $lection_data = [
                    'lection_id' => $lection->lection_id,
                    'title' => $lection->title,
                    'short_desc' => $lection->short_desc,
                    'desc' => $lection->desc,
                    'image' => $lection->image,
                    'capacity' => $lection->capacity,
                ];
                $speaker = Speaker::query()
                    ->select('speakers.*')
                    ->join('lections_has_speakers', 'lections_has_speakers.speaker_id', '=', 'speakers.speaker_id')
                    ->where('lections_has_speakers.lection_id', '=', $lection->lection_id)
                    ->first();
                $speaker_data = [
                    'speaker_id' => $speaker->speaker_id,
                    'titul' => $speaker->titul,
                    'first_name' => $speaker->first_name,
                    'last_name' => $speaker->last_name,
                    'company' => $speaker->company,
                    'occupation' => $speaker->occupation,
                    'short_desc' => $speaker->short_desc,
                    'desc' => $speaker->desc,
                    'email' => $speaker->email,
                    'phone' => $speaker->phone,
                    'facebook' => $speaker->facebook,
                    'instagram' => $speaker->instagram,
                    'linkedin' => $speaker->linkedin,
                    'image' => $speaker->image,
                    'thumbnail' => $speaker->thumbnail
                ];
                $lection_data['speaker'] = $speaker_data;
                $slot_data['lection'] = $lection_data;
                $slots_data[] = $slot_data;
            }
            $stage_data['slots'] = $slots_data;
            $stages_data[] = $stage_data;
        }

        $schedule_data = [
            'stages' => $stages_data
        ];

        return response()->json($schedule_data);
    }
}
