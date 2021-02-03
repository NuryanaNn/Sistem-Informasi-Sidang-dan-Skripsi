<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecturer;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GroupLecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('group_lecturer/index');
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
        $data = Lecturer::findOrFail($id);
        $group = DB::table('groups')->get();
        $selectGroup = [];
        foreach ($group as $group){
            $selectGroup[$group->id_grup] = $group->nama_grup;
        }
        return view('group_lecturer.form', compact('data','selectGroup'));
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
        $data = Lecturer::findOrFail($id);
        $data->id_grup = $request->id_grup;
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
        
    }
    public function dataTable()
    {
        $data = Lecturer::where('id_grup', NULL)->get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_grouplecturer', [
                'data' => $data,
                'url_edit' => route('grouplecturer.edit', $data->nidn),
                'url_destroy' => route('grouplecturer.destroy', $data->nidn)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }   
}