<?php

use App\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            $new_employee = new Employee();

            $new_employee->name = 'Dipendente' . ($i + 1);
            $new_employee->last_name = 'Dipendente' . ($i + 1);
            $new_employee->phone_number = 3331112225;
            $new_employee->production = 0;

            $new_employee->save();
        }
    }
}
