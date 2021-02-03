<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
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
        $data = new Schedule();
        return view('schedule.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_jadwal = 'JL' . date('dmy') . Str::random(2);
        $this->validate(
            $request,
            [

                'ruangan' => 'required',
            ],
            [

                'ruangan.required' => 'Kolom ruangan wajib diisi'

            ]
        );

        $data = Schedule::insert([
            [
                'id_jadwal' => $id_jadwal,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'ruangan' => $request->ruangan,
                'created_at' => now()
            ]
        ]);

        return $data;
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
        $data = Schedule::findOrFail($id);
        return view('schedule.form', compact('data'));
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
        $this->validate(
            $request,
            [

                'ruangan' => 'required'
            ],
            [

                'ruangan.required' => 'Kolom ruangan wajib diisi'
            ]
        );

        $data = Schedule::findOrFail($id);
        $data->tanggal = $request->tanggal;
        $data->jam = $request->jam;
        $data->ruangan = $request->ruangan;
        $data->updated_at = now();
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
        $data = Schedule::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Schedule::query();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_schedule', [
                    'data' => $data,
                    'url_edit' => route('schedule.edit', $data->id_jadwal),
                    'url_destroy' => route('schedule.destroy', $data->id_jadwal),
                    'url_detail' => route('schedule.detail', $data->id_jadwal)
                ]);
            })
            ->addColumn('waktu', function ($data) {
                $jam = explode(':', $data->jam);
                return $jam[0] . ':' . $jam[1];
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'waktu'])
            ->make(true);
    }
}
