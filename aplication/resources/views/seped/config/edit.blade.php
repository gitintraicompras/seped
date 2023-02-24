@extends ('layouts.menu')
@section ('contenido')
    
 
{!!Form::model($cfg,['method'=>'PATCH','route'=>['config.update','1'],'enctype'=>'multipart/form-data'])!!}
{{Form::token()}}
<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>BASICA</B></a></li>
	          <li><a href="#tab_2" data-toggle="tab"><B>CORREOS</B></a></li>
	          <li><a href="#tab_3" data-toggle="tab"><B>VARIABLES</B></a></li>
	     	  <li><a href="#tab_4" data-toggle="tab"><B>FORMATOS</B></a></li>
	          <li><a href="#tab_5" data-toggle="tab"><B>REGLAS</B></a></li>
	          <li><a href="#tab_6" data-toggle="tab"><B>HERRAMIENTAS</B></a></li>
	          <li><a href="#tab_7" data-toggle="tab"><B>INFO</B></a></li>
	     	  <li><a href="#tab_8" data-toggle="tab"><B>CARRUSEL</B></a></li>
	          <li class="pull-right">
	          	<a href="{{url('/seped/config')}}" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
 			        <div class="row">
					    <!-- NOMBRE DEL USUARIO (IDENTIFICADOR) -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Código</label>
					            <input readonly id="codisb" type="text" class="form-control" name="name" value="{{$cfg->codisb}}" style="color: #000000;background: #f7f7f7;">
						    </div>
					    </div>

					    <!-- NOMBRE -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre</label>
					            <input type="text" class="form-control" name="nombre" value="{{$cfg->nombre}}"  >
						    </div>
					    </div>

						<!-- NOMBRE CORTO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre Corto</label>
					            <input type="text" class="form-control" name="nomcorto" value="{{$cfg->nomcorto}}" >
						    </div>
					    </div>

					    <!-- RIF -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Rif.</label>
					            <input type="text" class="form-control" name="rif" value="{{$cfg->rif}}"  >
						    </div>
					    </div>

					    <!-- DIRECCION -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Dirección</label>
					            <input type="text" class="form-control" name="direccion" value="{{$cfg->direccion}}" >
						    </div>
					    </div>

						<!-- LOCALIDAD -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Localidad</label>
					            <input type="text" class="form-control" name="localidad" value="{{$cfg->localidad}}" >
						    </div>
					    </div>

						<!-- CONTACTO -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Contacto</label>
					            <input type="text" class="form-control" name="contacto" value="{{$cfg->contacto}}" >
						    </div>
					    </div>

					    <!-- TELEFONO -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Teléfono</label>
					            <input type="text" class="form-control" name="telefono" value="{{$cfg->telefono}}" >
						    </div>
					    </div>

					    <!-- FAX -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Fax</label>
					            <input type="text" class="form-control" name="fax" value="{{$cfg->fax}}" >
						    </div>
					    </div>

					    <!-- SEDE -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Sede o Sucursal</label>
					            <input type="text" class="form-control" name="SedeSucursal" value="{{$cfg->SedeSucursal}}" >
						    </div>
					    </div>

					    <!-- FACEBOOK -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Facebook</label>
					            <input type="text" class="form-control" name="facebook" value="{{$cfg->facebook}}" >
						    </div>
					    </div>

						<!-- INSTAGRAM -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Instagram</label>
					            <input type="text" class="form-control" name="instagram" value="{{$cfg->instagram}}" >
						    </div>
					    </div>

						<!-- TWITTER -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Twitter</label>
					            <input type="text" class="form-control" name="twitter" value="{{$cfg->twitter}}" >
						    </div>
					    </div>

					    <!-- WHATSAPP TELEFONO -->
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group">
						        <label>Link Whatsapp Web</label>
					            <input type="text" class="form-control" name="linkWhatsappTel" value="{{$cfg->linkWhatsappTel}}" >
						    </div>
					    </div>

					</div>
	          	</div>
		        <div class="tab-pane" id="tab_2">
					<div class="row">
						<!-- CORREO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo contacto</label>
					            <input type="text" class="form-control" name="correo" value="{{$cfg->correo}}" >
						    </div>
					    </div>

			   		    <!-- CORREO DE PAGOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo destino para pagos</label>
					            <input type="text" class="form-control" name="correoPago" value="{{$cfg->correoPago}}" >
						    </div>
					    </div>

					    <!-- CORREO DE RECLAMOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo destino para reclamos</label>
					            <input type="text" class="form-control" name="correoReclamo" value="{{$cfg->correoReclamo}}">
						    </div>
					    </div>
						
						<!-- CORREO DE RESUMEN DE VENTAS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo destino de resumen de Operaciones</label>
					            <input type="text" class="form-control" name="correoResumen" value="{{$cfg->correoResumen}}">
						    </div>
					    </div>

					    <!-- CORREO DE SOPORTE -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo destino para soporte técnico</label>
					            <input type="text" class="form-control" name="correosoporte" value="{{$cfg->correosoporte}}">
						    </div>
					    </div>

					    <!-- CORREO DE REMITENTE PARA OPERACIONES DE ENVIO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Correo remitente para las Operaciones de Envio</label>
					            <input type="text" class="form-control" name="correoRemitente" value="{{$cfg->correoRemitente}}">
						    </div>
					    </div>
					</div>
		          </div>
	          	<div class="tab-pane" id="tab_3">
		          	<div class="row">

		          		<!-- TASA CAMBIARIA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Tasa cambiaria del Dolar</label>
					            <input readonly type="text" class="form-control" name="tasacambiaria" value="   {{number_format($cfg->tasacambiaria, 2, '.', ',')}}"  style="text-align: right;" >
						    </div>
					    </div>

						<!-- TEXTO LITERAL DE LA TASA CAMBIARIA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Texto literal de la Tasa Cambiaria</label>
					            <input type="text" class="form-control" name="LiteralTasaCambiaria" value="{{$cfg->LiteralTasaCambiaria}}" >
						    </div>
					    </div>

		          		<!-- SIMBOLO PARA LAS MONDEDA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Simbolo de Moneda predeterminada</label>
					            <input type="text" class="form-control" name="simboloMoneda" value="{{$cfg->simboloMoneda}}" >
						    </div>
					    </div>

					    <!-- SIMBOLO PARA LAS OTRA MONDEDA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Simbolo Otra Moneda</label>
					            <input type="text" class="form-control" name="simboloOM" value="{{$cfg->simboloOM}}" >
						    </div>
					    </div>

						<!-- NUMERO MAXIMO DE RENGLONES POR FACTURA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>No. máximo de renglones por Factura</label>
					            <input type="number" class="form-control" name="numRengPedido" value="{{$cfg->numRengPedido}}" style="text-align: right;"  >
						    </div>
					    </div>

					    <!-- FORMULA DE PRODUCTOS CON DOBLE LINEA PARA LA FACTURA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Formula Productos con Doble Linea (Caso Especial)</label>
					            <input type="text" class="form-control" name="formulaProdDobleLinea" value="{{$cfg->formulaProdDobleLinea}}"  >
						    </div>
					    </div>

					    <!-- ORDENAM DE LOS PEDIDOS SIDES  -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Orden (PEDIDOS-SIDES)</label>
						    	<select name="ordenPedSides" class="form-control">
						    		<option value="ORIGINAL" 
						    		@if ($cfg->ordenPedSides == 'ORIGINAL') selected @endif >
						    		ORIGINAL
						    		</option>
						    		<option value="DESCRIPCION"
						    		@if ($cfg->ordenPedSides == 'DESCRIPCION') selected @endif> 
						    		DESCRIPCION
						    		</option>
						    		<option value="UBICACION"
						    		@if ($cfg->ordenPedSides == 'UBICACION') selected @endif>
						    		UBICACION
						    		</option>
						    		<option value="MARCA"
						    		@if ($cfg->ordenPedSides == 'MARCA') selected @endif>
						    		MARCA
						    		</option>
						    	</select>
						    </div>
					    </div>

						<!-- DIAS MAXIMO PARA RECIBIR RECLAMOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Dias máximo para recibir reclamos</label>
					            <input type="number" class="form-control" name="diasMaximoReclamo" value="{{$cfg->diasMaximoReclamo}}" style="text-align: right;"  >
						    </div>
					    </div>

					    <!-- DIAS MAXIMO PARA MOSTRAR LAS ENTRADAS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Dias máximo para las Entradas de Productos</label>
					            <input type="number" class="form-control" name="diasMaximoEntradas" value="{{$cfg->diasMaximoEntradas}}" style="text-align: right;"  >
						    </div>
					    </div>

					    <!-- VALOR DEL IVA -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Iva</label>
					            <input type="text" class="form-control" name="valorIva" value="{{$cfg->valorIva}}" style="text-align: right;" >
						    </div>
					    </div>

					    <!-- NOMBRE DEL DOMINIO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del dominio</label>
					            <input type="text" class="form-control" name="nomdominio" value="{{$cfg->nomdominio}}" >
						    </div>
					    </div>

					    <!-- NOMBRE DEL SUBDOMINIO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre subdominio</label>
					            <input type="text" class="form-control" name="nomsubdominio" value="{{$cfg->nomsubdominio}}" >
						    </div>
					    </div>

					    <!-- TITULO DE LA PAGINA INTRANET -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Titulo de la pagina Intranet</label>
					            <input type="text" class="form-control" name="titulopagina" value="{{$cfg->titulopagina}}" >
						    </div>
					    </div>

					    <!-- CONTADOR DE VISITAS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Contador de Visitas de la Intranet</label>
					            <input type="text" class="form-control" name="cntvisitas" value="{{$cfg->cntvisitas}}">
						    </div>
					    </div>

					    <!-- DESCRIPCION DEL SOPORTE TECNICO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Descripción de soporte técnico</label>
					            <input type="text" class="form-control" name="nomsoporte" value="{{$cfg->nomsoporte}}" >
						    </div>
					    </div>

					    <!-- TELEFONO DEL SOPORTE TECNICO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Teléfono del soporte técnico</label>
					            <input type="text" class="form-control" name="telsoporte" value="{{$cfg->telsoporte}}" >
						    </div>
					    </div>

					    <!-- CODIGO DEL VENDEDOR INTERNET -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Código del vendedor Internet</label>
					            <input type="text" class="form-control" name="codvendInternet" value="{{$cfg->codvendInternet}}" >
						    </div>
					    </div>

					    <!-- ORDEN DEL CATALOGO PARA DESCARGAR  -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Orden predeterminado para la descarga de catálogo</label>
						    	<select name="ordenPredCatalogo" class="form-control">
						    		@if ($cfg->ordenPredCatalogo == 'ALFABETICO')
							    		<option value="ALFABETICO" selected>ALFABETICO</option>
							    		<option value="CATEGORIAS">CATEGORIAS</option>
							  		@endif
							  		@if ($cfg->ordenPredCatalogo == 'CATEGORIAS')
							    		<option value="ALFABETICO">ALFABETICO</option>
							    		<option value="CATEGORIAS" selected>CATEGORIAS</option>
							  		@endif
						    	</select>
						    </div>
					    </div>

					    <!-- RUTA LOGO IMAGEN PARA REPORTE PDF -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Logo (RUTA ABSOLUTA PARA IMAGENES EN PDF)</label>
					            <input type="text" 
					            	class="form-control" 
					            	name="rutaLogoRpt" 
					            	value="{{$cfg->rutaLogoRpt}}" >
						    </div>
					    </div>


				    	<!-- RUTA ABSOLUTA PARA IMAGENES EN PDF -->
				    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Modo de carga de Imagenes en los PDF (0-3)</label>
					            <input type="number" 
					            	class="form-control" 
					            	name="imagenPdfRutaAbsoluta" 
					            	value="{{$cfg->imagenPdfRutaAbsoluta}}" >
						    </div>
					    </div>

					</div>
	          	</div>
	          	<div class="tab-pane" id="tab_4">
		          	<div class="row">

					    <!-- NOMBRE REPORTE DE FACTURAS-->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del reporte de factura</label>
					            <input type="text" class="form-control" name="formatoPersFac" value="{{$cfg->formatoPersFac}}" >
						    </div>
					    </div>

					    <!-- NOMBRE REPORTE DE PEDIDOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del reporte de pedidos</label>
					            <input type="text" class="form-control" name="formatoPersPed" value="{{$cfg->formatoPersPed}}" >
						    </div>
					    </div>

					    <!-- NOMBRE REPORTE DE PAGOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del reporte de pagos</label>
					            <input type="text" class="form-control" name="formatoPersPag" value="{{$cfg->formatoPersPag}}" >
						    </div>
					    </div>

					    <!-- NOMBRE REPORTE DE RECLAMOS -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del reporte de reclamos</label>
					            <input type="text" class="form-control" name="formatoPersRec" value="{{$cfg->formatoPersRec}}" >
						    </div>
					    </div>

					    <!-- NOMBRE REPORTE DE CATALOGO -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Nombre del reporte de catálogo</label>
					            <input type="text" class="form-control" name="formatoPersCat" value="{{$cfg->formatoPersCat}}" >
						    </div>
					    </div>


					</div>
	          	</div>
	          	<div class="tab-pane" id="tab_5">
		          	<div class="row">
					    <div class="box box-primary">
			                <div class="box-body">

			                	<!-- ACTIVAR MODULO DE CONSIGNACION DE PROVEEDORES -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModProveedor" 
									  @if ($cfg->mostrarModProveedor) checked @endif />
									  <span class="text">Activar modulo de consignación de proveedores</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

			                	<!-- ACTIVAR MODULO DE NOTIFICACION DE ALERTAS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModNotificacion" 
									  @if ($cfg->mostrarModNotificacion) checked @endif />
									  <span class="text">Activar modulo de notiificación de alertas</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR MODULO DE HISTORIAL DE CESTAS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModCesta" 
									  @if ($cfg->mostrarModCesta) checked @endif />
									  <span class="text">Activar modulo de Cestas</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR MOODULO DE DESCARGA EN EL CLIENTE -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModDescarga" 
									  @if ($cfg->mostrarModDescarga) checked @endif />
									  <span class="text">Activar modulo de cargas/descargas</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- UTILIZA MOODULO BLOGS-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModBlog" 
									  @if ($cfg->mostrarModBlog) checked @endif />
									  <span class="text">Activar modulo mini Blogs</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- ACTIVA MODULO PARA PEDIDOS NO FISCALES-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarModnofiscal" 
									  @if ($cfg->mostrarModnofiscal) checked @endif />
									  <span class="text">Activar modulo de pedidos no fiscales</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!--ACTIVAR ENVIO DE CORREO DE CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarCorreoCatalogo" 
									  @if ($cfg->activarCorreoCatalogo) checked @endif />
									  <span class="text">Activar envio de correo de catálogo los días (LU-MI-VI)</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

		                		<!-- UNIFICAR RENGLONES REPETIDOS EN EL PEDIDO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="unirRengRepetido" 
									  @if ($cfg->unirRengRepetido) checked @endif />
									  <span class="text">Unificar renglones repetidos en el pedido</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

							  	<!-- MOSTRAR IMAGEN DE PRODUCTO EN EL PEDIDO-->
					 			<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarImagenPedido" 
									  @if ($cfg->mostrarImagenPedido) checked @endif />
									  <span class="text">Mostrar imagen del producto en el pedido</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- VER IMAGEN DE PRODUCTO EN EL CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarImagen" 
									  @if ($cfg->mostrarImagen) checked @endif />
									  <span class="text">Mostrar imagen del producto en el catálogo</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- MOSTRAR COLUMNA DE CANTIDAD EN LA DESCARGA DE CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarColumnaCantidad" 
									  @if ($cfg->mostrarColumnaCantidad) checked @endif />
									  <span class="text">(Predeterminado) Mostrar la columna de cantidad en la descarga de catálogo</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

							
								<!-- MOSTRAR TASA CAMBIARIA -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarTasaCambiaria" 
									  @if ($cfg->mostrarTasaCambiaria) checked @endif />
									  <span class="text">Mostrar tasa cambiaria de Otra Moneda en la barra principal</span>
									  <small class="label label-danger"><i class="fa fa-clock-o"></i>
									  	Función
									  </small>
									</li>
								</ul>

								<!-- MOSTRAR PRECIO OTRA MONEDA -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarPrecioOM" 
									  @if ($cfg->mostrarPrecioOM) checked @endif />
									  <span class="text">Mostrar precio del Catálogo en Otra Moneda ( {{$cfg->simboloOM}} )</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- MOSTRAR EL PEDIDO EN DOBLE MONEDA -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarPedidoOM" 
									  @if ($cfg->mostrarPedidoOM) checked @endif />
									  <span class="text">Mostrar pedido en Otra Moneda ( {{$cfg->simboloOM}} )</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- MOSTRAR DATOS ALCABALA EN DOBLE MONEDA -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarAlcabalaOM" 
									  @if ($cfg->mostrarAlcabalaOM) checked @endif />
									  <span class="text">Mostrar Información de la Alcabala en Otra Moneda ( {{$cfg->simboloOM}} )</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER LOTE Y FECHA VENCIMIENTO EN CATALOGO DE VENDEDORES -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarLote" 
									  @if ($cfg->mostrarLote) checked @endif />
									  <span class="text">Mostrar Lote/Vencimiento en el catálogo de vendedores</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER LOTE Y FECHA VENCIMIENTO EN CATALOGO DE CLIENTES -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarLoteCliente" 
									  @if ($cfg->mostrarLoteCliente) checked @endif />
									  <span class="text">Mostrar Lote/Vencimiento en el catálogo de clientes</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER BARRA EN CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarBarra" 
									  @if ($cfg->mostrarBarra) checked @endif />
									  <span class="text">Mostrar barra o referencia en el catálogo</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER MARCA/LABORATORIO EN CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarMarca" 
									  @if ($cfg->mostrarMarca) checked @endif />
									  <span class="text">Mostrar marca/laboratorio en el catálogo</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER CODIGO EN CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarCodigo" 
									  @if ($cfg->mostrarCodigo) checked @endif />
									  <span class="text">Mostrar código del producto en el catálogo/Pedidos</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER OMPONENTE ACTIVO EN CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarComponente" 
									  @if ($cfg->mostrarComponente) checked @endif />
									  <span class="text">Mostrar Componente Activo en el catálogo</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- VER UNIDAD DE MANEJO EN EL CATALOGO-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarBulto" 
									  @if ($cfg->mostrarBulto) checked @endif />
									  <span class="text">Mostrar Unidad de Manejo en el catálogo</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>


								<!-- CONCATENAR P.ACTIVO EN LA DESCRIPCION -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarPactaDesc" 
									  @if ($cfg->mostrarPactaDesc) checked @endif />
									  <span class="text">Concatenar principio activo en la descripción</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- CONCATENAR MARCA EN LA DESCRIPCION -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarMarcaDesc" 
									  @if ($cfg->mostrarMarcaDesc) checked @endif />
									  <span class="text">Concatenar marca en la descripción</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- DESCUENTO ADICIONAL EN EL CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarDa" 
									  @if ($cfg->mostrarDa) checked @endif />
									  <span class="text">( {{$cfg->LitDa}} ) Mostrar columna {{ $cfg->msgLitDa}}</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- DESCUENTO PRE-EMPAQUE -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarDp" 
									  @if ($cfg->mostrarDp) checked @endif />
									  <span class="text">( {{$cfg->LitDp}} ) Mostrar columna {{$cfg->msgLitDp}}</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- DESCUENTO POR VOLUMEN  -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarDv" 
									  @if ($cfg->mostrarDv) checked @endif />
									  <span class="text">( {{$cfg->LitDv}} ) Mostrar columna {{$cfg->msgLitDv}} </span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- ACTIAR COLUMNA DE DESCUENTO INTERNET EN EL PEDIDO-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarDi" 
									  @if ($cfg->mostrarDi) checked @endif />
									  <span class="text">( {{$cfg->LitDi}} ) Mostrar columna {{$cfg->msgLitDi}}</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- ACTIAR COLUMNA DE DESCUENTO COMERCIAL EN EL PEDIDO-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarDc" 
									  @if ($cfg->mostrarDc) checked @endif />
									  <span class="text">( {{$cfg->LitDc}} ) Mostrar columna {{$cfg->msgLitDc}}</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR COLUMNA DE DESCUENTO PROMTO PAGO EN EL PEDIDO-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarPp" 
									  @if ($cfg->mostrarPp) checked @endif />
									  <span class="text">( {{$cfg->LitPp}} ) Mostrar columna {{$cfg->msgLitPp}}</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR COLUMNA DE NETO EN EL CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarNetoCatalogo" 
									  @if ($cfg->mostrarNetoCatalogo) checked @endif />
									  <span class="text">(NETO) Mostrar columna de Neto en el Catálogo</span>
									  <small class="label label-info"><i class="fa fa-clock-o"></i>
									  	Columna
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE ENTRADAS DE PRODUCTOS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarEntradasProducto" 
									  @if ($cfg->activarEntradasProducto) checked @endif />
									  <span class="text">Activar boton de entradas de productos</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE OFERTAS DE PRODUCTOS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarOfertasProducto" 
									  @if ($cfg->activarOfertasProducto) checked @endif />
									  <span class="text">Activar boton de ofertas de productos</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE PRODUCTOS DESTACADOS-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarDestacadoProducto" 
									  @if ($cfg->activarDestacadoProducto) checked @endif />
									  <span class="text">Activar boton de productos Destacados</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE CATEGORIAS DE PRODUCTOS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarCateProducto" 
									  @if ($cfg->activarCateProducto) checked @endif />
									  <span class="text">Activar boton de categorias de productos</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE MARCAS DE PRODUCTOS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarMarcaProducto" 
									  @if ($cfg->activarMarcaProducto) checked @endif />
									  <span class="text">Activar boton de marcas de productos</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE PSICOTROPICOS PARA VENDEDORES-->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarBotonPsico" 
									  @if ($cfg->activarBotonPsico) checked @endif />
									  <span class="text">Activar boton de Psicotropicos para vendedores</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE PSICOTROPICOS PARA CLIENTES -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarBotonPsicoCliente" 
									  @if ($cfg->activarBotonPsicoCliente) checked @endif />
									  <span class="text">Activar boton de Psicotropicos para clientes</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE ALERTAS FALLAS -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarBotonFallaAlerta" 
									  @if ($cfg->activarBotonFallaAlerta) checked @endif />
									  <span class="text">Activar boton para Alertas de Productos en Fallas</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTONES DE NAVEHACION AL INICIO DEL CATALOGO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="mostrarBarraNavCatInicio" 
									  @if ($cfg->mostrarBarraNavCatInicio) checked @endif />
									  <span class="text">Activar Barra de navegación al inicio del Catálogo</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>

								<!-- ACTIVAR BOTON DE DIAS DE CREDITO -->
								<ul class="todo-list">
									<li>
									  <input type="checkbox" name="activarBotonDias" 
									  @if ($cfg->activarBotonDias) checked @endif />
									  <span class="text">Activar boton de promoción x días de credito</span>
									  <small class="label label-warning"><i class="fa fa-clock-o"></i>
									  	Boton
									  </small>
									</li>
								</ul>


			                </div>
			            </div>
				  	</div>
	          	</div>
	          	<div class="tab-pane" id="tab_6">
		          	<div class="row">
		          		<!-- MODO VISUAL -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Modo Visual para Pedios/Reclamos/Pagos</label>
						    	<select name="modoVisual" class="form-control">
						    		@if ($cfg->modoVisual == '1')
							    		<option value="1" selected>NORMAL</option>
							    		<option value="2">MEDIO</option>
							    		<option value="3">RESUMIDO</option>
						    		@endif
						    		@if ($cfg->modoVisual == '2')
							    		<option value="1">NORMAL</option>
							    		<option value="2" selected>MEDIO</option>
							    		<option value="3">RESUMIDO</option>
						    		@endif
						    		@if ($cfg->modoVisual == '3')
							    		<option value="1">NORMAL</option>
							    		<option value="2">MEDIO</option>
							    		<option value="3" selected>RESUMIDO</option>
						    		@endif
						    	</select>
						    </div>
					    </div>

					    <!-- SINCRONIZACIONL -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Sincronización con el SIAD</label>
						    	<select name="sincronizar" class="form-control">
						    		@if ($cfg->sincronizar == 'ACTIVA')
							    		<option value="ACTIVA" selected>ACTIVA</option>
							    		<option value="INACTIVA">INACTIVA</option>
						    		@endif
						    		@if ($cfg->sincronizar == 'INACTIVA')
							    		<option value="ACTIVA">ACTIVA</option>
							    		<option value="INACTIVA" selected>INACTIVA</option>
						    		@endif
						    	</select>
						    </div>
					    </div>

					    <!-- PROCESO DE ALCABAAL -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Proceso de Alcabala</label>
						    	<select name="procAlcabala" class="form-control">
						    		@if ($cfg->procAlcabala == 'ACTIVA')
							    		<option value="ACTIVA" selected>ACTIVA</option>
							    		<option value="INACTIVA">INACTIVA</option>
						    		@endif
						    		@if ($cfg->procAlcabala == 'INACTIVA')
							    		<option value="ACTIVA">ACTIVA</option>
							    		<option value="INACTIVA" selected>INACTIVA</option>
						    		@endif
						    	</select>
						    </div>
					    </div>

					    <!-- MODO DE ALCABALA -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Modalidad de la Alcabala</label>
						    	<select name="modoAlcabala" class="form-control">
						    		@if ($cfg->modoAlcabala == '1')
							    		<option value="1" selected>MANUAL</option>
							    		<option value="2">SEMIMANUAL</option>
							    		<option value="3">SIN ALCABALA</option>
						    		@endif
						    		@if ($cfg->modoAlcabala == '2')
							    		<option value="1">MANUAL</option>
							    		<option value="2" selected>SEMIMANUAL</option>
							    		<option value="3">SIN ALCABALA</option>
						    		@endif
						    		@if ($cfg->modoAlcabala == '3')
							    		<option value="1">MANUAL</option>
							    		<option value="2">SEMIMANUAL</option>
							    		<option value="3" selected>SIN ALCABALA</option>
						    		@endif
						    	</select>
						    </div>
					    </div>

					    <!-- COMPATIBILIDAD CON EL SISTEMA ADMINISTRATIVO DEL CLIENTE -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Compatibilidad con el Sistema Administrativo</label>
						    	<select name="appAdm" class="form-control">
						    		<option value="DEFECTO" @if ($cfg->appAdm == 'DEFECTO') selected @endif>DEFECTO</option>
						    		<option value="STELLAR" @if ($cfg->appAdm=='STELLAR') selected @endif>STELLAR</option>
						    		<option value="A2" @if ($cfg->appAdm=='A2') selected @endif>A2</option>
						    		<option value="PROFIT" @if ($cfg->appAdm=='PROFIT') selected @endif>PROFIT</option>
						    		<option value="SAINT" @if ($cfg->appAdm=='SAINT') selected @endif>SAINT</option>
						    		<option value="GALAC" @if ($cfg->appAdm=='GALAC') selected @endif>GALAC</option>
						    	</select>
						    </div>
					    </div>

					    <!-- CANTIDAD DE PRECIO A UTILIZAR POR SEPED -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Cantidad de precio a Visualizar por el Seped</label>
						    	<select name="cantPrecioUtilizar" class="form-control">
						    		<option value="1" 
						    		@if ($cfg->cantPrecioUtilizar=='1') selected @endif> 1
						    		</option>
						    		<option value="2" 
						    		@if ($cfg->cantPrecioUtilizar=='2') selected @endif> 2
						    		</option>
						    		<option value="3" 
						    		@if ($cfg->cantPrecioUtilizar=='3') selected @endif> 3
						    		</option>
						    		<option value="4" 
						    		@if ($cfg->cantPrecioUtilizar=='4') selected @endif> 4
						    		</option>
						    		<option value="5" 
						    		@if ($cfg->cantPrecioUtilizar=='5') selected @endif> 5
						    		</option>
						    		<option value="6" 
						    		@if ($cfg->cantPrecioUtilizar=='6') selected @endif> 6
						    		</option>
						    	</select>
						    </div>
					    </div>

					    <!-- APLICAR DA, DV, DP SOLO AL PRECIO -->
			    		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Aplicar DA, DV, DP solo al precio:</label>
								<input value="{{$cfg->aplicarDaPrecio}}" 
									type="text" 
									name="aplicarDaPrecio" 
									style="text-align: right;" 
									class="form-control">
							</div>
						</div>

					    <!-- STYLES DE CONFIGURACION -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						    	<label>Tipo de stilos de diseño</label>
						    	<select name="styles" class="form-control">
						    		<option value="GreenBlack"
						    		@if ($cfg->styles == 'GreenBlack') selected @endif>
						    			GreenBlack
						    		</option>

						    		<option value="Orange"
						    		@if ($cfg->styles == 'Orange') selected @endif>
						    			Orange
						    		</option>

						    		<option value="Ground"
						    		@if ($cfg->styles == 'Ground') selected @endif>
						    			Ground
						    		</option>
						    		<option value="RedGreen"
						    		@if ($cfg->styles == 'RedGreen') selected @endif>
						    			RedGreen
						    		</option>
  									<option value="BlueGris" 
						    		@if ($cfg->styles=='BlueGris') selected @endif>
						    			BlueGris
						    		</option>
						    		<option value="White"
						    		@if ($cfg->styles == 'White') selected @endif>
						    			White
						    		</option>
						    		<option value="Blue" 
						    		@if ($cfg->styles=='Blue') selected @endif>
						    			Blue
						    		</option>
						    		<option value="Red" 
						    		@if ($cfg->styles=='Red') selected @endif>
						    			Red
						    		</option>
						    		<option value="Pink" 
						    		@if ($cfg->styles=='Pink') selected @endif>
						    			Pink
						    		</option>
						    		<option value="LightBlue" 
						    		@if ($cfg->styles=='LightBlue') selected @endif>
						    			LightBlue
						    		</option>
						    		<option value="BlueGreen" 
						    		@if ($cfg->styles=='BlueGreen') selected @endif>
						    			BlueGreen
						    		</option>
						    		<option value="BlueYellow" 
						    		@if ($cfg->styles=='BlueYellow') selected @endif>
						    			BlueYellow
						    		</option>
						    		<option value="Green" 
						    		@if ($cfg->styles=='Green') selected @endif>
						    			Green
						    		</option>
						    	</select>
						    </div>
					    </div>

					    <!-- ACTIVAR FUNCIONALIDAD DEL MINCP -->
					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<input type="checkbox" name="ActivarMincp" 
							@if ($cfg->ActivarMincp) checked @endif />
							<span><b>Activar funcionalidad de Mincp</b></span>
							<input  type="text" class="form-control" name="KeyMincp" value="{{$cfg->KeyMincp}}">
						</div>

						<div class="clearfix"></div>

						<!-- DI PARA EL MINCP -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Trasladar DI al Mincp</label>
					            <input type="text" 
					            	class="form-control" 
					            	name="diMincp"
					            	style="text-align: right;" 
					            	value="{{$cfg->diMincp}}" >
						    </div>
					    </div>

					    <!-- PP PARA EL MINCP -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
						        <label>Trasladar PP al Mincp</label>
					            <input type="text" 
					            	class="form-control" 
					            	name="ppMincp"
					            	style="text-align: right;" 
					            	value="{{$cfg->ppMincp}}" >
						    </div>
					    </div>
					  
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="checkbox" name="modoInfo" 
							@if ($cfg->modoInfo) checked @endif />
							<span><b>Activar modo Informativo</b></span>
							<input  type="text" class="form-control" name="msgInfo" value="{{$cfg->msgInfo}}">
						</div>

					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="checkbox" name="modoMant" 
							@if ($cfg->modoMant) checked @endif />
							<span><b>Activar modo mantenimiento</b></span>
							<input  type="text" class="form-control" name="msgMant" value="{{$cfg->msgMant}}">
						</div>

		          	</div>
	          	</div>
		      	<div class="tab-pane" id="tab_7">
			        <div class="row">
					 	<!-- NUESTRA EMPRESA -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
						        <label>NUESTRA EMPRESA</label>
						        <textarea name="nuestraempresa" rows="5" style="width: 100%;">{{$cfg->nuestraempresa}}</textarea>
						    </div>
					    </div>

					    <!-- MISION -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
						        <label>MISIÓN</label>
					            <textarea name="mision" rows="5" style="width: 100%;">{{$cfg->mision}}</textarea>
						    </div>
					    </div>

					    <!-- VISION -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
						        <label>VISIÓN</label>
					            <textarea name="vision" rows="5" style="width: 100%;">{{$cfg->vision}}</textarea>
						    </div>
					    </div>

					    <!-- VALORES -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
						        <label>VALORES</label>
					            <textarea name="valores" rows="5" style="width: 100%;">{{$cfg->valores}}</textarea>
						    </div>
					    </div>

						<!-- ANTECEDENTES -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
						        <label>ANTECEDENTES</label>
					            <textarea name="antecedentes" rows="5" style="width: 100%;">{{$cfg->antecedentes}}</textarea>
						    </div>
					    </div>
					</div>
	          	</div>
	          	<div class="tab-pane" id="tab_8">
			        <div class="container">
					    <p>&nbsp;</p>
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<img src="{{ asset( '/public/storage/'.$cfg->carrusel1)}}" class="img-responsive" alt="" width="100%">
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div align="center"><img src="{{asset('images/linea.png')}}" width="1053" height="50" class="img-responsive"></div>
									<p><strong>IMAGEN CARRUSEL-1</strong></p>
							  		<p align="justify" class="Estilo4 Estilo3">Cambiar imagen numero 1 del carrusel de inicio de la pagina web.</p> 
								</div>   
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div class="form-group">
										<input type="text" class="form-control" readonly name="ncarrusel1" value="{{$cfg->carrusel1}}" style="color: #000000;background: #f7f7f7;">
										<input type="file" name="carrusel1">
									</div>
								</div>
			        		</div>
						</div>

						<p>&nbsp;</p>
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<img src="{{ asset( '/public/storage/'.$cfg->carrusel2)}}" class="img-responsive" alt="" width="100%">
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div align="center"><img src="{{asset('images/linea.png')}}" width="1053" height="50" class="img-responsive"></div>
									<p><strong>IMAGEN CARRUSEL-2</strong></p>
							  		<p align="justify" class="Estilo4 Estilo3">Cambiar imagen numero 2 del carrusel de inicio de la pagina web.</p> 
								</div>   
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div class="form-group">
										<input type="text" class="form-control" readonly name="ncarrusel2" value="{{$cfg->carrusel2}}" style="color: #000000;background: #f7f7f7;">
										<input type="file" name="carrusel2">
									</div>
								</div>
			        		</div>
						</div>

						<p>&nbsp;</p>
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<img src="{{ asset( '/public/storage/'.$cfg->carrusel3)}}" class="img-responsive" alt="" width="100%">
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div align="center"><img src="{{asset('images/linea.png')}}" width="1053" height="50" class="img-responsive"></div>
									<p><strong>IMAGEN CARRUSEL-3</strong></p>
							  		<p align="justify" class="Estilo4 Estilo3">Cambiar imagen numero 3 del carrusel de inicio de la pagina web.</p> 
								</div>   
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div class="form-group">
										<input type="text" class="form-control" readonly name="ncarrusel3" value="{{$cfg->carrusel3}}" style="color: #000000;background: #f7f7f7;">
										<input type="file" name="carrusel3">
									</div>
								</div>
			        		</div>
						</div>

						<p>&nbsp;</p>
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<img src="{{ asset( '/public/storage/'.$cfg->carrusel4)}}" class="img-responsive" alt="" width="100%">
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div align="center"><img src="{{asset('images/linea.png')}}" width="1053" height="50" class="img-responsive"></div>
									<p><strong>IMAGEN CARRUSEL-4</strong></p>
							  		<p align="justify" class="Estilo4 Estilo3">Cambiar imagen numero 4 del carrusel de inicio de la pagina web.</p> 
								</div>   
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div class="form-group">
										<input type="text" class="form-control" readonly name="ncarrusel4" value="{{$cfg->carrusel4}}" style="color: #000000;background: #f7f7f7;">
										<input type="file" name="carrusel4">
									</div>
								</div>
			        		</div>
						</div>

						<p>&nbsp;</p>
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<img src="{{ asset( '/public/storage/'.$cfg->carrusel5)}}" class="img-responsive" alt="" width="100%">
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div align="center"><img src="{{asset('images/linea.png')}}" width="1053" height="50" class="img-responsive"></div>
									<p><strong>IMAGEN CARRUSEL-5</strong></p>
							  		<p align="justify" class="Estilo4 Estilo3">Cambiar imagen numero 5 del carrusel de inicio de la pagina web.</p> 
								</div>   
								<div class="col-lg-9 col-md-9 col-sm-9">
									<div class="form-group">
										<input type="text" class="form-control" readonly name="ncarrusel5" value="{{$cfg->carrusel5}}" style="color: #000000;background: #f7f7f7;">
										<input type="file" name="carrusel5">
									</div>
								</div>
			        		</div>
						</div>
					</div>
	          	</div>
	        </div>
      	</div>
    </div>
</div> 
<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group" style="margin-top: 20px; margin-left: 15px;">
	<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>
{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection