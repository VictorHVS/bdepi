<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Data extends Model
{
    use PostgisTrait;

    protected $table = 'datas';

    protected $fillable = [
        'title',
        'info',
        'value',
        'geom',
        'research_id',
        'data_attain',
    ];

    protected $postgisFields = [
        'geom' => Point::class,
    ];

    public function research()
    {
        return $this->belongsTo(Research::class);
    }
}
