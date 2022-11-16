<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitModel;
use App\Models\DivisiModel;
use App\Models\User;

class UnitController extends Controller
{
//pertama kli    
    public function index(){
        $dataunit = UnitModel::with(['divisi'])->orderby("id","desc")->paginate(10);
        
        return view('pages.unit',[
            "dataunit" => $dataunit
        ]);
    }
//menampilkan form tambah
    public function add()
    {
        $datadivisi = DivisiModel::all();
        return view('pages.unit-add',[
            "datadivisi" => $datadivisi,
        ]);
    }
//store
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode' => 'required|unique:unit',
            'nama' => 'required',
            'deskripsi' => 'required',
            'kodedivisi' => 'required',
            'allowed' => 'required'
        ]);

        
        UnitModel::create($validate);

        return redirect()->route('unit')->with(['message'=> 'Data Berhasil Disimpan']);
    }        
//delete data
public function delete(Request $request)
{
    $delete = UnitModel::find($request->id);

    //jika sudah ada user yang make tidak bisa dihapus
    $check = User::where("kodeunit", $delete->kode)->get()->count();
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
    $dataunit = UnitModel::with(['divisi'])->find($id);
    $datadivisi = DivisiModel::all();
    return view('pages.unit-edit',[
        "dataunitedit" => $dataunit,
        "datadivisi" => $datadivisi,
    ]);
}

//update
public function update(Request $request,$id)
{
    $validate = $request->validate([
        'kode' => 'required',
        'nama' => 'required',
        'deskripsi' => 'required',
        'kodedivisi' => 'required',
        'allowed' => 'required'
    ]);

    $update = UnitModel::find($id);
    $update->update($validate);

    return redirect()->route('unit')->with(['message'=> 'Data Berhasil Di Rubah']);
}
    
}
