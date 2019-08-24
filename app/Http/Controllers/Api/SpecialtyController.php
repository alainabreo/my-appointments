<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specialty;

class SpecialtyController extends Controller
{
    public function doctors(Specialty $specialty)
    {
    	//return $specialty->users;
    	return $specialty->users()->get(['users.id', 'users.name']);
    }
}
