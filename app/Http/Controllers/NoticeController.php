<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class NoticeController extends Controller
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
            return view('notice/index', compact('data'));
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
        $data = new Notice();
        return view('notice.form', compact('data'));
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
                'judul' => 'required',
                'isi' => 'required',
            ],
            [
                'judul.required' => 'Kolom judul wajib diisi',
                'isi.required' => 'Kolom isi wajib diisi'

            ]
        );

        $data = Notice::insert([
            [
                'tanggal' => date('Y-m-d'),
                'judul' => $request->judul,
                'isi' => $request->isi,
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
        $data = Notice::findOrFail($id);
        return view('notice.form', compact('data'));
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
                'judul' => 'required',
                'isi' => 'required'
            ],
            [
                'judul.required' => 'Kolom judul wajib diisi',
                'isi.required' => 'Kolom isi wajib diisi'
            ]
        );

        $data = Notice::findOrFail($id);
        $data->judul = $request->judul;
        $data->isi = $request->isi;
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
        $data = Notice::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Notice::query();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('layout._action_notice', [
                    'data' => $data,
                    'url_edit' => route('notice.edit', $data->id_pengumuman),
                    'url_destroy' => route('notice.destroy', $data->id_pengumuman),
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
