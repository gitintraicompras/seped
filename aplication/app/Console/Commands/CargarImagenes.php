<?php

/**************************************************************
* Programa   : CargarImagnes.php
* Detalles   : Recoorrido por la tabla de productos y busca
*            : si existe la imagen en la carpeta /images/prod
*            : las imagenes estan grabadas con el codigo de 
*            : barra del producto como nombre 
* Proyecto   : SEPED
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 24-01-2021
* Modificado : 24-01-2021
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class CargaImagenes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'CargaImagenes:masiva';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recoorrido por la tabla de productos y busca
            si existe la imagen en la carpeta /images/prod
            las imagenes estan grabadas con el codigo de 
            barra del producto como nombre ';

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
    public function handle()
    {
        vCargaImagenes();
    }
}


