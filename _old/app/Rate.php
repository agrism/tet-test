<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['rate', 'date', 'currency'];

    public function dates(){
        return $this->hasMany(Date::class, 'date');
    }
}
