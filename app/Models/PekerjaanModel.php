<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanModel extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';
    protected $fillable = ['subject', 'deskripsi', 'kodepengguna', 'slug'];
}
