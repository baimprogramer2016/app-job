<?php

namespace App\Http\Controllers;

use App\Models\ProjectAnggotaModel;
use App\Models\ProjectTaskModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\NotificationModel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


class ProjectController extends Controller
{
    public function index()
    {
        if (Auth::user()->kode == 'admin') {
            $dataproject    = ProjectModel::paginate(20);
        } else {
            $dataproject    = ProjectModel::wherein('kodepengguna', [Auth::user()->kode])->paginate(20);
        }

        foreach ($dataproject as $project) {
            $project->jumlahtask        =   $project->task->count();
            $project->jumlahtaskdone    =   $project->task->where('status', 'D')->count();
            if ($project->jumlahtaskdone == 0) {
                $project->jumlahtaskpersen = 0;
            } else {
                $project->jumlahtaskpersen  =   ($project->jumlahtaskdone / $project->jumlahtask) * 100;
            }
        }

        // return $dataproject;
        return view("pages.project", [
            "dataproject" => $dataproject,
        ]);
    }

    //menampilkan form tambah
    public function add()
    {
        return view('pages.project-add');
    }

    //store project
    public function store(Request $request)
    {

        $validate = $request->validate([
            'kode' => 'required|unique:project',
            'alias' => 'required',
            'nama' => 'required|unique:project',
            'deskripsi' => 'required',
        ]);
        $validate['kodepengguna'] = Auth::user()->kode;
        $validate['slug'] = Str::of($request->nama)->slug('-');
        $validate['domain'] = '';


        ProjectModel::create($validate);

        return redirect()->route('project')->with(['message' => 'Data Berhasil Disimpan']);
    }
    //hapus project
    public function delete(Request $request)
    {
        $delete = ProjectModel::find($request->id);
        $checkdata = ProjectAnggotaModel::where('kodeproject', $delete->kode)->count();
        if ($checkdata == 0) {
            $delete->delete();
            return $request->id;
        } else {
            return 'failed';
        }
    }


    //detail project
    public function detail(Request $request, $slug)
    {

        $dataproject = ProjectModel::where('slug', $slug)->first();
        $datatask = ProjectTaskModel::where('kodeproject', $dataproject->kode)->get();


        $dataanggota = ProjectAnggotaModel::where('kodeproject', $dataproject->kode)->paginate(20);

        foreach ($dataanggota as $anggota) {
            //mencari jumlah total per orang tiap project
            $jumlahtask     =   $datatask->where('kodepengguna', $anggota->kodepengguna)->where('kodeproject', $dataproject->kode)->count();
            $jumlahtaskdone =   $datatask->where('kodepengguna', $anggota->kodepengguna)->where('kodeproject', $dataproject->kode)->where('status', 'D')->count();
            if ($jumlahtaskdone == 0) {
                $jumlahpercent  =  0;
            } else {
                $jumlahpercent  = ($jumlahtaskdone / $jumlahtask) * 100;
            }
            $anggota->taskselesai = $jumlahtaskdone;
            $anggota->taskpersen = $jumlahpercent;
            $anggota->jumlahtask = $jumlahtask;
        }

        // return $dataanggota;
        return view('pages.project-detail', [
            "dataproject" => $dataproject,
            "dataanggota" => $dataanggota,
            "datatask" => $datatask,
        ]);
    }

    //################### TAMBAH MEMBER ############################################
    //project tambah member
    public function tambahMember(Request $request, $slug)
    {
        //data project
        $dataproject = ProjectModel::where("slug", $slug)->first();

        //data anggota semua;
        $dataanggota = User::where('kode', '!=', 'admin')->get();
        //data anggota = 

        $dataanggotaproject = ProjectAnggotaModel::where("kodeproject", $dataproject->kode)->get();

        return view('pages.project-tambah-member', [
            "dataproject" =>  $dataproject,
            "dataanggotaproject" =>  $dataanggotaproject,
            "dataanggota" =>  $dataanggota,
        ]);
    }

    //simpan member
    public function storeMember(Request $request)
    {
        $check = ProjectAnggotaModel::where("kodeproject", $request->kodeproject)
            ->where("kodepengguna", $request->kodepengguna)->get()->count();
        if ($check != 0) {
            return redirect()->route('project-tambah-member', $request->slug)
                ->with('message', 'Anggota telah terdaftar')
                ->with('alertcolor', 'danger');
        }
        ProjectAnggotaModel::create($request->all());

        //insert notification
        $notification = [
            "judul" => 'Undangan Anggota',
            "deskripsi" => 'Undangan dalam suatu Project ' . $request->kodeproject,
            "kodepengguna" => $request->kodepengguna,
            "url" => route('my-project')
        ];
        NotificationModel::create($notification);

        return redirect()->route('project-tambah-member', $request->slug)
            ->with('message', 'Berhasil menambahkan Anggota')
            ->with('alertcolor', 'success');
    }

