<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Appointment;
use App\User;

class CancelledAppointment extends Model
{
    protected $fillable = [
        'appointment_id',
        'cancelled_by',
        'justification'
    ];

    public function cancelled_by() //cancelled_by_id
    {
    	//belongsTo Cancellation N - 1 User hasMany
    	return $this->belongsTo(User::class);
    }

}
