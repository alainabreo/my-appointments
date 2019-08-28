<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Specialty;
use App\Appointment;
use App\User;
use App\CancelledAppointment;

use App\Interfaces\ScheduleServiceInterface;

use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {

        $pendingAppointments = Appointment::where('status', 'Reserved')
                ->where('patient_id', auth()->id())
                ->paginate(10);
        $confirmedAppointments = Appointment::where('status', 'Confirmed')
                ->where('patient_id', auth()->id())
                ->paginate(10);
        $oldAppointments = Appointment::whereIn('status', ['Attended', 'Canceled'])
                ->where('patient_id', auth()->id())
                ->paginate(10);

        //$appointments = Appointment::where('patient_id', auth()->id())->paginate(10);

        return view('appointments.index', 
            compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments')
        );
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {
    	$specialties = Specialty::all();

    	//Si hay valores old
    	$specialtyId = old('specialty_id');
    	if ($specialtyId) {
    		$specialty = Specialty::find($specialtyId);
    		$doctors = $specialty->users;
    	} else {
    		$doctors = collect();
    	}

    	$date = old('scheduled_date');
    	$doctorId = old('doctor_id');

    	if ($date && $doctorId) {
    		    		
	        $doctor = User::where('active', True)
	                ->where('id', $doctorId)
	                ->first(['interval']);
	        $intervalMins = $doctor->interval;

			if (!$intervalMins) {
				$intervalMins = env('DOCTOR_DEFAULT_INTERVAL', 30);
			}

    		$intervals = $scheduleService->getAvailableIntervals($date, $doctorId, $intervalMins);
    	} else {
    		$intervals = null;
    	}
    	
    	return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	//dd($request->all());

    	$rules = [
	        'specialty_id' => 'required|exists:specialties,id',
	        'doctor_id' => 'required|exists:users,id',
	        'scheduled_date' => 'required',
	        'scheduled_time' => 'required',
	        'type' => 'required',
	        'description' => 'required'    		
    	];

    	$messages = [
    		'specialty_id.required' => 'Please select a valid specialty',
    		'doctor_id.required' => 'Please select a valid doctor',
    		'scheduled_date.required' => 'Please select a valid date',
    		'scheduled_time.required' => 'Please select a valid time',
    		'type.required' => 'Please select a valid type',
    		'description.required' => 'Please select a valid description'
    	];

    	// Validator Block
    	//$this->validate($request, $rules, $messages);

    	$validator = Validator::make($request->all(), $rules, $messages);

		$validator->after(function ($validator) use ($request, $scheduleService) {
			$date = $request->input('scheduled_date');
			$doctorId = $request->input('doctor_id');
			$scheduled_time = $request->input('scheduled_time');

			if ($date && $doctorId && $scheduled_time) {
				$start = new Carbon($scheduled_time);
			} else {
				return;
			}

		    if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
		        $validator->errors()
		        	->add('scheduled_time', 'Selected time is not available!, please select other hour');
		    }
		});

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // End Validator Block

    	$data = $request->only([
	        'specialty_id',
	        'doctor_id',
	        'scheduled_date',
	        'scheduled_time',
	        'type',
	        'description'
	    ]);

        $data['patient_id'] = auth()->id();
    	$carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
    	$data['scheduled_time'] = $carbonTime->format('H:i:s');

    	//dd($data);

    	Appointment::create($data);

    	$notification = 'The appointment has been successfully registered';
    	return back()->with(compact('notification'));
    	//return redirect('/appointments');
    }

    public function cancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by = auth()->id();
            //$cancellation->appointment_id = ;
            //$cancellation->save();

            //$appointment->cancellation() Accede a la relación entre los modelos
            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Canceled';
        $appointment->save();

        $notification = 'The appointment has been canceled successfully';
        return back()->with(compact('notification'));
    }

}