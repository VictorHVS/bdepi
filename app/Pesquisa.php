<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    protected $table = 'pesquisas';

    protected $fillable = [
        'nome',
        'data_publicacao',
        'resumo',
        'is_publico'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function palavrasChave()
    {
        return $this->belongsToMany(PalavraChave::class, 'pesquisas_chaves');
    }
}
