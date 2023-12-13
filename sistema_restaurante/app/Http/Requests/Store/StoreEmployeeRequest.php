<?php

namespace App\Http\Requests\Store;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreEmployeeRequest extends FormRequest
{
  
    public function authorize()
    {
       // abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //ESTA DESABILITADO PARA EL USO DE LAS PREUBAS UNITARIAS
        return true;
    }

    public function rules()
    {
        return [
          
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'nullable',
                'string', 
               
            ],
            'email' => [
                'nullable',
                'email',
                'max:50',
            ],
        ];
    }
}
