<?php

namespace App\Http\Controllers;

use App\Prasidang;
use App\Grade;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;
use Storage;

class PrasidangController extends Controller
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
        
        return view('prasidang/index', compact('data'));
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
        return view('prasidang.form');
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
         /* $this->validate(
            $request,
            [
                
                'file_ijasah' => 'required|mimes:pdf|max:2048',
                'file_sertifikat_ukm' => 'required|mimes:pdf|max:2048',
                'file_foto' => 'required|mimes:png,jpg,JPEG,PNG|max:2048',
                'file_skripsi' => 'required|mimes:pdf|max:2048'

            ],
            [
                'file_ijasah.required' => 'Wajib mengunggah file ijasah',
                'file_ijasah.mimes' => 'Format file salah',
                'file_ijasah.max' => 'File terlalu besar, maksimal 2MB',
                'file_sertifikat_ukm.required' => 'Wajib mengunggah file sertifikat ukm',
                'file_sertifikat_ukm.mimes' => 'Format file salah',
                'file_sertifikat_ukm.max' => 'File terlalu besar, maksimal 2MB',
                'file_foto.required' => 'Wajib mengunggah file skripsi',
                'file_foto.mimes' => 'Format file salah',
                'file_foto.max' => 'File terlalu besar, maksimal 2MB',
                'file_skripsi.required' => 'Wajib mengunggah file skripsi',
                'file_skripsi.mimes' => 'Format file salah',
                'file_skripsi.max' => 'File terlalu besar, maksimal 2MB'


            ]
        ); */
        $file_ijasah = 'IJS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_ijasah = $request->file_ijasah->getClientOriginalExtension();
        $request->file_ijasah->move(public_path('upload/prasidang/ijasah'), $file_ijasah . '.' . $extension_ijasah);
        
        $file_sertifikat_ukm = 'UKM'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_sertifikat_ukm = $request->file_sertifikat_ukm->getClientOriginalExtension();
        $request->file_sertifikat_ukm->move(public_path('upload/prasidang/sertifikat_ukm'), $file_sertifikat_ukm . '.' . $extension_sertifikat_ukm);

        $file_foto = 'FTO'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_foto = $request->file_foto->getClientOriginalExtension();
        $request->file_foto->move(public_path('upload/prasidang/foto'), $file_foto . '.' . $extension_foto);
       
        $file_skripsi = 'SKI'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_skripsi = $request->file_skripsi->getClientOriginalExtension();
        $request->file_skripsi->move(public_path('upload/prasidang/skripsi'), $file_skripsi . '.' . $extension_skripsi);
        /* return $id_ps . '-' . $file_ijasah .'-' . $extension_ijasah .'-' . $file_sertifikat_ukm .'-' . $extension_sertifikat_ukm .'-' . $file_foto .'-' . $extension_foto .'-' . $file_skripsi .'-' . $extension_skripsi; */
        $data = Prasidang::insert([
            [
               'id_ps' => $id_ps,
               'nim' => Session::get('username'),
               'file_ijasah' => $file_ijasah . '.' . $extension_ijasah,
               'file_sertifikat_ukm' => $file_sertifikat_ukm . '.' . $extension_sertifikat_ukm,
               'file_foto' => $file_foto . '.' . $extension_foto,
               'file_skripsi' => $file_skripsi . '.' . $extension_skripsi,
               'tanggal' => $request->tanggal,
               'status' => 'proses',
               'created_at' => now()

            ]
        ]);

        if ($data) {
            $request->session()->flash('success', 'Data berhasil ditambahkan');
        }else{
            $request->session()->flash('error', 'Data gagal ditambahkan');
        }

        return redirect('prasidang');
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
        return view('prasidang/edit', compact('data'));
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
       
                 /* $this->validate(
            $request,
            [
                
                'file_ijasah' => 'required|mimes:pdf|max:2048',
                'file_sertifikat_ukm' => 'required|mimes:pdf|max:2048',
                'file_foto' => 'required|mimes:png,jpg,JPEG,PNG|max:2048',
                'file_skripsi' => 'required|mimes:pdf|max:2048'

            ],
            [
                'file_ijasah.required' => 'Wajib mengunggah file ijasah',
                'file_ijasah.mimes' => 'Format file salah',
                'file_ijasah.max' => 'File terlalu besar, maksimal 2MB',
                'file_sertifikat_ukm.required' => 'Wajib mengunggah file sertifikat ukm',
                'file_sertifikat_ukm.mimes' => 'Format file salah',
                'file_sertifikat_ukm.max' => 'File terlalu besar, maksimal 2MB',
                'file_foto.required' => 'Wajib mengunggah file skripsi',
                'file_foto.mimes' => 'Format file salah',
                'file_foto.max' => 'File terlalu besar, maksimal 2MB',
                'file_skripsi.required' => 'Wajib mengunggah file skripsi',
                'file_skripsi.mimes' => 'Format file salah',
                'file_skripsi.max' => 'File terlalu besar, maksimal 2MB'


            ]
        ); */
        $data = Prasidang::findOrFail($id);
        $file_ijasah = $request->file_ijasah;
        if ($file_ijasah == NULL) {
            $file_ijasah = $request->old_file_ijasah;
        }else{
            unlink(public_path('upload/prasidang/ijasah/'.$data->file_ijasah));
            $fileName = 'IJS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_ijasah->getClientOriginalExtension();
            $request->file_ijasah->move(public_path('upload/prasidang/ijasah'), $fileName . '.' . $extension);
            $file_ijasah = $fileName . '.' . $extension;
        }

        $file_sertifikat_ukm = $request->file_sertifikat_ukm;
        if ($file_sertifikat_ukm == NULL) {
            $file_sertifikat_ukm = $request->old_file_sertifikat_ukm;
        }else{
            unlink(public_path('upload/prasidang/sertifikat_ukm/'.$data->file_sertifikat_ukm));
            $fileName = 'UKM'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_sertifikat_ukm->getClientOriginalExtension();
            $request->file_sertifikat_ukm->move(public_path('upload/prasidang/sertifikat_ukm'), $fileName . '.' . $extension);
            $file_sertifikat_ukm = $fileName . '.' . $extension;
        }

        $file_foto = $request->file_foto;
        if ($file_foto == NULL) {
            $file_foto = $request->old_file_foto;
        }else{
            unlink(public_path('upload/prasidang/foto/'.$data->file_foto));
            $fileName = 'FTO'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_proposal->getClientOriginalExtension();
            $request->file_foto->move(public_path('upload/prasidang/foto'), $fileName . '.' . $extension);
            $file_foto = $fileName . '.' . $extension;
        }

        $file_skripsi = $request->file_skripsi;
        if ($file_skripsi == NULL) {
            $file_skripsi = $request->old_file_skripsi;
        }else{
            unlink(public_path('upload/prasidang/skripsi/'.$data->file_foto));
            $fileName = 'SKI'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_skripsi->getClientOriginalExtension();
            $request->file_skripsi->move(public_path('upload/prasidang/skripsi'), $fileName . '.' . $extension);
            $file_skripsi = $fileName . '.' . $extension;
        }

        $data->file_ijasah = $file_ijasah;
        $data->file_sertifikat_ukm = $file_sertifikat_ukm;
        $data->file_foto = $file_foto;
        $data->file_skripsi = $file_skripsi;
        $data->tanggal = $request->tanggal;
        $data->save();

        $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('prasidang');
    

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
        $data = Prasidang::where('nim',Session::get('username'))->get();
        return DataTables::of($data)
        ->addColumn('ijasah', function($data){
            $path = 'upload/prasidang/ijasah/'.$data->file_ijasah;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_ijasah,
                'url_download' => $path
            ]);
        })
        ->addColumn('sertifikat', function($data){
            $path = 'upload/prasidang/sertifikat_ukm/'.$data->file_sertifikat_ukm;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_sertifikat_ukm,
                'url_download' => $path
            ]);
        })
        ->addColumn('skripsi', function($data){
             $path = 'upload/prasidang/skripsi/'.$data->file_skripsi;
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
            return view('layout._action_ps', [
                'data' => $data,
                'url_edit' => route('prasidang.edit', $data->id_ps)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['ijasah', 'sertifikat', 'skripsi','status', 'action'])
        ->make(true);
    }
}
