<?php

/*****************************************************************
* Programa   : CapturaSeped.php
* Detalles   : Captura los pedidos, reclamos y pagos para procesar
             : y crear un ID de aprobacion
* Proyecto   : FARMACEUTICA24
******************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 18-08-2020
* Modificado : 18-08-2020
******************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class CapturaSeped extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CapturaSeped:archivo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Captura los pedidos, reclamos y pagos para procesar y crear un ID de aprobacion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle() {
       //CapturaSeped();
    }
}
