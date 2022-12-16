<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['currency'];

    public function rates(){
        return $this->hasMany(Rate::class, 'currency', 'currency');
    }
}
