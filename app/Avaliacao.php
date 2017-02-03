<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    
      protected $fillable = [];
	  
	   public function participantes() {
        return $this->hasMany('App\Participante', 'CODAVALIACAO', 'CODAVALIACAO');
		}
		
				
		
}
