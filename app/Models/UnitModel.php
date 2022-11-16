<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = ['kode','nama','deskripsi','kodedivisi','allowed'];

    public function divisi(){
        return $this->hasOne(DivisiModel::class, "kode", "kodedivisi");
    }
}
