<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
      'number', 'question'
    ];

    public function Answer(){
      return $this->hasMany('App\Answer');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
