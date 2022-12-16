<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = ['date'];

    public function rates()
    {
        return $this->hasMany(Rate::class, 'date', 'date');
    }
}
