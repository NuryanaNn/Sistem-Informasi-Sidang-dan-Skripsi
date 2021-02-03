<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Student;
use App\Lecturer;
use App\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
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
            $row['l'] = Student::where('jk','Laki-Laki')->count();
            $row['p'] = Student::where('jk','Perempuan')->count();
            $dashboard = notice::latest()->limit(2)->get();
            return view('dashboard.index', compact('dashboard','data','row'));
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
        //
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

    public function jumlahRow()
    {
        $student = Student::count();
        $lecturer = Lecturer::count();
        $group = Group::count();
        return response()->json([
            'student' => $student,
            'lecturer' => $lecturer,
            'group' => $group
        ]);
    }

    public function chartGrad()
    {
        $year = (int) date('Y');

        $nowYear = DB::table('students')
            ->where('tahun', $year)
            ->count();
        $beforeOne = DB::table('students')
            ->where('tahun', $year - 1)
            ->count();
        $beforeTwo = DB::table('students')
            ->where('tahun', $year - 2)
            ->count();
        $beforeThree = DB::table('students')
            ->where('tahun', $year - 3)
            ->count();
        $beforeFour = DB::table('students')
            ->where('tahun', $year - 4)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                0 => [
                    'tahun' => $year - 4,
                    'jumlah' => $beforeFour
                ],
                1 => [
                    'tahun' => $year - 3,
                    'jumlah' => $beforeThree
                ],
                2 => [
                    'tahun' => $year - 2,
                    'jumlah' => $beforeTwo
                ],
                3 => [
                    'tahun' => $year - 1,
                    'jumlah' => $beforeOne
                ],
                4 => [
                    'tahun' => $year,
                    'jumlah' => $nowYear
                ]
            ]
        ]);
    }
}
