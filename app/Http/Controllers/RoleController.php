<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\AksesModel;
use App\Models\RoleAksesModel;
use App\Models\User;

class RoleController extends Controller
{

    //halaman pertama dibuka    
    public function index()
    {
        $data   =   RoleModel::with(['roleakses'])->orderBy('id', 'desc')->paginate(5)->withQueryString();
        return view('pages.role', [
            'datarole' => $data
        ]);
    }
    //menampilkan form tambah
    public function add()
    {
        return view('pages.role-add');
    }

    //simpan data
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode' => 'required|unique:role',
            'nama' => 'required',
            'deskripsi' => 'required',
            'allowed' => 'required'
        ]);


        RoleModel::create($validate);

        return redirect()->route('role')->with(['message' => 'Data Berhasil Disimpan']);
    }
    //delete data
    public function delete(Request $request)
    {
        $delete = RoleModel::find($request->id);

        //jika sudah ada user yang make tidak bisa dihapus
        $check = User::where("koderole", $delete->kode)->get()->count();
        if ($check == 0) {

            //delete juga yang di roleakses
            $deleteroleakses = RoleAksesModel::where("koderole", $delete->kode);

            $delete->delete();
            $deleteroleakses->delete();
            return $request->id;
        } else {
            return "failed";
        }
    }
    //edit
    public function edit($id)
    {
        $datarole = RoleModel::find($id);

        return view('pages.role-edit', [
            "dataroleedit" => $datarole
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

        $update = RoleModel::find($id);
        $update->update($validate);

        return redirect()->route('role')->with(['message' => 'Data Berhasil Di Rubah']);
    }
    //form access
    public function access($id)
    {
        $koderole   = RoleModel::find($id);
        $roleakses  = RoleAksesModel::where("koderole", $koderole->kode)->get();
        $dataakses  = AksesModel::orderBy('id', 'desc')->get();

        return view('pages.role-akses', [
            "koderole" => $koderole->kode,
            'dataaccess' => $dataakses,
            'roleakses' => $roleakses,
        ]);
    }

    //store access role
    public function accessStore(Request $request)
    {
        //hapus dlu jika ada agar diinsert ulang
        $deleteroleaccess   = RoleAksesModel::where("koderole", $request->koderole);
        $deleteroleaccess->delete();

        if (is_array($request->kodeakses) || is_object($request->kodeakses)) {
            //insert lagi
            foreach ($request->kodeakses as $key => $kodeakses) {
                $data = [
                    "koderole" => $request->koderole,
                    "kodeakses" => $kodeakses,
                    "created_at" => date('Y-m-d h:i:s'),
                    "updated_at" => date('Y-m-d h:i:s'),
                ];
                RoleAksesModel::insert($data);
            }
        }

        return redirect()->route('role')->with(['message', 'Data berhasil di update']);
    }
}
