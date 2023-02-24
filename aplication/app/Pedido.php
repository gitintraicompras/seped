<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table='pedido';

    protected $primaryKey='id';

    public $timestamps=false;
    
    protected $fillable = [
        'id',
        'codcli', 
        'fecha', 
        'estado',
        'fecenviado',
        'fecprocesado', 
        'origen',
        'usuario'
    ];

    protected $guarded =[
    	
    ];
}
