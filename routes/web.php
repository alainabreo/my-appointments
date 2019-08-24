<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
	//Specialty
	Route::get('/specialties', 'SpecialtyController@index'); //Ver form index
	Route::get('/specialties/create', 'SpecialtyController@create'); //Ver form create
	Route::post('/specialties', 'SpecialtyController@store'); //envio del form create
	Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); //Carga form edit
	Route::put('/specialties/{specialty}', 'SpecialtyController@update'); //Update form edit
	Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');
	//Doctors
	Route::resource('doctors', 'DoctorController');
	//Patients
	Route::resource('patients', 'PatientController');
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
	//Schedule
	Route::get('/schedule', 'ScheduleController@edit');
	Route::post('/schedule', 'ScheduleController@store');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/appointments/create', 'AppointmentController@create');
	Route::post('/appointments', 'AppointmentController@store');

	//JSON
	Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors'); //Doctors by Specialty
	Route::get('/schedule/hours', 'Api\ScheduleController@hours'); //Hours by Doctors and Specialty
});

