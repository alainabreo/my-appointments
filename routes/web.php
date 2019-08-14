<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Specialty
Route::get('/specialties', 'SpecialtyController@index'); //Ver form index
Route::get('/specialties/create', 'SpecialtyController@create'); //Ver form create
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); //Carga form edit

Route::post('/specialties', 'SpecialtyController@store'); //envio del form create
Route::put('/specialties/{specialty}', 'SpecialtyController@update'); //Update form edit
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

//Doctors
Route::resource('doctors', 'DoctorController');

//Patients