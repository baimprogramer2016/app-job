<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use App\Models\User;

class LevelController extends Controller
{
//halaman pertama dibuka    
    public function index()
    {
        $data   =   LevelModel::orderBy('kode', 'asc')->paginate(5)->withQueryString();
        return view('pages.level',[
            'datalevel' => $data
        ]);
    }
//menampilkan form tambah
    public function add()
    {
        $number = [0,1,2,3,4];
        return view('pages.level-add',[
            "number" => $number
        ]);
    }

//simpan data
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode' => 'required|unique:Level',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);

        
        LevelModel::create($validate);

        return redirect()->route('level')->with(['message'=> 'Data Berhasil Disimpan']);
    }    
//delete data
    public function delete(Request $request)
    {
        $delete = LevelModel::find($request->id);

        $check = User::where("kodelevel", $delete->kode)->get()->count();
        if($check == 0){
            $delete->delete();
            return $request->id;
        }else{
            return "failed";
        }
    }    
//edit
    public function edit($id)
    {
        $datalevel = LevelModel::find($id);
        $number = [0,1,2,3,4];
        return view('pages.level-edit',[
            "dataleveledit" => $datalevel,
            "number" => $number
        ]);
    }
//update
    public function update(Request $request , $id)
    {
        $validate = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);

        $update = LevelModel::find($id);
        $update->update($validate);

        return redirect()->route('level')->with(['message'=> 'Data Berhasil Di Rubah']);

    }



}
