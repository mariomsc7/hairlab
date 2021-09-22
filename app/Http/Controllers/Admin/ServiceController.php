<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all()->sortBy('price');
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
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
                    'name' => 'required|max:50',
                    'price' => 'required|numeric|max:999',
                ],
                [
                    'required' => 'Il :attribute è richiesto!',
                    'max' => 'Massimo :max numeri per :attribute',
                ]
            );
    
            $data = $request->all();
    
            $new_service = new Service();

            $new_service->fill($data);
            $new_service->save();
    
            return redirect()->route('admin.services.index');
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
            $service = Service::find($id);

            // Not Found
            if(!$service){
                abort(404);
            }

            // Check Permission
            $user_id = Auth::id();
            if($user_id != 1){
                abort(403);
            }

            return view('admin.services.edit', compact('service'));
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
                    'name' => 'required|max:50',
                    'price' => 'required|numeric|max:999',
                ],
                [
                    'required' => 'Il :attribute è richiesto!',
                    'max' => 'Massimo :max numeri per :attribute',
                ]
            );
    
            $data = $request->all();
    
            $service = Service::find($id);
    
            $service->update($data);
    
            return redirect()->route('admin.services.index');
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
        
        $service = Service::find($id);
        $service->appointments()->detach();


        $service->delete();
        return redirect()->route('admin.services.index')->with('deleted', $service->name);
    }
}
