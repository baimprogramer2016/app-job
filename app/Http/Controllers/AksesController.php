<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AksesModel;
use App\Models\RoleAksesModel;


class AksesController extends Controller
{

    //halaman pertama dibuka    
    public function index()
    {
        $data   =   AksesModel::orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('pages.akses', [
            'dataakses' => $data
        ]);
    }
    //menampilkan form tambah
    public function add()
    {
        return view('pages.akses-add');
    }

    //simpan data
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode' => 'required|unique:akses',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);


        AksesModel::create($validate);

        return redirect()->route('akses')->with(['message' => 'Data Berhasil Disimpan']);
    }
    //delete data
    public function delete(Request $request)
    {
        //delete di akses
        $delete = AksesModel::find($request->id);

        //delete juga di roleakses
        $deleteroleakses = RoleAksesModel::where("kodeakses", $delete->kode);

        $delete->delete();
        $deleteroleakses->delete();


        return $request->id;
    }
    //edit
    public function edit($id)
    {
        $dataakses = AksesModel::find($id);

        return view('pages.akses-edit', [
            "dataaksesedit" => $dataakses
        ]);
    }
    //update
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);

        $update = AksesModel::find($id);
        $update->update($validate);

        return redirect()->route('akses')->with(['message' => 'Data Berhasil Di Rubah']);
    }
}
