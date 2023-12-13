<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\VacationRequest;
use App\Http\Requests\Store\StoreVacationPermissionRequest;

class VacationRequestControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    
    public function almacena_una_solicitud_de_vacaciones()
    {
        $this->withoutExceptionHandling();

      
        $user = User::where('email', 'joseenriqueguzmangomez@gmail.com')->first();
        $this->actingAs($user);
        $data = [
            
            'description' => 'Vacation request description',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'),
   
        ];
        $response = $this->post(route('admin.vacation_requests.store'), $data);

        $response->assertRedirect(route('admin.vacation_requests.index'));

        $this->assertDatabaseHas('vacation_request', $data);

    }
}
