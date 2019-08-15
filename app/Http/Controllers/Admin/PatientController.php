<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PatientController extends Controller
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
        //$/img = User::patients()->active()->get();
        $patients = User::patients()->active()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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
        $patientname = $request->input('name');

        User::create(
            $request->only('name', 'email', 'dni', 'mobile', 'phone', 'address', 'city', 'country', 'postcode', 'aboutme') 
            + [
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = $patientname . ' was registered correctly.';
        return redirect('/patients')->with(compact('notification'));
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
        $patient = User::patients()->active()->findOrFail($id);
        return view('patients.edit', compact('patient'));
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
        $patientname = $request->input('name');
        
        $patient = User::patients()->active()->findOrFail($id);

        $data = $request->only('name', 'email', 'dni', 'mobile', 'phone', 'address', 'city', 'country', 'postcode', 'aboutme');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);

        $patient->fill($data);
        $patient->save();

        $notification = $patientname . ' was updated correctly.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientname = $patient->name;
        $patient->delete();

        $notification = $patientname . ' was deleted correctly.';
        return redirect('/patients')->with(compact('notification'));        
    }
}
