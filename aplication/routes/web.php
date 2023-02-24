<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// MENU PRINCIPAL
Auth::routes();
Route::get('/', function () 
{ 
	ContadorVisitas();
	return view('index', ['cfg' => DB::table('cfg')->first()]);
});
Route::get('/login2', function () 
{ 
	return view('index2', ['cfg' => DB::table('cfg')->first()]);
});
Route::get('/sincronizar', function () 
{ 
	Sincronizar();
	return Redirect::to('/home');
});
Route::get('/cargarimagen', function () 
{ 
	vCargaImagenes();
	return Redirect::to('/home');
});
Route::get('/sidebarModo', function () 
{ 
	$modo = Session::get('sidebarModo', "");
	return Redirect::to('/home');
});
Route::get('/home', 'HomeController@index');
Route::post('/seped/modmenu','HomeController@modmenu');
Route::post('/seped/modoInfo','HomeController@modoInfo');
Route::get('/seped/prueba', 'HomeController@prueba');
Route::post('/seped/cambiarsucursal', 'HomeController@cambiarsucursal');

///////////////////
// MENU ADMIN  ////
///////////////////

Route::resource('/seped/clientes','AdclientesController');
Route::resource('/seped/busquedas','AdbusquedasController');
Route::get('/seped/productos/catalogo/{id}', 'AdproductoController@index');
Route::post('/seped/productos/descargar','AdproductoController@descargar');
Route::resource('/seped/alcabala','AdalcabalaController');
Route::get('/seped/alcabala/descargar/{id}', 'AdalcabalaController@descargar');
Route::resource('/seped/monitorpedido','AdmonitorpedidoController');
Route::post('/seped/monitorreclamo/procesar', 'AdmonitorreclamoController@procesar');
Route::resource('/seped/monitorreclamo','AdmonitorreclamoController');
Route::post('/seped/monitorpago/procesar', 'AdmonitorpagoController@procesar');
Route::resource('/seped/monitorpago','AdmonitorpagoController');
Route::resource('/seped/clientenofiscal','AdclientenofiscalController');
Route::resource('/seped/blogs','AdblogsController');
Route::get('/seped/prodimg/prod/{id}', 'AdprodimgController@prod');
Route::resource('/seped/prodimg','AdprodimgController');
Route::get('/seped/catimg/cat/{id}', 'AdcatimgController@cat');
Route::resource('/seped/catimg','AdcatimgController');
Route::get('/seped/marcaimg/marca/{id}', 'AdmarcaimgController@marca');
Route::resource('/seped/marcaimg','AdmarcaimgController');



Route::get('/seped/catalogo/deleprod/{id}','AdcatalogoController@deleprod');
Route::get('/seped/catalogo/listado/{id}','AdcatalogoController@listado');
Route::get('/seped/catalogo/observ/{id}','AdcatalogoController@observ');
Route::post('/seped/catalogo/agregar','AdcatalogoController@agregar');
Route::post('/seped/catalogo/modificar','AdcatalogoController@modificar');
Route::get('/seped/catalogo/enviar/{id}','AdcatalogoController@enviar');
Route::post('/seped/catalogo/descargar','AdcatalogoController@descargar');
Route::post('/seped/catalogo/modalerta','AdcatalogoController@modalerta');
Route::get('/seped/catalogo/borrar','AdcatalogoController@borrar');
Route::resource('/seped/catalogo','AdcatalogoController');
Route::get('/seped/pedido/descargar/{id}','AdpedidoController@descargar');
Route::resource('/seped/pedido','AdpedidoController');
Route::post('/seped/reclamo/modificar','AdreclamoController@modificar');
Route::get('/seped/reclamo/enviar/{id}','AdreclamoController@enviar');
Route::get('/seped/reclamo/descargar/{id}','AdreclamoController@descargar');
Route::resource('/seped/reclamo','AdreclamoController');
Route::post('/seped/pago/modificar','AdpagoController@modificar');
Route::post('/seped/pago/limpiarpagdoc','AdpagoController@limpiarpagdoc');
Route::post('/seped/pago/insertpagdoc','AdpagoController@insertpagdoc');
Route::get('/seped/pago/enviar/{id}', 'AdpagoController@enviar');
Route::post('/seped/pago/pagren','AdpagoController@pagren');
Route::post('/seped/pago/updateobs','AdpagoController@updateobs');
Route::get('/seped/pago/delpagren/{id}', 'AdpagoController@delpagren');
Route::get('/seped/pago/descargar/{id}', 'AdpagoController@descargar');
Route::resource('/seped/pago','AdpagoController');
Route::get('/seped/factura/descargartxt/{id}', 'AdfacturaController@descargartxt');
Route::get('/seped/factura/descargarpdf/{id}', 'AdfacturaController@descargarpdf');
Route::resource('/seped/grupo','AdgrupoController');
Route::post('/seped/grupo/gruporen','AdgrupoController@gruporen');
Route::get('/seped/grupo/delcli/{id}', 'AdgrupoController@delcli');

