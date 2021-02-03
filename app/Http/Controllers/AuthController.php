<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function index()
    {
        if (Session::get('login')) {
            return redirect('dashboard');
        }
        return view('login.login');
    }

    public function proses_auth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $hak_akses = $request->input('hak_akses');

        $data = Auth::where([
            ['username', '=', $username],
            ['hak_akses', '=', $hak_akses]
        ])->first();
        if ($data) {
            if(Hash::check($password, $data->password)){
                Session::put('id_auth', $data->id_auth);
                Session::put('username', $data->username);
                Session::put('hak_akses', $data->hak_akses);
                Session::put('login', TRUE);
                return response()->json([
                    'success' => true
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kata sandi salah!'
                ],401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nama Pengguna Tidak Terdaftar!'
            ],401);
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
