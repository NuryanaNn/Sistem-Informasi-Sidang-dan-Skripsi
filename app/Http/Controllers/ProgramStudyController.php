<?php

namespace App\Http\Controllers;

use App\ProgramStudy;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProgramStudyController extends Controller
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
            return view('program_study/index',compact('data'));
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
        $data = new ProgramStudy();
        return view('program_study.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'id_jurusan' => 'required',
                'nama_jurusan' => 'required'

            ],
            [
                'id_jurusan.required' => 'Kolom Kode Jurusan Wajib Diisi',
                'nama_jurusan.required' => 'Kolom Nama Jurusan Wajib Diisi',
            ]
            );
                $data = ProgramStudy::insert([
                    'id_jurusan' => $request->id_jurusan,
                    'nama_jurusan' => $request->nama_jurusan,
                    'created_at' => now()
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
        $data = ProgramStudy::findOrFail($id);
        return view('program_study.form', compact('data'));
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
                'id_jurusan' => 'required',
                'nama_jurusan' => 'required'
            ],
            [
                'id_jurusan.required' => 'Kolom kode jurusan wajib diisi',
                'nama_jurusan.required' => 'Kolom nama jurusan wajib diisi'
            ]
        );

        $data = ProgramStudy::findOrFail($id);
        $data->id_jurusan = $request->id_jurusan;
        $data->nama_jurusan = $request->nama_jurusan;
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
        $data = ProgramStudy::findOrFail($id);
        $data->delete();
    }
     public function dataTable()
    {
        $data = ProgramStudy::query();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_notice', [
                    'data' => $data,
                    'url_edit' => route('program_study.edit', $data->id_jurusan),
                    'url_destroy' => route('program_study.destroy', $data->id_jurusan),
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
