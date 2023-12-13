<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MassDestroy\MassDestroyEmployeeRequest;
use App\Http\Requests\Store\StoreEmployeeRequest;
use App\Http\Requests\Update\UpdateEmployeeRequest;
use App\Models\Employee;
use Gate;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
class EmployeeController extends Controller
{
    use MediaUploadingTrait;
    public function index()
    {
        if (Gate::denies('employee_access')) {
            return view('errors.403');
        }
       
        $employees = Employee::all();

        return view('admin.employees.index', compact('employees'));
    }

  
    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.employees.create');
    }

  
    public function store(StoreEmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
    

            $request->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('employees')],
            ]);
    
      
            $employee = Employee::create($request->all());
    
            DB::commit();
    
            return redirect()->route('admin.employees.index');
        } catch (\Exception $e) {
            DB::rollback();
    
          
            return redirect()->back()->withInput()->withErrors(['error' => 'Hubo un error al crear el empleado. Por favor, inténtelo de nuevo.']);
        }
    }


    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.employees.show', compact('employee'));
    }

  
    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.employees.edit', compact('employee'));
    }
   
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->all();
    
       
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d H:i:s');
    
        $employee->update($data);
    
        return redirect()->route('admin.employees.index');
    }
    

  
    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
