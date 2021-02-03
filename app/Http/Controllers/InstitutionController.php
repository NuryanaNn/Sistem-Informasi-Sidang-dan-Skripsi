<?php

namespace App\Http\Controllers;

use App\Institution;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('institution/index');
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
        $data = new Institution();
        return view('institution.form', compact('data'));
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
                'no_hp' => 'required',
                'email' => 'required',
                'alamat' => 'required',
            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email wajib diisi',
                'alamat.required' => 'Kolom alamat wajib diisi',

            ]
        );

        $data = Institution::insert([
            [
                'nidn' => $request->nidn,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'id_auth' => $id_auth,
                'created_at' => now()
            ]
        ]);
        
        $data = DB::table('auths')->insert([
            [
                'id_auth' => $id_auth,
                'username' => $request->nidn,
                'password' => bcrypt($request->nidn.'Dsn*'),
                'hak_akses' => 'lppm',
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
        $data = Institution::findOrFail($id);

         return view('institution.form', compact('data'));
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
                'no_hp' => 'required',
                'email' => 'required',
                'alamat' => 'required',
            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email wajib diisi',
                'alamat.required' => 'Kolom alamat wajib diisi',
            ]
        );

        $data = Institution::findOrFail($id);
        $data->nidn = $request->nidn;
        $data->nama = $request->nama;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
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
        $data = Institution::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Institution::query();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_institution', [
                'data' => $data,
                'url_edit' => route('institution.edit', $data->id_lppm),
                'url_destroy' => route('institution.destroy', $data->id_lppm)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
