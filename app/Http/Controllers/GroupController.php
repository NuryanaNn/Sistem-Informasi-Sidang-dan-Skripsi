<?php

namespace App\Http\Controllers;

use App\Group;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            return view('group/index');
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
        $data = new Group();
        return view('group.form', compact('data'));
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
                'nama_grup' => 'required',
                'tahun' => 'required',
            ],
            [
                'nama_grup.required' => 'Kolom nama grup wajib diisi',
                'tahun.required' => 'Kolom tahun wajib diisi'

            ]
        );

        $data = Group::insert([
            [
                'nama_grup' => $request->nama_grup,
                'tahun' => $request->tahun,
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
        $data = Group::findOrFail($id);
        return view('group.form', compact('data'));
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
                'nama_grup' => 'required',
                'tahun' => 'required'
            ],
            [
                'nama_grup.required' => 'Kolom nama grup wajib diisi',
                'tahun.required' => 'Kolom tahun wajib diisi'
            ]
        );

        $data = Group::findOrFail($id);
        $data->nama_grup = $request->nama_grup;
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
        $data = Group::findOrFail($id);
        $data->delete();
    }
    public function dataTable()
    {
        $data = Group::query();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return view('layout._action_group', [
                'data' => $data,
                'url_edit' => route('group.edit', $data->id_grup),
                'url_destroy' => route('group.destroy', $data->id_grup),
                'url_detail' =>route('group.detail', $data->id_grup)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}
