<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
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
                'phone_number' => 'required|unique:employees|size:10',
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $data = $request->all();
        $data['production'] = 0;

        $new_employee = new Employee();

        $new_employee->fill($data);
        $new_employee->save();

        return redirect()->route('admin.employees.index');
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
            $employee = Employee::find($id);
            if (!$employee) {
                abort(404);
            }
            return view('admin.employees.edit', compact('employee'));
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
                'phone_number' => ["required", Rule::unique('employees')->ignore($id), 'size:10'],
            ],
            [
                'required' => 'Il :attribute è richiesto!',
                'max' => 'Massimo :max numeri per :attribute',
                'unique' => ':attribute è già in uso',
                'size' => 'Inserisci :size numeri'
            ]
        );

        $data = $request->all();

        $employee = Employee::find($id);

        $employee->update($data);
    
        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('deleted', $employee->name.' '.$employee->last_name);
    }
}
