<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Dado extends Model
{
    use PostgisTrait;

    protected $table = 'dados';

    protected $fillable = [
        'nome',
        'data_coleta',
        'info',
        'valor',
        'geom'
    ];

    protected $postgisFields = [
        'geom' => Point::class
    ];

    public function pesquisa()
    {
        return $this->belongsTo(Pesquisa::class);
    }
}
