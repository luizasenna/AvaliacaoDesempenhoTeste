<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
     protected $table = 'funcoes';
    
      protected $fillable = [];
	  
	   public function funcionarios() {
        return $this->hasMany('App\Funcionario', 'CODFUNCAO');
    }
	
}
