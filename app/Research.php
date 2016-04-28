<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'researches';

    protected $fillable = [
        'title',
        'abstract',
        'publish_date',
        'is_publico',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keyWords()
    {
        return $this->belongsToMany(KeyWord::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
