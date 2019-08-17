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
        
        $workDays->map(function ($workDay) {
            $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
            $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
            $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
            $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
            return $workDay;
        });

        //dd($workDays);
        //dd($workDays->toArray());
        $days = $this->days;
        return view('schedule', compact('workDays', 'days'));
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
