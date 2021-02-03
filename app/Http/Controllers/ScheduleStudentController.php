<?php

namespace App\Http\Controllers;

use App\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScheduleStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
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
        $data = Student::findOrFail($id);
        $schedule = DB::table('schedule')->get();
        $selectSchedule = [];
        foreach ($schedule as $schedule) {
            $selectSchedule[$schedule->id_jadwal] = $schedule->ruangan;
        }
        return view('schedule_student.form', compact('data', 'selectSchedule'));
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
        $data = Student::findOrFail($id);
        $data->id_jadwal = $request->id_jadwal;
        $data->save();
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
    public function dataTable()
    {
        $data = Student::where('id_jadwal', NULL)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_schedule_ed_del', [
                    'data' => $data,
                    'url_edit' => route('schedulestudent.edit', $data->nim),
                    'url_destroy' => route('schedulestudent.destroy', $data->nim)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
