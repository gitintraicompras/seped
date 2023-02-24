<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Pedren extends Model
{
    protected $table='pedren';

    protected $primaryKey='item';

    public $timestamps=false;
    
    protected $fillable = [
         'id', 
         'item',
         'codprod', 
         'desprod', 
         'cantidad',
         'precio',
         'barra'
    ];

    protected $guarded =[
    	
    ];
}
