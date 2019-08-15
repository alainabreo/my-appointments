<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$doctors = User::doctors()->active()->get();
        $doctors = User::doctors()->active()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar
        $this->validate($request, User::$rules, User::$messages);
        $doctorname = $request->input('name');

        User::create(
            $request->only('name', 'email', 'dni', 'mobile', 'phone', 'address', 'city', 'country', 'postcode', 'aboutme') 
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = $doctorname . ' was registered correctly.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::doctors()->active()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validar
        $this->validate($request, User::$rules, User::$messages);
        $doctorname = $request->input('name');
        
        $doctor = User::doctors()->active()->findOrFail($id);

        $data = $request->only('name', 'email', 'dni', 'mobile', 'phone', 'address', 'city', 'country', 'postcode', 'aboutme');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);

        $doctor->fill($data);
        $doctor->save();

        $notification = $doctorname . ' was updated correctly.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctorname = $doctor->name;
        $doctor->delete();

        $notification = $doctorname . ' was deleted correctly.';
        return redirect('/doctors')->with(compact('notification'));        
    }
}
