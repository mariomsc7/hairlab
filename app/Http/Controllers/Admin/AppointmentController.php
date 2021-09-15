<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\Service;
use App\Employee;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Set Locale Time Language Carbon
setlocale(LC_TIME, 'it');

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::where('done', 0)->orderBy('start_time', 'desc')->paginate(10);

        // Format start_time to Carbon time
        foreach ($appointments as $appointment){
            $appointment->start_time = Carbon::parse($appointment->start_time);
        }
        
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::find($id);
        $employees = Employee::all();
        $services = Service::all();
        return view('admin.appointments.create', compact('services', 'employees', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'start_time' => 'required',
                'employee_id' => 'required',
                'client_id' => 'required',
                'services' => 'required|exists:services,id',
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $services = Service::pluck('price','id');

        $data = $request->all();
        $data['extra'] = intval($data['extra']);
        $data['tot_paid'] = $data['extra'];
        foreach($data['services'] as $service){
            $data['tot_paid'] += $services[$service];
        }

        $new_appointment = new Appointment();

        $new_appointment->fill($data);
        $new_appointment->save();

        $new_appointment->services()->attach($data['services']);

        return redirect()->route('admin.appointments.show', $new_appointment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);

        // Format start_time to Carbon time
        $appointment->start_time = Carbon::parse($appointment->start_time);
        
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $services = Service::all();
        $appointment = Appointment::find($id);
        return view('admin.appointments.edit', compact('services', 'employees', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'start_time' => 'required',
                'employee_id' => 'required',
                'services' => 'required|exists:services,id',
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $services = Service::pluck('price','id');

        $data = $request->all();
        $data['extra'] = intval($data['extra']);
        $data['tot_paid'] = $data['extra'];
        foreach($data['services'] as $service){
            $data['tot_paid'] += $services[$service];
        }
        
        $appointment = Appointment::find($id);

        $appointment->update($data);

        $appointment->services()->sync($data['services']);

        return redirect()->route('admin.appointments.show', $appointment->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->services()->detach();
        $appointment->delete();
        if($appointment->done){
            return redirect()->route('admin.appointments.done.index')->with('deleted', $appointment->client->last_name.' '.$appointment->client->name.' del '.$appointment->start_time);
        }
        return redirect()->route('admin.appointments.index')->with('deleted', $appointment->client->last_name.' '.$appointment->client->name.' del '.$appointment->start_time);
    }

    // Done
    public function doneIndex()
    {
        $appointments = Appointment::where('done', 1)->orderBy('start_time', 'desc')->paginate(10);

        // Format start_time to Carbon time
        foreach ($appointments as $appointment){
            $appointment->start_time = Carbon::parse($appointment->start_time);
        }

        return view('admin.done.index', compact('appointments'));
    }

    public function done($id){
        $appointment = Appointment::find($id);
        $appointment->done = 1;
        $appointment->update();

        $employee_id = $appointment->employee->id;
        $employee = Employee::find($employee_id);
        $employee->production += $appointment->tot_paid;
        $employee->update();
        
        return redirect()->route('admin.appointments.done.index');
    }
}

