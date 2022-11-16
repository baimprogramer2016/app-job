<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PekerjaanController extends Controller
{
    public function index(Request $request)
    {
        $datapekerjaan = PekerjaanModel::where('kodepengguna', Auth::user()->kode)->paginate(20);
        return view('pages.pekerjaan', [
            "datapekerjaan" => $datapekerjaan
        ]);
    }

    //add 
    public function add(Request $request)
    {
        return view('pages.pekerjaan-add');
    }

    // store
    public function store(Request $request)
    {
        $validate = $request->validate([
            "subject" => "required|unique:pekerjaan",
            "deskripsi" => "required"
        ]);

        $validate['slug'] = Str::of($request->subject)->slug('-');
        $validate['kodepengguna'] = Auth::user()->kode;

        PekerjaanModel::create($validate);

        return redirect()->route('pekerjaan')->with(['message' => 'Data berhasil disimpan']);
    }

    //delete
    public function delete(Request $request)
    {
        $delete = PekerjaanModel::find($request->id);
        $delete->delete();
    }
}
