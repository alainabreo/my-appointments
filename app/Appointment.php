<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Specialty;
use App\CancelledAppointment;

use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'specialty_id',
        'doctor_id',
        'patient_id',
        'scheduled_date',
        'scheduled_time',
        'type',
        'description'
    ];

    //Permite Tratar estos campos como objetos carbon en Blade
    // protected $dates = [
    // 	'scheduled_date'
    // ];

    // N $appoinment->specialty 1
    public function specialty()
    {
    	return $this->belongsTo(Specialty::class);
    }

    // N $appoinment->doctor 1
    // Laravel busca el campo doctor_id
    public function doctor()
    {
    	return $this->belongsTo(User::class);
    }

    // N $appoinment->patient 1
	// Laravel busca el campo patient_id    
    public function patient()
    {
    	return $this->belongsTo(User::class);
    }

    //Appointment hasOne 1 - 1/0 belongsTo CancelledAppointment
    // $appointment->cancellation->justification
    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }

	//Accesor ó Campo Calculado
	//$appointment->scheduled_time_12
	public function getScheduledTime12Attribute()
	{
		return (new Carbon($this->scheduled_time))
					->format('g:i A');
	}    

}
