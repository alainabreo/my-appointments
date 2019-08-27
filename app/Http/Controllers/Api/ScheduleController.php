<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Interfaces\ScheduleServiceInterface;

use App\WorkDay;
use App\User;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];

    	$this->validate($request, $rules);

    	$date = $request->input('date');
    	$doctorId = $request->input('doctor_id');

        $doctor = User::where('active', True)
                ->where('id', $doctorId)
                ->first(['interval']);
        $intervalMins = $doctor->interval;

		if (!$intervalMins) {
			$intervalMins = env('DOCTOR_DEFAULT_INTERVAL', 30);  
		}

    	return $scheduleService->getAvailableIntervals($date, $doctorId, $intervalMins);
    }
}