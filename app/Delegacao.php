<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegacao extends Model
{
     protected $table = 'delegacoes';
    
     protected $fillable = [];

     public function avaliado(){

      	return $this->belongsto('App\Funcionario', 'chapaavaliado', 'CHAPA');

      }

    public  function avaliacao(){

      	return $this->belongsto('App\Avaliacao', 'codigoavaliacao','CODAVALIACAO');

      }

    public  function novoavaliador(){

      	return $this->belongsto('App\Funcionario', 'chapanovoavaliador', 'CHAPA');
      }



     public function antigoavaliador(){

      	return $this->belongsto('App\Funcionario', 'chapaantigoavaliador', 'CHAPA');
      }

    public function usuario(){
      	return $this->belongsto('App\User', 'user');

      }
}
