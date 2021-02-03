<?php

namespace App\Http\Controllers;

use App\Lecturer;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('lecturer/index');
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
        $data = new Lecturer();
        return view('lecturer.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_auth = 'A'.date('dmy').Str::random(3);
        $this->validate(
            $request,
            [
                'nidn' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
                'pembimbing' => 'required',
                'penguji' => 'required',


            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'alamat.required' => 'Kolom alamat grup wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email grup wajib diisi',
                'pembimbing.required' => 'Kolom pembimbing wajib diisi',
                'penguji.required' => 'Kolom penguji wajib diisi'

            ]
        );
        $data = Lecturer::insert([
            [
                'nidn' => $request->nidn,
                'id_auth' => $id_auth,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'pembimbing' => $request->pembimbing,
                'penguji' => $request->penguji,
                'created_at' => now()
            ]
        ]);
        
        $data = DB::table('auths')->insert([
            [
                'id_auth' => $id_auth,
                'username' => $request->nidn,
                'password' => bcrypt($request->nidn.'Dsn*'),
                'hak_akses' => 'dosen',
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
        $data = Lecturer::findOrFail($id);
        return view('lecturer.form', compact('data'));
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
                'nidn' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
                'pembimbing' => 'required',
                'penguji' => 'required',
            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'alamat.required' => 'Kolom alamat grup wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email grup wajib diisi',
                'pembimbing.required' => 'Kolom pembimbing wajib diisi',
                'penguji.required' => 'Kolom penguji wajib diisi'
            ]
        );

        $data = Lecturer::findOrFail($id);
        $data->nidn = $request->nidn;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
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
        $data = Lecturer::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Lecturer::query();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_lecturer', [
                'data' => $data,
                'url_edit' => route('lecturer.edit', $data->nidn),
                'url_destroy' => route('lecturer.destroy', $data->nidn)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
