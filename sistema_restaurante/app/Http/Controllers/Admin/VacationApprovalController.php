<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VacationRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VacationApprovalController extends Controller
{
  
    public function approve(VacationRequest $vacationRequest)
    {
        abort_if(Gate::denies('vacation_approval'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
    
        $approverUserId = auth()->user()->id;
    
        $vacationRequest->update([
            'status' => 'approved',
            'user_id' => $approverUserId,
        ]);
    
        return back();
    }
    
    public function reject(VacationRequest $vacationRequest)
    {
        abort_if(Gate::denies('vacation_approval'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
       
        $rejectorUserId = auth()->user()->id;
    
        $vacationRequest->update([
            'status' => 'rejected',
            'user_id' => $rejectorUserId,
        ]);
        return back();
    }
    

}
