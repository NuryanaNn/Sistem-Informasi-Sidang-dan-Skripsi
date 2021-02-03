<?php

namespace App\Http\Controllers;

use DataTables;
use App\Student;
use App\Lecturer;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class DetailScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Session::get('login')){
             if (Session::get('hak_akses') == 'mahasiswa'){
                    $data = DB::table('students')
                                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                                ->select('students.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'dosen'){
                    $data = DB::table('lecturers')
                                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                                ->select('lecturers.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'lppm'){
                    $data = DB::table('institutions')
                                ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                                ->select('institutions.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'prodi'){
                    $data = DB::table('departments')
                                ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                                ->select('departments.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                }
                $schedule = Schedule::findOrFail($id);
                return view('detailschedule/index', compact('schedule','data'));
            }else{
                 return redirect('login');
            }
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
        //
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
    }

    public function updatestudent($id)
    {
        $data = Student::findOrFail($id);
        $data->id_jadwal = NULL;
        $data->save();
    }

    public function updatelecturer($id)
    {
        $data = Lecturer::findOrFail($id);
        $data->id_jadwal = NULL;
        $data->save();
    }

    public function dataTableStudent($id)
    {
        $data = DB::table('schedule')
            ->join('students', 'schedule.id_jadwal', '=', 'students.id_jadwal')
            ->select('schedule.*', 'students.*')
            ->where('schedule.id_jadwal', $id)
            ->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_ds_del', [
                    'data' => $data,
                    'url_destroy' => route('detailschedule.updatestudent', $data->nim)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
    public function dataTableLecturer($id)
    {
        $data = DB::table('schedule')
            ->join('lecturers', 'schedule.id_jadwal', '=', 'lecturers.id_jadwal')
            ->select('schedule.*', 'lecturers.*')
            ->where('schedule.id_jadwal', $id)
            ->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_ds_del', [
                    'data' => $data,
                    'url_destroy' => route('detailschedule.updatelecturer', $data->nidn)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
