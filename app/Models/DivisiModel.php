<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiModel extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = ['kode','nama','deskripsi','allowed','updated_at'];

    public function unit()
    {
        return $this->hasMany(UnitModel::class,"kodedivisi","kode");
    }
}
