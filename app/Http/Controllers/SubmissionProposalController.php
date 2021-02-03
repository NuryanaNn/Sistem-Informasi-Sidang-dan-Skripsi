<?php

namespace App\Http\Controllers;

use App\SubmissionProposal;
use App\Grade;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SubmissionProposalController extends Controller
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
        compact('data');
        $data2 = Grade::where('nim', $data->nim)->first();
        
        return view('submission_proposal/index', compact('data','data2'));
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
         return view('submission_proposal.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_pp = 'PP'.date('dmy').Str::random(2);
         $this->validate(
            $request,
            [
                'topik_skripsi' => 'required',
                'file_krs' => 'required|mimes:pdf,doc,docx|max:2048',
                'file_khs' => 'required|mimes:pdf,doc,docx|max:2048',
                'file_proposal' => 'required|mimes:pdf,,doc,docx|max:2048',

            ],
            [
                'topik_skripsi.required' => 'Kolom topik skripsi wajib diisi',
                'file_krs.required' => 'Wajib mengunggah file krs',
                'file_krs.mimes' => 'Format file salah',
                'file_krs.max' => 'File terlalu besar, maksimal 2MB',
                'file_khs.required' => 'Wajib mengunggah file khs',
                'file_khs.mimes' => 'Format file salah',
                'file_khs.max' => 'File terlalu besar, maksimal 2MB',
                'file_proposal.required' => 'Wajib mengunggah file skripsi',
                'file_proposal.mimes' => 'Format file salah',
                'file_proposal.max' => 'File terlalu besar, maksimal 2MB'


            ]
        );
        $file_krs = 'KRS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_krs = $request->file_krs->getClientOriginalExtension();
        $request->file_krs->move(public_path('upload/pengajuan/krs'), $file_krs . '.' . $extension_krs);
        $file_khs = 'KHS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_khs = $request->file_khs->getClientOriginalExtension();
        $request->file_khs->move(public_path('upload/pengajuan/khs'), $file_khs . '.' . $extension_khs);
        $file_proposal = 'PP'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
        $extension_proposal = $request->file_proposal->getClientOriginalExtension();
        $request->file_proposal->move(public_path('upload/pengajuan/pp'), $file_proposal . '.' . $extension_proposal);
        $data = SubmissionProposal::insert([
            [
               'id_pp' => $id_pp,
               'nim' => Session::get('username'),
               'topik_skripsi' => $request->topik_skripsi,
               'file_krs' => $file_krs . '.' . $extension_krs,
               'file_khs' => $file_khs . '.' . $extension_khs,
               'file_proposal' => $file_proposal . '.' . $extension_proposal,
               'tanggal' => $request->tanggal,
               'status' => 'proses',
               'created_at' => now()

            ]
        ]);

        if ($data) {
            $request->session()->flash('success', 'Data berhasil ditambahkan');
        }else{
            $request->session()->flash('error', 'Data gagal ditambahkan');
        }

        
        return redirect('submission_proposal');
        
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
        $data = SubmissionProposal::findOrFail($id);
        return view('submission_proposal/edit', compact('data'));

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
                'topik_skripsi' => 'required',
                'file_krs' => 'mimes:pdf|max:2048',
                'file_khs' => 'mimes:pdf|max:2048',
                'file_proposal' => 'mimes:pdf,doc,docx|max:2048',
                'tanggal' => 'required',
            ],
            [
                'topik_skripsi.required' => 'Kolom topik skripsi wajib diisi',
                'file_krs.mimes' => 'Format file salah',
                'file_krs.max' => 'File terlalu besar, maksimal 2MB',
                'file_khs.mimes' => 'Format file salah',
                'file_khs.max' => 'File terlalu besar, maksimal 2MB',
                'file_proposal.mimes' => 'Format file salah',
                'file_proposal.max' => 'File terlalu besar, maksimal 2MB',
                'tanggal.required' => 'tanggal wajib diisi'
            ]

        );
        $data = SubmissionProposal::findOrFail($id);

        $file_krs = $request->file_krs;
        if ($file_krs == NULL) {
            $file_krs = $request->old_file_krs;
        }else{
            unlink(public_path('upload/pengajuan/krs/'.$data->file_krs));
            $fileName = 'KRS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_krs->getClientOriginalExtension();
            $request->file_krs->move(public_path('upload/pengajuan/krs'), $fileName . '.' . $extension);
            $file_krs = $fileName . '.' . $extension;
        }

        $file_khs = $request->file_khs;
        if ($file_khs == NULL) {
            $file_khs = $request->old_file_khs;
        }else{
            unlink(public_path('upload/pengajuan/khs/'.$data->file_khs));
            $fileName = 'KHS'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_khs->getClientOriginalExtension();
            $request->file_khs->move(public_path('upload/pengajuan/khs'), $fileName . '.' . $extension);
            $file_khs = $fileName . '.' . $extension;
        }

        $file_proposal = $request->file_proposal;
        if ($file_proposal == NULL) {
            $file_proposal = $request->old_file_proposal;
        }else{
            unlink(public_path('upload/pengajuan/pp/'.$data->file_proposal));
            $fileName = 'PP'.Str::replaceFirst('.', '', Session::get('username')).'-'.date('His');
            $extension = $request->file_proposal->getClientOriginalExtension();
            $request->file_proposal->move(public_path('upload/pengajuan/pp'), $fileName . '.' . $extension);
            $file_proposal = $fileName . '.' . $extension;
        }

        $data->topik_skripsi = $request->topik_skripsi;
        $data->file_krs = $file_krs;
        $data->file_khs = $file_khs;
        $data->file_proposal = $file_proposal;
        $data->tanggal = $request->tanggal;
        $data->save();

        $request->session()->flash('success', 'Data berhasil diubah');
        return redirect('submission_proposal');
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
        $data = SubmissionProposal::where('nim',Session::get('username'))->get();
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
            return view('layout._action_sp', [
                'data' => $data,
                'url_edit' => route('submission_proposal.edit', $data->id_pp)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['krs', 'khs', 'proposal', 'status', 'action'])
        ->make(true);
    }
}
