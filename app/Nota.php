<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    
    protected $fillable = [];
    
     public function participante() {
 
		return $this->hasOne('App\Participante', 'CODPARTICIPANTE', 'CODPARTICIPANTE');
		
	   }
       
     
        public function competencia() {
 
		return $this->hasOne('App\Competencia', 'CODCOMPETENCIA', 'CODITEMAVAL');
		
	   }
      
    
}
