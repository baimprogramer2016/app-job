<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTaskModel extends Model
{
    use HasFactory;
    protected $table = 'project_tugas';
    protected $fillable = ['kodeproject', 'kodepengguna', 'subject', 'deskripsi', 'tanggal', 'tanggalakhir', 'status'];

    public function user()
    {
        return $this->hasOne(User::class, 'kode', 'kodepengguna');
    }
}
