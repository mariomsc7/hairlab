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
            $event['title'] = $appointment->client->last_name . ' ' . $appointment->client->name . ' - Dipendente: ' . $appointment->employee->name;
            $event['start'] = $appointment->start_time;
            $event['end'] = $appointment->end_time;
            $event['extendedProps'] =  ['status' => $appointment->done];
            $events[] = $event;
        }
        return response()->json($events);
    }
}