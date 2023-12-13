<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Http\Requests\Store\StoreEmployeeRequest;

class EmployeeControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    public function registrar_un_empleado()
    {
        $this->withoutExceptionHandling();

      
        $user = User::where('email', 'admin@admin.com')->first();
        $this->actingAs($user);

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => $this->faker->phoneNumber,
            'email' => 'john.doe@example.com',
        ];

        $response = $this->post(route('admin.employees.store'), $data);

        $response->assertRedirect(route('admin.employees.index'));

        $this->assertDatabaseHas('employees', $data);
    }
}
