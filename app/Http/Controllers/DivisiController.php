<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivisiModel;
use App\Models\UnitModel;

class DivisiController extends Controller
{
    //halaman pertama dibuka    
    public function index()
    {
        $data   =   DivisiModel::with(['unit'])->orderBy('id', 'desc')->paginate(5)->withQueryString();
        return view('pages.divisi', [
            'datadivisi' => $data
        ]);
    }
    //menampilkan form tambah
    public function add()
    {
        return view('pages.divisi-add');
    }

    //simpan data
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode' => 'required|unique:divisi',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);


        DivisiModel::create($validate);

        return redirect()->route('divisi')->with(['message' => 'Data Berhasil Disimpan']);
    }
    //delete data
    public function delete(Request $request)
    {
        $delete = DivisiModel::find($request->id);

        $check = UnitModel::where("kodedivisi", $delete->kode)->get()->count();
        if ($check == 0) {
            $delete->delete();
            return $request->id;
        } else {
            return "failed";
        }
    }
    //edit
    public function edit($id)
    {
        $datadivisi = DivisiModel::find($id);

        return view('pages.divisi-edit', [
            "datadivisiedit" => $datadivisi
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

        $update = DivisiModel::find($id);
        $update->update($validate);

        return redirect()->route('divisi')->with(['message' => 'Data Berhasil Di Rubah']);
    }
}
