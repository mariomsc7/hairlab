<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
        // $appointments = Appointment::where('done', 0)->get();
        $events = [];
        foreach ($appointments as $appointment){
            $event = [];
            $event['start'] = $appointment->start_time;
            $event['end'] = $appointment->end_time;
            $event['title'] = $appointment->client->name . ' ' . $appointment->client->last_name;
            $event['split'] = $appointment->employee->id;
            $event['content'] = $appointment->comment;
            $event['extendedProps'] =  ['status' => $appointment->done];
            $events[] = $event;
        }
        return response()->json($events);
    }
}