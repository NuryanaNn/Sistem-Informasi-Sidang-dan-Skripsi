<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Guidance;
use App\Revision;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GuidanceController extends Controller
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
            compact('data');
            $data2 = Grade::where('nim', $data->nim)->first();
            $dosen = DB::table('lecturers')
            ->where('id_grup', $data->id_grup)
            ->get();
            return view('guidance/index', compact('data','dosen','data2'));
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
        
        return view('guidance.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_bimbingan = 'BS'.date('dmy').Str::random(2);
         $this->validate(
            $request,
            [
                'nama_bab' => 'required',
                'file_bab' => 'required|mimes:pdf,doc,docx|max:2048',
                'keterangan' => 'required',
                'tanggal' => 'required',
            ],
            [
                'nama_bab.required' => 'nama_bab skripsi wajib diisi',
                'file_bab.required' => 'Wajib mengunggah file bab',
                'file_bab.mimes' => 'Format file salah',
                'file_bab.max' => 'File terlalu besar, maksimal 2MB',
                'keterangan.required' => 'keterangan wajib diisi',
                'tanggal.required' => 'tanggal wajib diisi'


            ]
        );
        $ori = $request->file_bab->getClientOriginalName();
        $ori = explode('.',$ori);
        $ori = $ori[0];
        $file_bab = $ori.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_bab = $request->file_bab->getClientOriginalExtension();
        $request->file_bab->move(public_path('upload/bimbingan'), $file_bab . '.' . $extension_bab);
        
        $data = Guidance::insert([
            [
               'id_bimbingan' => $id_bimbingan,
               'nim' => Session::get('username'),
               'nama_bab' => $request->nama_bab,
               'file_bab' => $file_bab . '.' . $extension_bab,
               'keterangan' => $request->keterangan,
               'tanggal' => $request->tanggal,
               'status_1' => 'proses',
               'status_2' => 'proses',
               'created_at' => now()

            ]
        ]);

        if ($data) {
            $request->session()->flash('success', 'Data berhasil ditambahkan');
        }else{
            $request->session()->flash('error', 'Data gagal ditambahkan');
        }

        return redirect('guidance');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Guidance::findOrFail($id);
        $data2 = Revision::join('lecturers', 'lecturers.nidn', '=', 'revisions.nidn')
        ->join('guidances', 'revisions.id_bimbingan', '=', 'guidances.id_bimbingan')
        ->select('revisions.*','lecturers.nama as nama_dsn')
        ->where('revisions.id_bimbingan', $id)
        ->get();
        return view('guidance/detail', compact('data','data2'));
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
        return view('guidance/edit', compact('data'));
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
                'nama_bab' => 'required',
                'file_bab' => 'mimes:pdf,doc,docx|max:2048',
                'keterangan' => 'required',
                'tanggal' => 'required',
            ],
            [
                'nama_bab.required' => 'nama_bab skripsi wajib diisi',
                'file_bab.mimes' => 'Format file salah',
                'file_bab.max' => 'File terlalu besar, maksimal 2MB',
                'keterangan.required' => 'keterangan wajib diisi',
                'tanggal.required' => 'tanggal wajib diisi'


            ]
        );

        $data = Guidance::findOrFail($id);

        $file_bab = $request->file_bab;
        if($file_bab == NULL){
            $file_bab = $request->old_file_bab;
        }else{
            unlink(public_path('upload/bimbingan/'.$data->file_bab));
            $ori = $request->file_bab->getClientOriginalName();
            $ori = explode('.',$ori);
            $ori = $ori[0];
            $fileName = $ori.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_bab->getClientOriginalExtension();
            $request->file_bab->move(public_path('upload/bimbingan'), $fileName . '.' . $extension);
            $file_bab = $fileName . '.' . $extension;
        }
        $data->nama_bab = $request->nama_bab;
        $data->file_bab = $file_bab;
        $data->keterangan = $request->keterangan;
        $data->tanggal = $request->tanggal;
        $data->updated_at = now();
        $data->save();

        $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('guidance');
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
        $data = Guidance::where([['nim','=', Session::get('username')],['status_1','=','proses'],['status_2','=','proses']])->get();
        return DataTables::of($data)
        ->addColumn('bab', function($data){
            $path = 'upload/bimbingan/'.$data->file_bab;
            return view('guidance.link_download', [
                'data' => $data,
                'title' => $data->file_bab,
                'url_download' => $path
            ]);
        })
        ->addColumn('action', function($data){
            return view('layout._action_bm', [
                'data' => $data,
                'url_edit' => route('guidance.edit', $data->id_bimbingan)
              
            ]);
        })
        ->addColumn('status_1', function($data){
            return view('guidance.status_1', [
                'data' => $data
            ]);
        })
        ->addColumn('status_2', function($data){
            return view('guidance.status_2', [
                'data' => $data
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['bab', 'action', 'status_1', 'status_2'])
        ->make(true);
    }

    public function dataTable2()
    {
        $data = Guidance::where([['nim','=', Session::get('username')],['status_1','!=','proses'],['status_2','!=','proses']])->get();
        return DataTables::of($data)
        ->addColumn('bab', function($data){
            $path = 'upload/bimbingan/'.$data->file_bab;
            return view('guidance.link_download', [
                'data' => $data,
                'title' => $data->file_bab,
                'url_download' => $path
            ]);
        })
         ->addColumn('action', function($data){
            return view('layout._action_bm2', [
                'data' => $data,
                'url_detail' => route('guidance.show',$data->id_bimbingan)
            ]);
        })
        ->addColumn('status_1', function($data){
            return view('guidance.status_1', [
                'data' => $data
            ]);
        })
        ->addColumn('status_2', function($data){
            return view('guidance.status_2', [
                'data' => $data
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action','bab', 'status_1', 'status_2'])
        ->make(true);
    }
}
