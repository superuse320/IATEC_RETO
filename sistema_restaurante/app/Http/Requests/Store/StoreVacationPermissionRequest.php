<?php

namespace App\Http\Requests\Store;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVacationPermissionRequest extends FormRequest
{
    public function authorize()
    {
        //abort_if(Gate::denies('vacation_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
          
            'user_id' => [
                'interger',
            
            ],
            'employee_id '=>[
                'interger',
            ],
       
            'start_date' => [
                'date',
                'nullable',
            ],
           
            'end_date' => [
                'date',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
                'in:pending,approved,rejected',
                'default:pending', 
            ],
            'description'=>[
                'string',
                'required',
            ],
            
         
          
        ];
    }
}
