<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ScheduleController extends Controller
{
    private $days = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        //DB::beginTransaction();

        $active = $request->input('active') ?: [];
        //si no hay active en el request asigna un arreglo vacío
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for ($i=0; $i<7; ++$i) {
            //$day = (string)$days[$i];

            if ($morning_start[$i] > $morning_end[$i]) {
                $errors[] = 'The morning shift hours are inconsistent for day ' . $this->days[$i] . '';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errors[] = 'The afternoon shift hours are inconsistent for day ' . $this->days[$i] . '';
            }

            WorkDay::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id()
                ], [
                    'active' => in_array($i, $active), //Busca $i en $active, si si está devuelve 1
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i]
                ]
            );
        }

        //dd($errors);

        if (count($errors) > 0) {
            //DB::rollBack();
            return back()->with(compact('errors'));
        }

        $notification = "The schedule has been saved correctly.";
        //DB::commit();
        return back()->with(compact('notification'));
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
    public function edit()
    {
        $workDays = WorkDay::where('user_id', auth()->id())->get();

        if (count($workDays) > 0) {
            //Horario existe en DB
            $workDays->map(function ($workDay) {
                $workDay->morning_start = (new Carbon($workDay->morning_start))->format('H:i');
                $workDay->morning_end = (new Carbon($workDay->morning_end))->format('H:i');
                $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('H:i');
                $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('H:i');
                return $workDay;
            });
        } else {
            //Genera horario plantilla
            $workDays = collect();
            for ($i=0; $i<7 ; ++$i) { 
                $workDays->push(new WorkDay([
                    'active' => false,
                    'morning_start' => (new Carbon((($i>0 and $i<6) ? '8' : '9').':00'))->format('H:i'),
                    'morning_end' => (new Carbon('12:00'))->format('H:i'),
                    'afternoon_start' => (new Carbon('14:00'))->format('H:i'),
                    'afternoon_end' => (new Carbon((($i>0 and $i<6) ? '18' : '16').':00'))->format('H:i'),
                ]));
            }
        }

        //dd($workDays);
        //dd($workDays->toArray());

        $amHours = $this->getIntervals(0, 0, 12, 0, 30, 0);
        $pmHours = $this->getIntervals(12, 0, 24, 0, 30, 0);

        //dd($amHours);
        //dd($pmHours);

        $days = $this->days;
        return view('schedule', compact('workDays', 'days', 'amHours', 'pmHours'));
    }

    /**
     * Genera arreglo de Horas según startMinintervalo.
     *
     * @startHour, hora de inicio
     * @startMin, minuto de inicio
     * @endHour, hora de fin
     * @endMin, minuto de fin
     * @intervalMins, duración cada cita
     * @breakMins, minutos de break entre citas
     * @return Arreglo con todo el rango de horas     
     */
    private function getIntervals($startHour, $startMin, $endHour, $endMin, $intervalMins, $breakMins)
    {
        $Hours = [];
        $startTime = new Carbon($startHour.':'.$startMin);
        $endTime = new Carbon($endHour.':'.$endMin);
        $newHour = $startTime;
        while ($startTime<=$endTime) {
            $Hours [] = $this->arrayHour(
                            $newHour->hour,
                            ':'.($newHour->minute == 0 ? '00' : $newHour->minute)
                        );        
            $newHour->addMinutes($intervalMins);
            $newHour->addMinutes($breakMins);
        }
        return $Hours;
    }    

    /**
     * Genera arreglo de Horas en formato 12 y 24 hr
     *
     * @hour, hora
     * @min, minuto
     * @return arreglo con los dos formatos     
     */
    private function arrayHour($hour, $min)
    {
        $hours = [];
        $hourCarbon = new Carbon($hour.$min);

        $zero = (($hour >= 1 and  $hour < 10) or ($hour >= 13 and  $hour < 22)) ? '0' : '';
        $hours['format_12'] = $zero.$hourCarbon->format('g:i A');
        $hours['format_24'] = $hourCarbon->format('H:i');

        return $hours;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
