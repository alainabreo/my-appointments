<?php

use Illuminate\Database\Seeder;

use App\Specialty;
use App\User;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
        	'Oftalmology',
        	'Ginecology',
        	'Pedriatry',
        	'Neurology'
        ];

        foreach ($specialties as $specialtyName) {
        	$specialty = Specialty::create([
        		'name' => $specialtyName
        	]);

            $specialty->users()->saveMany(
                factory(User::class, 5)->states('doctor')->make()
            );

            //Medicos de Prueba
            User::find(2)->specialties()->save($specialty);
            User::find(3)->specialties()->save($specialty);            
        }

    }
}
