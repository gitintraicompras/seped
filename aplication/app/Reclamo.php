<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    protected $table='reclamo';

    protected $primaryKey='id';

    public $timestamps=false;
    
    protected $fillable = [
         'id',
         'codcli',
         'fecha',
         'estado',
         'fecprocesado',
         'origen',
         'usuario',
         'factnum'
    ];

    protected $guarded =[
    	
    ];
}
