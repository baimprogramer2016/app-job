<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProjectTaskModel;

class ProjectAnggotaModel extends Model
{
    use HasFactory;
    protected $table = 'project_anggota';
    protected $fillable = ['kodeproject', 'kodepengguna'];

    public function user()
    {
        return $this->hasOne(User::class, 'kode', 'kodepengguna');
    }

    public function project()
    {
        return $this->hasOne(ProjectModel::class, 'kode', 'kodeproject');
    }


    public function task()
    {
        return $this->hasMany(ProjectTaskModel::class, 'kodepengguna', 'kodepengguna');
    }
}
