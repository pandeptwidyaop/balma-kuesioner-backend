<?php

namespace App\Transformers;

use App\Participant;
use League\Fractal\TransformerAbstract;
/**
 *
 */
class ParticipantTransformer extends TransformerAbstract
{

  public function transform(Participant $participant){
    return [
      'nim' => $participant->nim,
    ];
  }

}
