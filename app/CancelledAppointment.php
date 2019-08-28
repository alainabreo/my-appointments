<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Appointment;

class CancelledAppointment extends Model
{
    protected $fillable = [
        'appointment_id',
        'cancelled_by',
        'justification'
    ];

}