    //hapusmember
    public function hapusMember(Request $request)
    {
        //cek task dlu jika ada jngn dihapus
        $delete = ProjectAnggotaModel::where('kodeproject', $request->kodeproject)
            ->where('kodepengguna', $request->kodepengguna)->first();

        $cektask = ProjectTaskModel::where('kodeproject', $request->kodeproject)->where('kodepengguna', $request->kodepengguna)->get()->count();
        if ($cektask == 0) {
            $delete->delete();
            return 'success';
        } else {
            return 'failed';
        }
    }


    //################## TASK ########################
    //project tambah member
    public function tambahTask(Request $request, $slug)
    {
        //data project
        $dataproject = ProjectModel::where("slug", $slug)->first();

        $datatugas   = ProjectTaskModel::where('kodeproject', $dataproject->kode)->paginate(20);
        foreach ($datatugas as $tugas) {
            $tugas->info = '';
            if ($tugas->status == 'W') {
                if (date('Y-m-d') >= $tugas->tanggalakhir) {
                    $tugas->info = 'Melewati Batas waktu';
                }
            }
        }

        //data anggota semua;
        // $dataanggota = User::where('kode', '!=', 'admin')->get();
        $dataanggota = ProjectAnggotaModel::where('kodeproject', $dataproject->kode)->get();

        return view('pages.project-tambah-task', [
            "datatugas" => $datatugas,
            "dataproject" =>  $dataproject,
            "dataanggota" =>  $dataanggota,
        ]);
    }


    //simpan task
    public function storeTask(Request $request)
    {
        $validate = $request->validate([
            'kodeproject' => 'required',
            'kodepengguna' => 'required',
            'subject' => 'required',
            'deskripsi' => 'required',
            'tanggalakhir' => 'required'
        ]);

        $validate['tanggal'] = date("Y-m-d h:i:s");
        $validate['status'] = 'W';


        ProjectTaskModel::create($validate);

        return redirect()->route('project-tambah-task', $request->slug)
            ->with('message', 'Berhasil menambahkan Task')
            ->with('alertcolor', 'success');
    }

    public function editTask(Request $request, $slug, $id)
    {
        $dataproject = ProjectModel::where("slug", $slug)->first();
        $datatugas   = ProjectTaskModel::where('kodeproject', $dataproject->kode)->paginate(20);

        //data yang akan di edit
        $datatugasid = ProjectTaskModel::where('id', $id)->first();


        //data anggota semua;
        $dataanggota = User::where('kode', '!=', 'admin')->get();

        return view('pages.project-edit-task', [
            "dataproject" =>  $dataproject,
            "datatugas" => $datatugas,
            "dataanggota" =>  $dataanggota,
            "datatugasid" => $datatugasid
        ]);
    }

    public function updateTask(Request $request, $id)
    {
        $validate = $request->validate([
            'kodeproject' => 'required',
            'kodepengguna' => 'required',
            'subject' => 'required',
            'deskripsi' => 'required',
            'tanggalakhir' => 'required'
        ]);
        $validate['status'] = 'W';

        $update = ProjectTaskModel::find($id);
        $update->update($validate);

        return redirect()->route('project-tambah-task', $request->slug)
            ->with('message', 'Berhasil Mengubah Task')
            ->with('alertcolor', 'success');
    }

    //delete task
    public function deleteTask(Request $request)
    {

        $delete = ProjectTaskModel::find($request->id);
        $checkdata = ProjectTaskModel::where('id', $request->id)->where('status', 'D')->get()->count();
        if ($checkdata == 0) {
            $delete->delete();
            return $request->id;
        } else {
            return 'failed';
        }
    }

    //detail task
    public function detailTask(Request $request, $slug, $kodeproject, $kodepengguna)
    {
        $datatask = ProjectTaskModel::where('kodeproject', $kodeproject)->where('kodepengguna', $kodepengguna)->get();
        foreach ($datatask as $tugas) {
            $tugas->info = '';
            if ($tugas->status == 'W') {
                if (date('Y-m-d') >= $tugas->tanggalakhir) {
                    $tugas->info = 'Melewati Batas waktu';
                }
            }
        }

        return view('pages.project-detail-task', [

            "slug" => $slug,
            "kodeproject" => $kodeproject,
            "kodepengguna" => $kodepengguna,
            "datatask" => $datatask,
        ]);
    }
}
