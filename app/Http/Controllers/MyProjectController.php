<?php

namespace App\Http\Controllers;

use App\Models\ProjectAnggotaModel;
use App\Models\ProjectModel;
use App\Models\ProjectTaskModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MyProjectController extends Controller
{
    //pertama kali dibuka
    public function index(Request $request)
    {
        // return Auth::user()->kode;
        $dataproject = ProjectAnggotaModel::where('kodepengguna', Auth::user()->kode)->paginate(20);

        foreach ($dataproject as $project) {
            //jumlah task 
            $project->jumlahtask = ProjectTaskModel::where('kodeproject', $project->kodeproject)
                ->where('kodepengguna', Auth::user()->kode)->count();

            //jumlah task yang done
            $project->jumlahtaskdone = ProjectTaskModel::where('kodeproject', $project->kodeproject)
                ->where('status', 'D')
                ->where('kodepengguna', Auth::user()->kode)->count();

            if ($project->jumlahtaskdone == 0) {
                $project->jumlahtaskpersen = 0;
            } else {
                $project->jumlahtaskpersen = ($project->jumlahtaskdone /  $project->jumlahtask) * 100;
            }
        }
        // return $dataproject;
        return view('pages.my-project', [
            "dataproject" => $dataproject,
        ]);
    }

    //buka detail project
    public function daftarTask(Request $request, $slug)
    {
        $project = ProjectModel::where('slug', $slug)->first();
        $daftartask = ProjectTaskModel::where('kodeproject', $project->kode)->where('kodepengguna', Auth::user()->kode)->paginate(20);
        foreach ($daftartask as $task) {
            if (date('Y-m-d') >= $task->tanggalakhir) {

                if ($task->status == 'W') {
                    $task->info = 'Melewati Batas waktu';
                    $task->indicator = 'text-danger';
                } else {
                    $task->info = '';
                    $task->indicator = 'text-success';
                }
            } else {
                $task->indicator = 'text-success';
                $task->info = '';
            }
        }
        return view('pages.my-project-task', [
            "daftartask" => $daftartask,
            "project" => $project
        ]);
    }

    //update task 
    public function updateTask(Request $request)
    {
        $datatask = ProjectTaskModel::find($request->id);
        $datatask->update($request->all());
        $task = ProjectTaskModel::find($request->id);

        //status yang lain
        if ($task->status == 'D') {
            $task->indicator = 'green';
            $task->info = '';
            $task->text = 'Done';
        } else {
            $task->text = 'Waiting';
            if (date('Y-m-d') >= $task->tanggalakhir) {
                $task->indicator = 'red';
                $task->info = 'Melewati Batas waktu';
            } else {
                $task->indicator = 'green';
                $task->info = '';
            }
        }
        return $task;
    }
}
