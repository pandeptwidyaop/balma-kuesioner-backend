<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
      'nim',
      'ip_addresss'
    ];

    public function Answer(){
      return $this->hasMany('App\Answer');
    }
}
