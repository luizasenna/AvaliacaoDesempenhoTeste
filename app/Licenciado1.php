<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Avaliacao extends Model
{
    protected $table = 'licenciados';
    
      protected $fillable = [];
	  
	   public function funcionarios() {
        return $this->hasMany('App\Funcionario', 'CHAPAAVALIADO', 'CHAPA');
		}


		public function participantes() {
        return $this->hasMany('App\Particpante', 'CODPARTICIPANTE', 'CODPARTICIPANTE');
		}
		
				
		
}
