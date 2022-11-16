<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UnitModel;
use App\Models\RoleModel;
use App\Models\LevelModel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'kode',
        'nama',
        'email',
        'password',
        'kodeunit',
        'koderole',
        'kodelevel',
        'allowed',
    ];


    public function unit(){
        return $this->hasOne(UnitModel::class,'kode','kodeunit');
    }

    public function role(){
        return $this->hasOne(RoleModel::class,'kode','koderole');
    }

    public function level(){
        return $this->hasOne(LevelModel::class,'kode','kodelevel');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
