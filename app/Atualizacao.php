<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atualizacao extends Model
{
     protected $table = 'servicos';
    
    protected $fillable = array('idsolicitante', 'idfuncionario', 'email', 'idfuncao', 'tipoatualizacao', 'telefone',
     'tiposanguineo', 'status', 'arquivoatualizacao', 'observacoes', 'observacoesrh');

}
