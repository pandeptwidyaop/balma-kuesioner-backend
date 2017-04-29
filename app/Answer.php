<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
      'question_id',
      'participant_id',
      'answer'
    ];

    public function Question(){
      return $this->belongsTo('App\Question');
    }

    public function Participant(){
      return $this->belongsTo('App\Participant');
    }
}
