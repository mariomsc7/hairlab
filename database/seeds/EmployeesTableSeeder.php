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

            $new_employee->name = 'Dipendente-Name' . ($i + 1);
            $new_employee->last_name = 'Dipendente-Lastname' . ($i + 1);
            $new_employee->phone_number = (int) 333 . rand(1111111, 9999999);
            $new_employee->production = 0;

            $new_employee->save();
        }
    }
}
