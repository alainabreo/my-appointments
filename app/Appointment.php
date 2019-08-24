<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
