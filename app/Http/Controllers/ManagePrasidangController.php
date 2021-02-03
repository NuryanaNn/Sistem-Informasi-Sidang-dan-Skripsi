<?php

namespace App\Http\Controllers;

use App\Student;
use DataTables;
use App\Prasidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ManagePrasidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return view('manage_prasidang/index', compact('data'));
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
        $data = Prasidang::findOrFail($id);
        return view('manage_prasidang.form', compact('data'));
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
        $data = Prasidang::findOrFail($id);
        $data->status = $request->status;
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
         if(Session::get('login')){
                if (Session::get('hak_akses') == 'mahasiswa'){
                    $ambil = DB::table('students')
                                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                                ->select('students.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'dosen'){
                    $ambil = DB::table('lecturers')
                                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                                ->select('lecturers.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'lppm'){
                    $ambil = DB::table('institutions')
                                ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                                ->select('institutions.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'prodi'){
                    $ambil = DB::table('departments')
                                ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                                ->select('departments.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                }
            }
         $data = DB::table('prasidang')
        ->join('students','prasidang.nim','=','students.nim')
        ->select('students.*','prasidang.*')
        ->where([['status', '=', 'proses'],['students.jurusan', '=', $ambil->jurusan]])
         ->get();
        return DataTables::of($data)
        ->addColumn('ijasah', function($data){
            $path = 'upload/prasidang/'.$data->file_ijasah;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_ijasah,
                'url_download' => $path
            ]);
        })
        ->addColumn('sertifikat', function($data){
            $path = 'upload/prasidang/'.$data->file_sertifikat_ukm;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_sertifikat_ukm,
                'url_download' => $path
            ]);
        })
        ->addColumn('skripsi', function($data){
             $path = 'upload/prasidang/'.$data->file_skripsi;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addColumn('status', function($data){
            return view('prasidang.status', [
                'data' => $data
            ]);
        })
        ->addColumn('action', function($data){
            return view('layout._action_manageproposal', [
                'data' => $data,
                'url_edit' => route('manage_prasidang.edit', $data->id_ps)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['ijasah', 'sertifikat', 'skripsi','status', 'action'])
        ->make(true);
    }
}
