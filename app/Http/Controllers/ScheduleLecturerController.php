<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecturer;
use App\Schedule;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ScheduleLecturerController extends Controller
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
        $data = Lecturer::findOrFail($id);
        $schedule = DB::table('schedule')->get();
        $selectSchedule = [];
        foreach ($schedule as $schedule) {
            $selectSchedule[$schedule->id_jadwal] = $schedule->ruangan;
        }
        return view('schedule_lecturer.form', compact('data', 'selectSchedule'));
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
        $data = Lecturer::findOrFail($id);
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
    }
    public function dataTable()
    {
        $data = Lecturer::where('id_jadwal', NULL)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_schedule_ed_del', [
                    'data' => $data,
                    'url_edit' => route('schedulelecturer.edit', $data->nidn),
                    'url_destroy' => route('schedulelecturer.destroy', $data->nidn)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
