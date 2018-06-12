<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assiduidade extends Model
{
      protected $table = 'assiduidade';

      protected $fillable = [];

      public function usuario() {
         return $this->hasOne('App\User', 'id', 'idusuario');

 		}

    public function avaliacao(){
         return $this->hasOne('App\Avaliacao', 'CODAVALIACAO', 'codavaliacao');

    }

}
