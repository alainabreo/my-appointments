<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Specialty extends Model
{
    public static $messages = [
        'name.required' => 'The name field is required',
        'name.min' => 'The name must be at least 3 characters',
        'description.required' => 'The description field is required',
        'description.max' => 'The description may not be greater than 200 characters'
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'required|max:200'
    ];

	protected $fillable = ['name', 'description', 'long_description'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
