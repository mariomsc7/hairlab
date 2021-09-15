<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Employee;
use App\Appointment;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

// Set Locale Time Language
setlocale(LC_TIME, 'it');

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
        $employee = Employee::find($id);
        $appointments = Appointment::where('employee_id', $id)->orderBy('start_time', 'desc')->paginate(10);

        // Format start_time to Carbon time
        foreach ($appointments as $appointment){
            $appointment->start_time = Carbon::parse($appointment->start_time);
        }

        // Production
        $query = empty($_GET['month']) ? '' : $_GET['month'];
        
        $report = Appointment::selectRaw("EXTRACT(YEAR_MONTH FROM start_time) as month, sum(tot_paid) as sum")
                            ->where('employee_id', $id)
                            ->where('done', 1)
                            ->groupBy("month")
                            ->pluck('sum', 'month');
                            
        $report_arr = [];
        foreach ($report as $key => $item){
            $report_arr[$key] = $item;
        }
        
        $total = $employee->production;

        if($query !== '' && $query !== '0'){

            $query_mod = str_replace('-', '', $query);

            if(array_key_exists($query_mod, $report_arr)){
                $total = $report_arr[$query_mod];
            } else {
                $total = 0;
            }
        }
        
        return view('admin.employees.show', compact('employee', 'appointments', 'total', 'query'));
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
                'phone_number' => ['required', Rule::unique('employees')->ignore($id), 'size:10'],
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
