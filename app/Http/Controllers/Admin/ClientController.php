<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Client;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Set Locale Time Language Carbon
setlocale(LC_TIME, 'it');

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = empty($_GET['search']) ? '' : $_GET['search'];

        if($query !== '' ){
            $clients = Client::where('name','LIKE','%'.$query.'%')->orWhere('last_name','LIKE','%'.$query.'%')->orderBy('last_name')->paginate(10);
        } else {
            $clients = Client::orderBy('created_at', 'desc')->paginate(10);
        }
        $clients->appends(['search' => $query]);
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
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
                'name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'phone_number' => 'required|unique:clients|size:10',
                'email' => 'max:30',
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $data = $request->all();

        $new_client = new Client();

        $new_client->fill($data);
        $new_client->save();

        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $client = Client::find($id);

        // Not Found
        if(!$client){
            abort(404);
        }
        
        $appointments = Appointment::where('client_id', $id)->where('done', 1)->paginate(10);
        // Format start_time to Carbon time
        foreach ($appointments as $appointment){
            $appointment->start_time = Carbon::parse($appointment->start_time);
        }

        return view('admin.clients.show', compact('client', 'appointments',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        // Not Found
        if(!$client){
            abort(404);
        }

        return view('admin.clients.edit', compact('client'));
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
                'name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'phone_number' => ['required', Rule::unique('clients')->ignore($id), 'size:10'],
                'email' => 'max:30',
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $data = $request->all();

        $client = Client::find($id);

        $client->update($data);
       

        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check Permission
        $user_id = Auth::id();
        if($user_id != 1){
            abort(403);
        }

        $client = Client::find($id);
        
        $client->delete();
        return redirect()->route('admin.clients.index')->with('deleted', $client->name.' '.$client->last_name);
    }
}
