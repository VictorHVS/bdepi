<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalavraChave extends Model
{
    protected $table = 'palavras_chave';

    protected $fillable = [
        'nome',
    ];

    public function pesquisas()
    {
        return $this->belongsToMany(Pesquisa::class, 'pesquisas_chaves');
    }
}
