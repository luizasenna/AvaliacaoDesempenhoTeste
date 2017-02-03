<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';
    
    protected $fillable = array('idsolicitante', 'idfuncionario', 'loja', 'funcao', 'sexo', 'setorrh', 'solicitacao', 'motivo', 'camisa', 'calca', 'calcado', 'idusuario', 'status', 'observacoes');
}
