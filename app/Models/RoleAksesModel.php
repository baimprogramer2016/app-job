<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AksesModel;

class RoleAksesModel extends Model
{
    use HasFactory;

    protected $table = 'roleakses';
    protected $fillable = ['koderole','kodeakses'];

    public function akses(){
        return $this->hasOne(AksesModel::class,'kode','kodeakses');
    }
}
