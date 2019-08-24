<?php

use Illuminate\Database\Seeder;

use App\WorkDay;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <7 ; ++$i) { 
        	for ($y=2; $y<=3 ; ++$y) { 
            	WorkDay::create([
		            'day' => $i,
		            'active' => ($i>0),
		            'morning_start' => ($i>0 ? '08:00:00' : '06:00:00'),
		            'morning_end' => ($i>0 ? '12:00:00' : '06:00:00'),
		            'afternoon_start' => ($i>0 ? '14:00:00' : '13:00:00'),
		            'afternoon_end' => ($i>0 ? '18:00:00' : '13:00:00'),
		            'user_id' => $y //Medicos de prueba con id 2 y 3
	        	]);
        	}
        }
    }
}
