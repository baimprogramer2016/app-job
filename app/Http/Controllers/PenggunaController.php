<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitModel;
use App\Models\RoleModel;
use App\Models\LevelModel;

use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    
//halaman pertama dibuka    
public function index()
{
    $data   =   User::orderBy('id', 'asc')->paginate(5)->withQueryString();
    return view('pages.pengguna',[
        'datapengguna' => $data
    ]);
}
//menampilkan form tambah
public function add()
{
    $dataunit = UnitModel::all();
    $datarole = RoleModel::all();
    $datalevel = LevelModel::all();
    return view('pages.pengguna-add',[
        "dataunit" => $dataunit,
        "datarole" => $datarole,
        "datalevel" => $datalevel,
    ]);
}

//simpan data
public function store(Request $request)
{
    $validate = $request->validate([
        'kode' => 'required|unique:users',
        'nama' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'kodeunit' => 'required',
        'koderole' => 'required',
        'kodelevel' => 'required',
        'allowed' => 'required'
    ]);

    $datastore = [
        "kode" => $request->kode,
        "nama" => $request->nama,
        "email" => $request->email,
        "password" => Hash::make($request->password),
        "kodeunit" => $request->kodeunit,
        "koderole" => $request->koderole,
        "kodelevel" => $request->kodelevel,
        "allowed" => $request->allowed,
        "updated_at" => date("Y-m-d h:i:s"),
        "created_at" => date("Y-m-d h:i:s")
    ];
    
    
   User::create($datastore);

    return redirect()->route('pengguna')->with(['message'=> 'Data Berhasil Disimpan']);
}    

// //delete data
public function delete(Request $request)
{
    $delete = User::find($request->id);
    $delete->delete();
    return $request->id;
}    
// //edit
public function edit($id)
{
    $datapengguna = User::find($id);
    $dataunit = UnitModel::all();
    $datarole = RoleModel::all();
    $datalevel = LevelModel::all();
    
    return view('pages.pengguna-edit',[
        "datapengguna" => $datapengguna,
        "dataunit" => $dataunit,
        "datarole" => $datarole,
        "datalevel" => $datalevel,
    ]);
}
// //update
public function update(Request $request , $id)
{
    
    $validate = $request->validate([
        'kode' => 'required',
        'nama' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'kodeunit' => 'required',
        'koderole' => 'required',
        'kodelevel' => 'required',
        'allowed' => 'required'
    ]);

    if ($request->password == $request->password_old) {
        $pass = $request->password_old;
    }else{
        $pass = Hash::make($request->password);
    }

    $datastore = [
        "kode" => $request->kode,
        "nama" => $request->nama,
        "email" => $request->email,
        "password" => $pass,
        "kodeunit" => $request->kodeunit,
        "koderole" => $request->koderole,
        "kodelevel" => $request->kodelevel,
        "allowed" => $request->allowed,
        "updated_at" => date("Y-m-d h:i:s"),
        "created_at" => date("Y-m-d h:i:s")
    ];

    $update = User::find($id);
    $update->update($datastore);

    return redirect()->route('pengguna')->with(['message'=> 'Data Berhasil Di Rubah']);

}


}
