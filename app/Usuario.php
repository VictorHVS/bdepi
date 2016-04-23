<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

    protected $table = 'usuarios';

    public function pesquisas(){
        return $this->hasMany(Pesquisa::class);
    }

    public function dados(){
        return $this->hasManyThrough(Dado::class, Pesquisa::class);
    }
}
