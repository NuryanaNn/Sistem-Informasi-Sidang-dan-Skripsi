<?php

namespace App\Http\Controllers;

use App\Pascasidang;
use App\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ViewpascaController extends Controller
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
            return view('viewpasca/index', compact('data'));
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
        //
    }

    public function dataTable()
    {
         $data = DB::table('pascasidang')
        ->join('students','pascasidang.nim','=','students.nim')
        ->select('students.*','pascasidang.*')
        ->where('students.jurusan', '=', 'Teknik Informatika')
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/pascasidang/'.$data->file_skripsi;
            return view('pascasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }
    public function dataTable2()
    {
         $data = DB::table('pascasidang')
        ->join('students','pascasidang.nim','=','students.nim')
        ->select('students.*','pascasidang.*')
        ->where('students.jurusan', '=', 'Sistem Informasi')
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/pascasidang/'.$data->file_skripsi;
            return view('pascasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }
    public function dataTable3()
    {
         $data = DB::table('pascasidang')
        ->join('students','pascasidang.nim','=','students.nim')
        ->select('students.*','pascasidang.*')
        ->where('students.jurusan', '=', 'Manajemen Informatika')
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/pascasidang/'.$data->file_skripsi;
            return view('pascasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }
}
