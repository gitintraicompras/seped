<?php

/*****************************************************************
* Programa   : CapturaData.php
* Detalles   : Captura los tablas planta y las cargas en mysql
             : las tablas vienen comprimidas
* Proyecto   : SEPED
******************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 18-08-2020
* Modificado : 24-02-2021
******************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class CapturaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CapturaData:tablas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Captura tablas planas y las convierte en tablas mysql';

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
         Sincronizar();
    }
}
