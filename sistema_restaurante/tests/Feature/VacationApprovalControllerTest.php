<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\VacationRequest;
use App\Http\Controllers\Admin\VacationApprovalController;

class VacationApprovalControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    public function it_approves_a_vacation_request()
    {
        $this->withoutExceptionHandling();

      
        $user = User::where('email', 'joseenriqueguzmangomez@gmail.com')->first();
        $this->actingAs($user);

        $vacationRequest = VacationRequest::create([
            'user_id' => $user->id,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'),
            'status' => 'pending',
        ]);

       
        $controller = new VacationApprovalController();

     
        $response = $controller->approve($vacationRequest);


        $this->assertEquals('approved', $vacationRequest->fresh()->status);

      
        $response->assertRedirect(route('admin.vacation_requests.index'));
    }
}
