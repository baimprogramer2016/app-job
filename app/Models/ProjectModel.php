<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $fillable = ['kode', 'kodepengguna', 'alias', 'nama', 'deskripsi', 'slug', 'domain'];

    public function task()
    {
        return $this->hasMany(ProjectTaskModel::class, 'kodeproject', 'kode');
    }
}
