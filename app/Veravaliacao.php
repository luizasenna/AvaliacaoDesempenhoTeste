<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Veravaliacao extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'veravaliacoes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','codigoavaliacao', 'statuslider', 'statusadmin', 'statusdiretoria', 'obs', 'created_at', 'updated_at'];

	
	public function avaliacao() {
 
		return $this->hasOne('App\Avaliacao', 'CODAVALIACAO', 'codigoavaliacao');
	   } 


}