Route::resource('/seped/promdias','AdpromdiasController');
Route::post('/seped/promdias/grabar','AdpromdiasController@grabar');
Route::post('/seped/promdias/agregarprod','AdpromdiasController@agregarprod');
Route::get('/seped/promdias/delprod/{id}', 'AdpromdiasController@delprod');
Route::post('/seped/promdias/cargarprod','AdpromdiasController@cargarprod');

Route::resource('/seped/factura','AdfacturaController');
Route::resource('/seped/verconfig','AdverconfigController');
Route::resource('/seped/estadocta','AdestadoctaController');
Route::get('/seped/report/productos', 'AdreportController@productos');
Route::get('/seped/report/producto/{id}', 'AdreportController@producto');
Route::get('/seped/report/proveedores', 'AdreportController@proveedores');
Route::get('/seped/report/proveedor/{id}', 'AdreportController@proveedor');
Route::get('/seped/report/facturas', 'AdreportController@facturas');
Route::get('/seped/report/factura/{id}', 'AdreportController@factura');

Route::get('/seped/report/resumen', 'AdreportController@resumen');

Route::get('/seped/report/cxcs', 'AdreportController@cxcs');
Route::get('/seped/report/cxc/{id}', 'AdreportController@cxc');
Route::get('/seped/report/cxps', 'AdreportController@cxps');
Route::get('/seped/report/cxp/{id}', 'AdreportController@cxp');
Route::get('/seped/report/vendedores', 'AdreportController@vendedores');
Route::get('/seped/report/ctabancos', 'AdreportController@ctabancos');
Route::get('/seped/report/monedas', 'AdreportController@monedas');
Route::get('/seped/report', function () { return view('seped.report.index', 
										['menu'=>'Reportes', 
										 'subtitulo'=>'MODULO DE REPORTES',
										 'cfg' => DB::table('cfg')->first() ] ); });
Route::resource('/seped/usuario','AdusuarioController');
Route::post('/seped/resetear','AdusuarioController@resetear');
Route::post('/seped/leercorreoclie','AdusuarioController@leercorreoclie');
Route::post('/seped/leercorreoprov','AdusuarioController@leercorreoprov');


Route::get('/seped/config/reclamo','AdconfigController@reclamo');
Route::get('/seped/config/cuenta','AdconfigController@cuenta');
Route::post('/seped/config/correo','AdconfigController@correo');
Route::post('/seped/config/modmotivo','AdconfigController@modmotivo');
Route::post('/seped/config/modcuenta','AdconfigController@modcuenta');
Route::get('/seped/config/literales','AdconfigController@literales');
Route::post('/seped/config/grabarlit','AdconfigController@grabarlit');
Route::resource('/seped/config','AdconfigController');


Route::resource('/seped/transplit','AdtransplitController');

Route::resource('/seped/pedcrisep','AdpedcrisepController');
Route::resource('/seped/carga','AdcargaController');
Route::resource('/seped/descarga','AddescargaController');
Route::resource('/seped/caracteristica','AdcaracteristicaController');
Route::post('/seped/caracteristica/modcaract','AdcaracteristicaController@modcaract');
Route::resource('/seped/provcata','AdprovcataController');
Route::resource('/seped/provfact','AdprovfactController');
Route::resource('/seped/provvtas','AdprovvtasController');
Route::resource('/seped/provconf','AdprovconfController');
Route::get('/seped/notiservidor/borrar','AdnotiServidorController@borrar');
Route::get('/seped/notiservidor/borrar2','AdnotiServidorController@borrar2');
Route::get('/seped/notiservidor/leido','AdnotiServidorController@leido');
Route::post('/seped/notiservidor/modleido','AdnotiServidorController@modleido');
Route::get('/seped/notiservidor/show2/{id}','AdnotiServidorController@show2');
Route::get('/seped/notiservidor/destroy2/{id}','AdnotiServidorController@destroy2');
Route::resource('/seped/notiservidor','AdnotiServidorController');
Route::get('/seped/noticliente/borrar2','AdnotiClienteController@borrar2');
Route::get('/seped/noticliente/borrar','AdnotiClienteController@borrar');
Route::get('/seped/noticliente/leido','AdnotiClienteController@leido');
Route::post('/seped/noticliente/modleido','AdnotiClienteController@modleido');
Route::get('/seped/noticliente/show2/{id}','AdnotiClienteController@show2');
Route::get('/seped/noticliente/destroy2/{id}','AdnotiClienteController@destroy2');
Route::resource('/seped/noticliente','AdnotiClienteController');

Route::post('/seped/cestas/entregar/vercodcli','CestasEntregarController@vercodcli');
Route::post('/seped/cestas/entregar/marcar','CestasEntregarController@marcar');
Route::post('/seped/cestas/entregar/verificar','CestasEntregarController@verificar');
Route::get('/seped/cestas/terminar/{id}', 'CestasEntregarController@terminar');
Route::resource('/seped/cestasentregar','CestasEntregarController'

);