<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
     protected $table = 'pessoas';
    
     protected $fillable = ['CODIGO','NOME','DTNASCIMENTO','IDIMAGEM'];
	  
	 public function funcionario() {
 
		return $this->hasMany('App\Funcionario', 'CODIGO', 'CODPESSOA');
	   }
}
