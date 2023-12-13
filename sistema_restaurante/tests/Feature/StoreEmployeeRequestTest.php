<?php

namespace Tests\Unit\Requests\Store;

use Tests\TestCase;
use App\Http\Requests\Store\StoreEmployeeRequest;

class StoreEmployeeRequestTest extends TestCase
{
    /** @test */
    public function it_pasa_autorizacion()
    {
        $request = new StoreEmployeeRequest();

        $this->assertTrue($request->authorize());
    }

    /** @test */
    public function  it_valida_con_datos_correctos()
    {
        $request = new StoreEmployeeRequest();

      
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '123456789',
            'email' => 'john@example.com',
        ];

     
        $validator = validator($data, $request->rules());
        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function falla_validacion_con_numeros_en_nombre()
    {
        $request = new StoreEmployeeRequest();

      
        $data = [
            'first_name' => 123, 
            'last_name' => 'Doe',
            'phone' => '123456789',
            'email' => 'john@example.com',
        ];

       
        $validator = validator($data, $request->rules());
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('first_name', $validator->errors()->toArray());
    }
}
