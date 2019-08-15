<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Specialty;

class SpecialtyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$specialties = Specialty::all();
    	return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
    	return view('specialties.create');
    }

    public function store(Request $request)
    {
        //Validar
        $this->validate($request, Specialty::$rules, Specialty::$messages);

    	//dd($request->all());
    	$specialty = new Specialty();
    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->long_description = $request->input('long_description');
    	$specialty->save(); //Insert

    	//return back();
    	$notification = $specialty->name . ' was registered correctly.';
    	return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
    	return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        //Validar
        $this->validate($request, Specialty::$rules, Specialty::$messages);

    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->long_description = $request->input('long_description');
    	$specialty->save(); //Update

    	//return back();
    	$notification = $specialty->name . ' was updated correctly.';
    	return redirect('/specialties')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
    	$deletedSpecialty = $specialty->name;
    	$specialty->delete();

    	$notification = $deletedSpecialty . ' was deleted correctly.';
    	return redirect('/specialties')->with(compact('notification'));
    }
}
