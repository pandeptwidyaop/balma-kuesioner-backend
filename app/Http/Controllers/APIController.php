<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function cek(){
      return 'hello';
    }

    public function cuk(Request $r){

      return response()->json($r->all());
    }
}
