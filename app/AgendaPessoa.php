<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaPessoa extends Model
{
      protected $table = 'agendaPessoas';
    
      protected $fillable = ['id','nome','apelido','idtipo', 'idempresa', 'idpessoatotvs', 'chapatotvs'];

       public function telefones() {
        return $this->hasMany('App\AgendaTelefone', 'id', 'idpessoa');
		}

		public function emails() {
        return $this->hasMany('App\AgendaEmail', 'id', 'idpessoa');
		}


		public function tipo() {
        return $this->hasOne('App\AgendaPessoaTipo', 'id', 'idtipo');
		}

    public function empresa(){
        return $this->hasOne('App\AgendaEmpresa', 'id', 'idempresa');
    }
}
