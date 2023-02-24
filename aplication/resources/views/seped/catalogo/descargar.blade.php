<a href="" data-target="#modal-descargar" data-toggle="modal">
    <button class="btn-confirmar" 
    	data-toggle="tooltip" 
    	title="Descargar catálogo en pdf" >
    	Descargar
    </button>
</a>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-descargar">

{!! Form::open(array('action'=>array('AdcatalogoController@descargar','method'=>'POST','autocomplete'=>'off'))) !!}
{{ Form::token() }}
 
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">X</span>
			</button>
			<h4 class="modal-title">DESCARGAR CATALOGO</h4>
		</div>

		<div class="modal-body">
			<input hidden type="text" name="id" value="{{$tipo}}">
			<input hidden type="text" name="filtro" value="{{$filtro}}">
			<input hidden type="text" name="codigo2" value="{{$codigo2}}">
			<input hidden type="text" name="formato" value="PDF">
			@if ($tipo != 'F')
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							@if ($cfg->mostrarColumnaCantidad > 0)
								<input type="checkbox" name="mostrarCantidad" checked> <b>Mostrar columna de cantidades</b><br>
							@else
								<input type="checkbox" name="mostrarCantidad"> <b>Mostrar columna de cantidades</b><br>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<label>No mostrar cantidades menores de</label>
							<input type="number" name="mostrarInvMayor" value="0" class="form-control">
						</div>
					</div>
				</div>

				@if (Auth::user()->tipo != 'C')
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
					    	<label>Tipo de precio</label>
					    	<select name="tipoprecio" class="form-control">

					    		@for ($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++)
					    			<option value="{{$i}}" @if ($i == 1) selected  @endif > 
					    				{{$i}}
					    			</option>
					    		@endfor
							</select>
					    </div>
					</div>
				</div>
				@endif

				@if ($tipo == 'C')
			 	<div class="row">
				    <div class="col-xs-6">
						<div class="form-group">
					    	<label>Ordenado</label>
					    	<select name="orden" class="form-control">
					    		<option value="ALFABETICO" @if ($cfg->ordenPredCatalogo == "ALFABETICO") selected @endif >ALFABETICO</option>
					    		<option value="CATEGORIAS" @if ($cfg->ordenPredCatalogo == "CATEGORIAS") selected @endif >CATEGORIAS</option>
					    	</select>
					    </div>
				    </div>
			    </div>

			    <div class="row">
				    <div class="col-xs-6">
						<div class="form-group">
					    	<label>Formato</label>
					    	<select name="formato" class="form-control">
					    		<option value="PDF" selected >PDF</option>
					    		<option value="EXCEL" >EXCEL</option>
					    	</select>
					    </div>
				    </div>
			    </div>
			    @endif
		    @endif
		   	<br>
			<p>Confirme si desea descargar el catálogo ?</p>
		</div>

		<div class="modal-footer" style="margin-right: 20px;">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar btnAccion">Confirmar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>

