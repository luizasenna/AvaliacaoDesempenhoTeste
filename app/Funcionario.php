<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
      protected $table = 'funcionarios';
    
      protected $fillable = [];
	  
	  public function funcao() {
 
		return $this->hasOne('App\Funcao', 'CODIGO', 'CODFUNCAO');
	   }

	   public function equipe() {
 
		return $this->hasOne('App\Equipe', 'CODINTERNO', 'CODEQUIPE');
	   } 
	   
	  
}
