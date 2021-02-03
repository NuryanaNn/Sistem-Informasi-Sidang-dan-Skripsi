<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Student;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('student/index');
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
        $data = new Student();
        return view('student.form', compact('data'));
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
                'nim' => 'required',
                'nama' => 'required',
            ],
            [
                'nim.required' => 'Kolom nim grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',

            ]
        );
        $data = Student::insert([
            [
                'nim' => $request->nim,
                'id_auth' => $id_auth,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jurusan' => $request->jurusan,
                'tahun' => $request->tahun,
                'created_at' => now()
            ]
        ]);
        
        $data = DB::table('auths')->insert([
            [
                'id_auth' => $id_auth,
                'username' => $request->nim,
                'password' => bcrypt($request->nim.'Aa*'),
                'hak_akses' => 'mahasiswa',
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

        $data = Student::findOrFail($id);
        return view('student.form', compact('data'));
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
                'nim' => 'required',
                'nama' => 'required',
            ],
            [
                'nim.required' => 'Kolom nim grup wajib diisi',
                'nama.required' => 'Kolom nama wajib diisi',
            ]
        );

        $data = Student::findOrFail($id);
        $data->nim = $request->nim;
        $data->nama = $request->nama;
        $data->jk = $request->jk;
        if (isset($request->check)) {
            $auth = Auth::findOrFail($data->id_auth);
            $auth->password = bcrypt($request->password);
            $auth->updated_at = now();
            $auth->save();
        }
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->jurusan = $request->jurusan;
        $data->tahun = $request->tahun;
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
        $data = Student::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Student::query();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_student', [
                'data' => $data,
                'url_edit' => route('student.edit', $data->nim),
                'url_destroy' => route('student.destroy', $data->nim)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
