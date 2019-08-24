<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];

    	$this->validate($request, $rules);
    	//dd($request->all());

    	$date = $request->input('date');
    	$dateCarbon = new Carbon($date);
    	$day = $dateCarbon->day;
    	$dayOfWeek = $dateCarbon->dayOfWeek; //Sunday 0, Monday 1, ... Saturday 6
    	$dayOfWeekIso = $dateCarbon->dayOfWeekIso; //Monday 1, ... Saturday 6, Sunday 7
    	//dd($dayOfWeekIso);

    	$doctorId = $request->input('doctor_id');

    	$workDay = WorkDay::where('active', True)
    			->where('day', $dayOfWeek)
    			->where('user_id', $doctorId)
    			->first([
    				'morning_start',
    				'morning_end',
    				'afternoon_start',
    				'afternoon_end'
    			]);

    	if (!$workDay)
    		return [];

    	$amIntervals = $this->getIntervals($workDay->morning_start, $workDay->morning_end, 30);
    	$pmIntervals = $this->getIntervals($workDay->afternoon_start, $workDay->afternoon_end, 30);

    	$data=[];
    	$data['am'] = $amIntervals;
    	$data['pm'] = $pmIntervals;
    	return $data;

    	// if ($workDays)
    	// 	dd($workDays->toArray());

    }

    private function getIntervals($start, $end, $intervalMins)
    {
    	$start = new Carbon($start);
    	$end = new Carbon($end);

    	$intervals = [];
    	while($start<$end) {
    		$interval = [];

    		$interval['start'] = $start->format('g:i A');
    		$start->addMinutes($intervalMins);
    		$interval['end'] = $start->format('g:i A');

    		$intervals [] = $interval;
    	}
    	return $intervals;
    }
}


