<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Historicoequipe extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'equipeshistoricos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [''];


    public function usuario(){

      return $this->Belongsto('App\User', 'user');
    }

    public function avaliado(){

     return $this->belongsto('App\Funcionario', 'chapa', 'CHAPA');
    }

    public function antigaequipe(){

        return $this->belongsto('App\Equipe', 'codnovaequipe', 'CODINTERNO');
    }

    public function novaequipe(){

        return $this->belongsto('App\Equipe', 'codantigaequipe', 'CODINTERNO');
    }

}