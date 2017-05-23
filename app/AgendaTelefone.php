<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaTelefone extends Model
{
     protected $table = 'agendaTelefones';
    
      protected $fillable = [];


      public function tipo(){
      	 return $this->hasOne('App\AgendaTelefoneTipo', 'id', 'idtipo');

      }
}
