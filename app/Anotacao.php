<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    protected $table = 'anotacoes';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['id','codpessoa','chapa','idusuario','observacao'];

	   public function pessoas() {
        return $this->hasMany('App\Pessoa', 'CODIGO', 'codpessoa');
		}



}
