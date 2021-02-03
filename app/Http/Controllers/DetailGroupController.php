<?php

namespace App\Http\Controllers;

use DataTables;
use App\Student;
use App\Lecturer;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class DetailGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Group::findOrFail($id);
        return view('detailgroup/index', compact('data'));
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
        
    }

    public function updatestudent($id)
    {
        $data = Student::findOrFail($id);
        $data->id_grup = NULL;
        $data->save();
        
    }

    public function updatelecturer($id)
    {
        $data = Lecturer::findOrFail($id);
        $data->id_grup = NULL;
        $data->save();
        
    }
    
    public function dataTableStudent($id)
    {
        $data = DB::table('groups')
        ->join('students','groups.id_grup','=','students.id_grup')
        ->select('groups.*','students.*')
        ->where('groups.id_grup', $id)
        ->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_dgstudent', [
                'data' => $data,
                'url_destroy' => route('detailgroup.updatestudent', $data->nim)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
    public function dataTableLecturer($id)
    {
        $data = DB::table('groups')
        ->join('lecturers','groups.id_grup','=','lecturers.id_grup')
        ->select('groups.*','lecturers.*')
        ->where('groups.id_grup', $id)
        ->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_dglecturer', [
                'data' => $data,
                'url_destroy' => route('detailgroup.updatelecturer', $data->nidn)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
