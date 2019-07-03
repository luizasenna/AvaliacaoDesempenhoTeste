<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    protected $table = 'anotacoes';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['id','codpessoa','chapa','idusuario','observacao'];

	   public function pessoas() {
        return $this->hasOne('App\Pessoa', 'CODIGO', 'codpessoa');
		}

    public function usuario() {
       return $this->hasOne('App\User', 'id', 'idusuario');

    }


}
