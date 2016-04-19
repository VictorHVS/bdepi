<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Dados extends Model
{
    use PostgisTrait;

    protected $fillable = [
        'nome',
        'geom'
    ];

    protected $postgisFields = [
        'geom' => Point::class
    ];
}
