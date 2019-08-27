<?php namespace App\Services;

use App\WorkDay;
use Carbon\Carbon;

use App\Interfaces\ScheduleServiceInterface;

use App\Appointment;

class ScheduleService implements ScheduleServiceInterface
{
	public function isAvailableInterval($date, $doctorId, Carbon $start)
	{
		$exists = Appointment::where('doctor_id', $doctorId)
    					->where('scheduled_date', $date)
    					->where('scheduled_time', $start->format('H:i:s'))
    					->exists();

    	return !$exists;
	}

    public function getAvailableIntervals($date, $doctorId, $intervalMins)
    {
		$workDay = WorkDay::where('active', True)
    			->where('day', $this->getDayFromDate($date))
    			->where('user_id', $doctorId)
    			->first([
    				'morning_start',
    				'morning_end',
    				'afternoon_start',
    				'afternoon_end'
    			]);

    	if (!$workDay)
    		return [];

    	$amIntervals = $this->getIntervals($workDay->morning_start, $workDay->morning_end, $intervalMins, $date, $doctorId);
    	$pmIntervals = $this->getIntervals($workDay->afternoon_start, $workDay->afternoon_end, $intervalMins, $date, $doctorId);

    	$data=[];
    	$data['am'] = $amIntervals;
    	$data['pm'] = $pmIntervals;

    	return $data;
    }

	private function getDayFromDate($date)
	{
    	$dateCarbon = new Carbon($date);
    	$day = $dateCarbon->day;
    	$dayOfWeek = $dateCarbon->dayOfWeek; //Sunday 0, Monday 1, ... Saturday 6
    	$dayOfWeekIso = $dateCarbon->dayOfWeekIso; //Monday 1, ... Saturday 6, Sunday 7

    	return $dayOfWeek;
	}

	private function getIntervals($start, $end, $intervalMins, $date, $doctorId)
    {
    	$start = new Carbon($start);
    	$end = new Carbon($end);

    	$intervals = [];
    	while($start<$end) {
    		$interval = [];

    		$interval['start'] = $start->format('g:i A');

    		//Verificar si esa hora ya está ocupada para ese médico
    		$available = $this->isAvailableInterval($date, $doctorId, $start);

    		$start->addMinutes($intervalMins);
    		$interval['end'] = $start->format('g:i A');

    		if ($available) {
    			$intervals [] = $interval;
    		}
    	}
    	return $intervals;
    }
}