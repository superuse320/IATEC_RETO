<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeObserver
{
    public function created(Employee $employee)
    {
        // Crea el usuario asociado al empleado
        $user = User::create([
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'email' => $employee->email,
            'username' => $employee->email,
            'password' => Hash::make($employee->first_name . $employee->last_name)
        ]);

        // Establece el rol apropiado para los empleados
        $employeeRole = 12; // Reemplaza con el ID real del rol para empleados
        $user->roles()->sync($employeeRole);

        // Asigna el ID del usuario al empleado y guarda los cambios
        $employee->user_id = $user->id;
        $employee->save();
    }
}
