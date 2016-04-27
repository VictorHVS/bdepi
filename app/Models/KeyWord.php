<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    protected $table = 'key_words';

    protected $fillable = [
        'name',
    ];

    public function researches()
    {
        return $this->belongsToMany(Research::class);
    }
}
