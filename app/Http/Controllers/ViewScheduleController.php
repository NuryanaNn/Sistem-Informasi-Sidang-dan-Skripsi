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

class ViewScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
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
            return view('view_schedule/index',compact('data'));
        } else {
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
        //
    }
    public function dataTable()
    {
        if (Session::get('hak_akses') == 'mahasiswa') {
            $data = DB::table('students')
                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                ->select('students.*', 'auths.*')
                ->where('auths.id_auth', Session::get('id_auth'))
                ->first();
        } else if (Session::get('hak_akses') == 'dosen') {
            $data = DB::table('lecturers')
                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                ->select('lecturers.*', 'auths.*')
                ->where('auths.id_auth', Session::get('id_auth'))
                ->first();
        }
        $table = DB::table('schedule')
            ->join('students', 'schedule.id_jadwal', '=', 'students.id_jadwal')
            ->join('lecturers', 'schedule.id_jadwal', '=', 'lecturers.id_jadwal')
            ->select('schedule.*', 'students.nama as nama_mhs', 'lecturers.nama as nama_penguji')
            ->where('students.id_jadwal', $data->id_jadwal)
            ->get();
        return DataTables::of($table)
            ->addColumn('waktu', function ($data) {
                $jam = explode(':', $data->jam);
                return $jam[0] . ':' . $jam[1];
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'waktu'])
            ->make(true);
    }
}
