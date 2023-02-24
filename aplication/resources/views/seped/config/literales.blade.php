@extends ('layouts.menu')
@section ('contenido')

{{Form::Open(array('action'=>array('AdconfigController@grabarlit')))}}
{{ Form::token() }}
<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>EDITAR LITERALES</B></a></li>
	          <li class="pull-right">
	          	<a href="{{url('/seped/config')}}" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
		          	<div class="row">
		          		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
				        	<div class="table-responsive">
				                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
				             
					                <thead class="colorTitulo">
					                	<th style="width: 150px;">LITERAL ORIGINAL</th>
					                  	<th>DESCRIPCION ORIGINAL</th>
						                <th style="width: 150px;">NUEVO LITERAL</th>
						                <th>NUEVA DESCRIPION</th>
						            </thead>
					                
					                <tr>
					                  	<td>DA</td>
					                	<td>DESCUENTO ADICIONAL</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitDa}}" name="LitDa" class="form-control" @if ($cfg->mostrarDa == 0) readonly @endif >
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitDa}}" name="msgLitDa" class="form-control" @if ($cfg->mostrarDa == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DP</td>
					                	<td>DESCUENTO DE PRE-EMPAQUE</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitDp}}" name="LitDp" class="form-control" @if ($cfg->mostrarDp == 0) readonly @endif >
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitDp}}" name="msgLitDp" class="form-control" @if ($cfg->mostrarDp == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DV</td>
					                	<td>DESCUENTO POR VOLUMEN</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitDv}}" name="LitDv" class="form-control" @if ($cfg->mostrarDv == 0) readonly @endif>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitDv}}" name="msgLitDv" class="form-control" @if ($cfg->mostrarDv == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DI</td>
					                	<td>DESCUENTO DE INTERNET</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitDi}}" name="LitDi" class="form-control" @if ($cfg->mostrarDi == 0) readonly @endif>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitDi}}" name="msgLitDi" class="form-control" @if ($cfg->mostrarDi == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DC</td>
					                	<td>DESCUENTO COMERCIAL</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitDc}}" name="LitDc" class="form-control" @if ($cfg->mostrarDc == 0) readonly @endif>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitDc}}" name="msgLitDc" class="form-control" @if ($cfg->mostrarDc == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>PP</td>
					                	<td>DESCUENTO DE PRONTO PAGO</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitPp}}" name="LitPp" class="form-control" @if ($cfg->mostrarPp == 0) readonly @endif>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitPp}}" name="msgLitPp" class="form-control" @if ($cfg->mostrarPp == 0) readonly @endif>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>PRECIO</td>
					                	<td>PRECIO DE VENTA</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitPrecio}}" name="LitPrecio" class="form-control">
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitPrecio}}" name="msgLitPrecio" class="form-control">
					                	</td>
					                </tr>
					                <tr>
					                  	<td>VIP</td>
					                	<td>CLIENTE VIP</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->LitVip}}" name="LitVip" class="form-control">
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="{{$cfg->msgLitVip}}" name="msgLitVip" class="form-control">
					                	</td>
					                </tr>
						        </table><br>
				            </div>
						</div>
		          	</div>
	          	</div>
	        </div>
      	</div>
    </div>
</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group" style="margin-left: 15px;">
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