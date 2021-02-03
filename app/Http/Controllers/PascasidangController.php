<?php

namespace App\Http\Controllers;

use App\Pascasidang;
use App\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;
use Storage;
use Illuminate\Http\Request;

class PascasidangController extends Controller
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
        return view('pascasidang/index', compact('data'));
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
        return view('pascasidang.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_ps = 'PS'.date('dmy').Str::random(2);
          $this->validate(
            $request,
            [
                'file_skripsi' => 'required|mimes:docx,doc,pdf|max:2048'

            ],
            [
              
                'file_skripsi.required' => 'Wajib mengunggah file skripsi',
                'file_skripsi.mimes' => 'Format file salah',
                'file_skripsi.max' => 'File terlalu besar, maksimal 2MB'


            ]
        ); 
        $file_skripsi = 'SKI'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_skripsi = $request->file_skripsi->getClientOriginalExtension();
        $request->file_skripsi->move(public_path('upload/pascasidang'), $file_skripsi . '.' . $extension_skripsi);
     
        $data = Pascasidang::insert([
            [
               'id_pcs' => $id_ps,
               'nim' => Session::get('username'),
               'file_skripsi' => $file_skripsi . '.' . $extension_skripsi,
               'tanggal' => $request->tanggal,
               'created_at' => now()

            ]
        ]);

        if ($data) {
            $request->session()->flash('success', 'Data berhasil ditambahkan');
        }else{
            $request->session()->flash('error', 'Data gagal ditambahkan');
        }

        return redirect('pascasidang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pascasidang::findOrFail($id);
        return view('pascasidang/edit', compact('data'));
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
                'file_skripsi' => 'required|mimes:docx,doc,pdf|max:2048'

            ],
            [
              
                'file_skripsi.required' => 'Wajib mengunggah file skripsi',
                'file_skripsi.mimes' => 'Format file salah',
                'file_skripsi.max' => 'File terlalu besar, maksimal 2MB'


            ]
        ); 
        $data = Pascasidang::findOrFail($id);
        $file_skripsi = $request->file_skripsi;
        if ($file_skripsi == NULL) {
            $file_skripsi = $request->old_file_skripsi;
        }else{
            unlink(public_path('upload/pascasidang/'.$data->file_foto));
            $fileName = 'SKI'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_skripsi->getClientOriginalExtension();
            $request->file_skripsi->move(public_path('upload/pascasidang'), $fileName . '.' . $extension);
            $file_skripsi = $fileName . '.' . $extension;
        }

        $data->file_skripsi = $file_skripsi;
        $data->tanggal = $request->tanggal;
        $data->save();

        $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('pascasidang');
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
        $data = Pascasidang::where('nim',Session::get('username'))->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/pascasidang/'.$data->file_skripsi;
            return view('pascasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addColumn('action', function($data){
            return view('layout._action_pcs', [
                'data' => $data,
                'url_edit' => route('pascasidang.edit', $data->id_pcs)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi', 'action'])
        ->make(true);
    }
}
