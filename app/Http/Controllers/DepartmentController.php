<?php

namespace App\Http\Controllers;

use App\Department;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('department/index');
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
        $data = new Department();
        return view('department.form', compact('data'));
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
                'jurusan' => 'required',
            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email wajib diisi',
                'alamat.required' => 'Kolom alamat wajib diisi',
                'jurusan.required' => 'Kolom jurusan wajib diisi',

            ]
        );

        $data = Department::insert([
            [
                'nidn' => $request->nidn,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jurusan' => $request->jurusan,
                'id_auth' => $id_auth,
                'created_at' => now()
            ]
        ]);
        
        $data = DB::table('auths')->insert([
            [
                'id_auth' => $id_auth,
                'username' => $request->nidn,
                'password' => bcrypt($request->nidn.'Dsn*'),
                'hak_akses' => 'prodi',
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
        $data = Department::findOrFail($id);

        return view('department.form', compact('data'));
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
                'jurusan' => 'required',
            ],
            [
                'nidn.required' => 'Kolom nidn grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email wajib diisi',
                'alamat.required' => 'Kolom alamat wajib diisi',
                'jurusan.required' => 'Kolom jurusan wajib diisi',
            ]
        );

        $data = Department::findOrFail($id);
        $data->nidn = $request->nidn;
        $data->nama = $request->nama;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->jurusan = $request->jurusan;
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
        $data = Department::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Department::query();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_department', [
                'data' => $data,
                'url_edit' => route('department.edit', $data->id_prodi),
                'url_destroy' => route('department.destroy', $data->id_prodi)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
