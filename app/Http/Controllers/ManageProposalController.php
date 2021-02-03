<?php

namespace App\Http\Controllers;

use App\Student;
use App\Grade;
use DataTables;
use App\SubmissionProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ManageProposalController extends Controller
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
        return view('manage_proposal/index', compact('data'));
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

        $data = DB::table('submissions_proposal')
        ->join('students','submissions_proposal.nim','=','students.nim')
        ->select('students.*','submissions_proposal.*')
        ->where('students.nim',$id)
        ->get();
        return view('manage_proposal.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = SubmissionProposal::findOrFail($id);
         return view('manage_proposal.form', compact('data'));
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

        $id_nilai = 'NI'.date('dmy').Str::random(2);
        $data2 = Grade::insert([
            [

                'id_nilai' => $id_nilai,
                'nim' => $request->nim,
                'nilai_pengajuan' => $request->nilai_pengajuan,
                'created_at' => now()

            ]
        ]);
        $data = SubmissionProposal::findOrFail($id);
        $data->status = $request->status;
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
        //
    }
    
    
    public function dataTable()
    {
         if(Session::get('login')){
                if (Session::get('hak_akses') == 'mahasiswa'){
                    $ambil = DB::table('students')
                                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                                ->select('students.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'dosen'){
                    $ambil = DB::table('lecturers')
                                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                                ->select('lecturers.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'lppm'){
                    $ambil = DB::table('institutions')
                                ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                                ->select('institutions.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'prodi'){
                    $ambil = DB::table('departments')
                                ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                                ->select('departments.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                }
            }
        $data = DB::table('submissions_proposal')
        ->join('students','submissions_proposal.nim','=','students.nim')
        ->select('students.*','submissions_proposal.*')
        ->where([['status', '=', 'proses'],['students.jurusan', '=', $ambil->jurusan]])
         ->get();
         return DataTables::of($data)
        ->addColumn('krs', function($data){
            $path = 'upload/pengajuan/krs/'.$data->file_krs;
            return view('submission_proposal.link_download', [
                'data' => $data,
                'title' => $data->file_krs,
                'url_download' => $path
            ]);
        })
        ->addColumn('khs', function($data){
            $path = 'upload/pengajuan/khs/'.$data->file_khs;
            return view('submission_proposal.link_download', [
                'data' => $data,
                'title' => $data->file_khs,
                'url_download' => $path
            ]);
        })
        ->addColumn('proposal', function($data){
            $path = 'upload/pengajuan/pp/'.$data->file_proposal;
            return view('submission_proposal.link_download', [
                'data' => $data,
                'title' => $data->file_proposal,
                'url_download' => $path
            ]);
        })
        ->addColumn('status', function($data){
            return view('submission_proposal.status', [
                'data' => $data
            ]);
        })
        ->addColumn('action', function($data){
            return view('layout._action_manageproposal', [
                'data' => $data,
                'url_edit' => route('manage_proposal.edit', $data->id_pp)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['krs', 'khs', 'proposal', 'status', 'action'])
        ->make(true);
    }

    public function dataTable2()
    {
         if(Session::get('login')){
                if (Session::get('hak_akses') == 'mahasiswa'){
                    $ambil = DB::table('students')
                                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                                ->select('students.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'dosen'){
                    $ambil = DB::table('lecturers')
                                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                                ->select('lecturers.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'lppm'){
                    $ambil = DB::table('institutions')
                                ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                                ->select('institutions.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'prodi'){
                    $ambil = DB::table('departments')
                                ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                                ->select('departments.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                }
            }
        $data = DB::table('students')->where('students.jurusan',$ambil->jurusan)->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_riwayatpp', [
                'data' => $data,
                'url_detail' => route('manage_proposal.show', $data->nim),
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }

    
}

