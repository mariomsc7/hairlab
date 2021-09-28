<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::where('done', 0)->get();
        $events = [];
        foreach ($appointments as $appointment){
            $event = [];
            $event['title'] = $appointment->client->name;
            $event['start'] = $appointment->start_time;
            $event['end'] = $appointment->end_time;
            $events[] = $event;
        }
        return response()->json($events);
    }
}