<?php

namespace App\Http\Controllers;

use App\Department;
use App\Institution;
use App\Lecturer;
use App\Student;
use App\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
            if (Session::get('hak_akses') == 'mahasiswa') {
                $data = DB::table('students')
                    ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                    ->select('students.*', 'auths.*')
                    ->where('auths.id_auth', Session::get('id_auth'))
                    ->first();
            } else if (Session::get('hak_akses') == 'dosen') {
                $data = DB::table('lecturers')
                    ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                    ->select('lecturers.*', 'auths.*')
                    ->where('auths.id_auth', Session::get('id_auth'))
                    ->first();
            } else if (Session::get('hak_akses') == 'lppm') {
                $data = DB::table('institutions')
                    ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                    ->select('institutions.*', 'auths.*')
                    ->where('auths.id_auth', Session::get('id_auth'))
                    ->first();
            } else if (Session::get('hak_akses') == 'prodi') {
                $data = DB::table('departments')
                    ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                    ->select('departments.*', 'auths.*')
                    ->where('auths.id_auth', Session::get('id_auth'))
                    ->first();
            }
            return view('profile/index', compact('data'));
        } else {
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
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
            ],
            [
                'nama.required' => 'Kolom nama wajib diisi',
                'alamat.required' => 'Kolom alamat grup wajib diisi',
                'no_hp.required' => 'Kolom no hp wajib diisi',
                'email.required' => 'Kolom email grup wajib diisi'
            ]
        );
        if (Session::get('hak_akses') == 'mahasiswa') {
            Session::put('nama', $request->nama);
            $data = Student::findOrFail($id);
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->no_hp = $request->no_hp;
            $data->email = $request->email;
            $data->updated_at = now();
            $data->save();
        } elseif (Session::get('hak_akses') == 'dosen') {
            Session::put('nama', $request->nama);
            $data = Lecturer::findOrFail($id);
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->no_hp = $request->no_hp;
            $data->email = $request->email;
            $data->updated_at = now();
            $data->save();
        } elseif (Session::get('hak_akses') == 'lppm') {
            Session::put('nama', $request->nama);
            $data = Institution::findOrFail($id);
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->no_hp = $request->no_hp;
            $data->email = $request->email;
            $data->updated_at = now();
            $data->save();
        } elseif (Session::get('hak_akses') == 'prodi') {
            Session::put('nama', $request->nama);
            $data = Department::findOrFail($id);
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->no_hp = $request->no_hp;
            $data->email = $request->email;
            $data->updated_at = now();
            $data->save();
        }

        return response()->json([
            'success' => true
        ], 200);
    }
    public function update_pw(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'current_pass' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'current_pass.required' => 'Harus mengisi kata sandi sebelumnya',
                'password.required' => 'Harus mengisi kata sandi baru',

                'password.confirmed' => 'Kata sandi tidak cocok',
                'password_confirmation.required' => 'Konfirmasi kata sandi tidak boleh kosong'
            ]
        );

        $data = Auth::where('username', Session::get('username'))->first();

        if (Hash::check($request->current_pass, $data->password)) {

            $query = Auth::findOrFail($data->id_auth);
            $query->password = bcrypt($request->password);
            $query->save();

            return response()->json([
                'success' => true,
                'message' => 'Kata sandi berhasil diubah'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi sebelumnya tidak sesuai'
            ], 200);
        }
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
}
