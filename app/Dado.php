<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;

class Dado extends Model
{
    use PostgisTrait;

    protected $table = 'dados';

    protected $fillable = [
        'nome',
        'geom'
    ];

    protected $postgisFields = [
        'geom' => Point::class
    ];
}
