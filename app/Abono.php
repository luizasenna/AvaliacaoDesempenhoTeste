<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Abono extends Model
{
      protected $table = 'abonos';

      protected $fillable = ['id','codigo','descricao','status', 'idusuario'];
      protected $dates = ['updated_at', 'created_at'];

      public function usuario() {
         return $this->hasOne('App\User', 'id', 'idusuario');
       }


}
