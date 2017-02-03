<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participantes';
    
      protected $fillable = [];
	  
	  public function avaliacao() {
 
		return $this->hasOne('App\Avaliacao', 'CODAVALIACAO', 'CODAVALIACAO');
		
	   }
	   
	   public function funcionario() {
 
		return $this->hasOne('App\Funcionario', 'CHAPA', 'CHAPAAVALIADO');
		
	   }
	  
	    public function aval() {
 
		return $this->hasOne('App\Funcionario', 'CHAPA', 'CHAPAAVALIADOR');
		
	   }
	   
	    public function pessoa() {
 
		return $this->hasOne('App\Funcionario', 'CHAPA', 'CHAPAAVALIADO');
		
	   }
	   
	  
}
