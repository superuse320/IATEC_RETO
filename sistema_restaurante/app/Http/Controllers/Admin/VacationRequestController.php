<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Store\StoreVacationPermissionRequest;
use App\Models\VacationRequest;
use Gate;
use Carbon\Carbon;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class VacationRequestController extends Controller

{
    use MediaUploadingTrait;
    public function index()
    {
        if (Gate::denies('vacation_request_access')) {
            return view('errors.403');
        }
    $user = Auth::user();
    if ($user->is_administrator) {
      
        $vacationRequests = VacationRequest::all();
    } else {
    
        $employee = Employee::where('user_id', $user->id)->first();
        $vacationRequests = VacationRequest::where('employee_id', $employee->id)->get();
    }
  
    return view('admin.vacation_requests.index', compact('vacationRequests'));
    }
    public function create()
{
    
    abort_if(Gate::denies('vacation_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $user = Auth::user();
    if ($user->is_administrator) {
      
        return redirect()->route('admin.vacation_requests.index')->withInput()->withErrors(['error' => 'Solo los empleados puedes solicitar vacaciones']);
    }
    $employee = Employee::where('user_id', $user->id)->first();
    $yearsOfService = Carbon::parse($employee->start_date)->diffInYears(now());
    if ($yearsOfService >= 11) {
        $vacationDays = 30;
    } elseif ($yearsOfService >= 6) {
        $vacationDays = 20;
    } else {
        $vacationDays = 15;
    }
    if ($yearsOfService < 1) {
       
      
        return redirect()->route('admin.vacation_requests.index')->withInput()->withErrors(['error' => 'Aún no eres elegible para vacaciones']);
    }
    $vacationDays=$vacationDays +1;
    $availableVacationDates = $this->calculateAvailableVacationDates($user, $vacationDays);


    return view('admin.vacation_requests.create', compact('availableVacationDates','vacationDays'));
}
private function calculateAvailableVacationDates($user, $vacationDays)
{
    $existingVacationDates = $user->vacation_requests ? $user->vacation_requests->pluck('start_date', 'end_date') : collect();
    $availableVacationDates = [];
    $startDate = now()->addDay();

    while (count($availableVacationDates) < $vacationDays) {
        $endDate = $startDate->copy()->addDays(40);  
        if ($this->isDateFarEnoughFromLastRequest($existingVacationDates, $startDate)) {
            $availableVacationDates[] = $startDate->format('Y-m-d');
        }

        $startDate = $endDate->copy()->addDay();  
    }

    return $availableVacationDates;
}

private function isDateFarEnoughFromLastRequest($existingVacationDates, $proposedStartDate)
{
    $minimumDaysBetweenRequests = 40;  
    foreach ($existingVacationDates as $date => $endDate) {
        $existingEndDate = Carbon::parse($endDate);
        $proposedEndDate = $proposedStartDate->copy()->addDays($minimumDaysBetweenRequests);

        if ($proposedEndDate->greaterThanOrEqualTo($existingEndDate)) {
            return false;
        }
    }
    return true;
}
public function store(StoreVacationPermissionRequest $request)
{
    $user = Auth::user();
    $employee = Employee::where('user_id', $user->id)->first();
    $vacationRequest = VacationRequest::create([
        'employee_id' => $employee->id,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => date('Y-m-d', strtotime($request->end_date)),
        'status' => 'pending', 
    ]);
    return redirect()->route('admin.vacation_requests.index');
}
public function show(VacationRequest $vacationRequest)
{
    abort_if(Gate::denies('vacation_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return view('admin.vacation_requests.show', compact('vacationRequest'));
}


}
