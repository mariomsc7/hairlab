<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\Service;
use App\Employee;
use App\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
        
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $employees = Employee::all();
        $services = Service::all();
        return view('admin.appointments.create', compact('services', 'employees', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'start_time' => 'required|max:30',
        //         'end_time' => 'required|max:30',
        //         'phone_number' => 'required|unique:clients|size:10',
        //         'email' => 'required|max:30',
        //     ],
        //     [
        //         'required' => 'Il :attribute è richiesto!',
        //         'max' => 'Massimo :max numeri per :attribute',
        //         'unique' => ':attribute è già in uso',
        //         'size' => 'Inserisci :size numeri'
        //     ]
        // );

        // $data = $request->all();

        // $new_client = new Client();

        // $new_client->fill($data);
        // $new_client->save();

        // return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
