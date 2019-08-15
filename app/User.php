<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public static $messages = [
        'name.required' => 'The name field is required',
        'name.min' => 'The name must be at least 3 characters',
        'email.required' => 'The email field is required',
        'address.min' => 'The description must be at least 5 characters',
        'address.max' => 'The description may not be greater than 200 characters'
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'dni' => 'nullable|min:6',
        'mobile' => 'nullable|min:6',
        'phone' => 'nullable|min:6',
        'address' => 'nullable|min:5|max:200',
        'city' => 'nullable|min:5',
        'country' => 'nullable|min:5',
        'postcode' => 'nullable|min:5',
    ];    

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'dni', 'mobile', 'phone', 'address', 'city', 'country', 'postcode', 'aboutme', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function scopeActive($query)
    {
        return $query->where('active', True);
    }    
}
