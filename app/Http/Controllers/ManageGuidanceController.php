<?php

namespace App\Http\Controllers;

use App\Guidance;
use App\Lecturer;
use App\Revision;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ManageGuidanceController extends Controller
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
        return view('manage_guidance/index', compact('data'));
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
        $data = DB::table('guidances')
        ->join('students','guidances.nim','=','students.nim')
        ->select('students.*','guidances.*')
        ->where('students.nim',$id)
        ->get();
        return view('manage_guidance.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guidance::findOrFail($id);
         return view('manage_guidance.form', compact('data'));
    }


    public function edit2(Request $request, $id)
    {
        $data = Guidance::findOrFail($id);
        if($data->status_1== 'proses'){
            $data->status_1 = 'terima';
        }elseif($data->status_1 == 'terima'){
            $data->status_2 = 'terima';
        }
        $data->save();
         $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('manage_guidance');

    }

    public function update(Request $request, $id)
    {
        $id_revisi = 'RV'.date('dmy').Str::random(2);
        $this->validate(
            $request,
            [
        
                'file_revisi' => 'required|mimes:pdf|max:2048',


            ],
            [
                'file_revisi.required' => 'Wajib mengunggah file krs',
                'file_revisi.mimes' => 'Format file salah',
                'file_revisi.max' => 'File terlalu besar, maksimal 2MB',
            ]
        );
        $file_revisi = 'RVS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_revisi = $request->file_revisi->getClientOriginalExtension();
        $request->file_revisi->move(public_path('upload/revisi'), $file_revisi . '.' . $extension_revisi);
        $data2 = Revision::insert([
            [

                'id_revisi' => $id_revisi,
                'id_bimbingan' => $request->id_bimbingan,
                'nidn' => $request->nidn,
                'isi_revisi' => $request->isi_revisi,
                'file_revisi' => $file_revisi . '.' . $extension_revisi,
                'tanggal' => $request->tanggal,
                'created_at' => now()
            ]
        ]);
        $data = Guidance::findOrFail($id);
        if($data->status_1== 'proses'){
            $data->status_1 = 'revisi';
        }elseif($data->status_1 == 'revisi'){
            $data->status_2 = 'revisi';
        }
        $data->save();
         $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('manage_guidance');
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
        $data = DB::table('guidances')
        ->join('students','guidances.nim','=','students.nim')
        ->select('students.*','guidances.*')
        ->where('students.id_grup',$ambil->id_grup)
        ->where(function($query){
            $query->where('status_1','proses')
            ->orWhere('status_2','proses');
        })
         ->get();
         return DataTables::of($data)
        ->addColumn('file_bab', function($data){
            $path = 'upload/bimbingan/'.$data->file_bab;
            return view('guidance.link_download', [
                'data' => $data,
                'title' => $data->file_bab,
                'url_download' => $path
            ]);
        })
        ->addColumn('action', function($data){
            return view('layout._action_mguidance', [
                'data' => $data,
                'url_edit' => route('manage_guidance.edit', $data->id_bimbingan),
                'url_edit2' => route('terima.edit2', $data->id_bimbingan)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['file_bab','action'])
        ->make(true);
    }
    public function dataTable2()
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
        $data = DB::table('students')->where('students.id_grup',$ambil->id_grup)->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_riwayatpp', [
                'data' => $data,
                'url_detail' => route('manage_guidance.show', $data->nim),
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}