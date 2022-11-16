<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleAksesModel;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = ['kode','nama','deskripsi','allowed','updated_at'];

    public function roleakses(){
        return $this->hasMany(RoleAksesModel::class,'koderole','kode');
    }
}
