<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Specialty;
use App\Appointment;

use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create()
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

    	return view('appointments.create', compact('specialties', 'doctors'));
    }

    public function store(Request $request)
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

    	$this->validate($request, $rules, $messages);

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
}
