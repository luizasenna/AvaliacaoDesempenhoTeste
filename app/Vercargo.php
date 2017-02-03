<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vercargo extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vercargos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'codcargo', 'nome', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'c11', 'c12', 'c12', 'c13', 'c14', 'c15', 'created_at', 'updated_at'];

}