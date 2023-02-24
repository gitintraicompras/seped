<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    protected $table='recren';

    protected $primaryKey='item';

    public $timestamps=false;
    
    protected $fillable = [
        'id',
        'item',
        'motivo',
        'codprod',
        'desprod',
        'cantidad',
        'precio'
    ];

    protected $guarded =[
    	
    ];
}
