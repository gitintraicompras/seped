@extends ('layouts.menu')
@section ('contenido')

{!!Form::model($tabla,['method'=>'PATCH','route'=>['alcabala.update',$tabla->id]])!!}
{{Form::token()}}

<div class="row">

	@if ( $cfg->mostrarModnofiscal > 0 )		 
	<div class="col-xs-2">
		<div class="form-group">
			<label>ID</label>
			<input readonly type="text" name="id" value="{{$tabla->id}}" class="form-control">
		</div>
	</div>
	<div class="col-xs-2">
		<div class="form-group">
			<label>FISCAL</label>
			<input readonly type="text" name="id" class="form-control" 
			@if ($tabla->pedfiscal == '1') 
				value="SI" 
			@else
				value="NO" 
			@endif>
		</div>
	</div>
	@else
	<div class="col-xs-4">
		<div class="form-group">
			<label>ID</label>
			<input readonly type="text" name="id" value="{{$tabla->id}}" class="form-control">
		</div>
	</div>
	@endif

	<div class="col-xs-8">
		<div class="form-group">
			<label>Cliente</label>
			<input readonly type="text" value="{{$tabla->cliente}}" class="form-control">
		</div>
	</div>


	@if ( $cfg->mostrarAlcabalaOM > 0 )		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Limite de crédito</label>
				<input readonly style="text-align: right;" type="text"  class="form-control" 
				value="{{$cfg->simboloOM}} {{number_format($tabla->limiteDs, 2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($tabla->limite, 2, '.', ',')}}">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Saldo deudor</label>
				<input readonly style="text-align: right;" type="text" class="form-control" 
				value="{{$cfg->simboloOM}} {{number_format($tabla->saldoDs, 2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($tabla->saldo, 2, '.', ',')}}">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Monto vencido</label>
				<input readonly style="text-align: right;" type="text" class="form-control"
				value="{{$cfg->simboloOM}} {{number_format($tabla->vencidoDs, 2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($tabla->vencido, 2, '.', ',')}}" >
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Monto del pedido</label>
				<input readonly style="text-align: right;" type="text" class="form-control" 
				value="{{$cfg->simboloOM}} {{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($tabla->total, 2, '.', ',')}}" >
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<?php 
				$dispDs = $tabla->limiteDs-($tabla->saldoDs + ($tabla->total/$cfg->tasacambiaria));
				$dispBs = $tabla->limite - ($tabla->saldo + $tabla->total);
				?>
				<label>Monto disponible = Limite de Crédito - (Saldo deudor + Monto del pedido)</label>

				<input readonly style="text-align: right; @if ($dispDs < 0) color: red @endif;" 
				type="text" class="form-control" title="Disponible = Limite de Crédito - (Saldo deudor + Monto del pedido)"
				value="{{$cfg->simboloOM}} {{number_format($dispDs, 2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($dispBs, 2, '.', ',')}}">
			</div>
		</div>
	
	@else

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Limite de crédito</label>
				<input readonly style="text-align: right;" type="text" 
				value="{{number_format($tabla->limite, 2, '.', ',')}}" 
				class="form-control">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Saldo deudor</label>
				<input readonly style="text-align: right;" type="text" 
				value="{{number_format($tabla->saldo, 2, '.', ',')}}" 
				class="form-control">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Monto vencido</label>
				<input readonly style="text-align: right;" type="text" 
				value="{{number_format($tabla->vencido, 2, '.', ',')}}" 
				class="form-control">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Monto del pedido</label>
				<input readonly style="text-align: right;" type="text" 
				value="{{number_format($tabla->total, 2, '.', ',')}}" 
				class="form-control">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<?php $disp = $tabla->limite-($tabla->saldo + $tabla->total); ?>
			<div class="form-group">
				<label>Monto disponible = Limite de Crédito - (Saldo deudor + Monto del pedido)</label>
				<input readonly style="text-align: right; 
				@if ( $disp < 0) color: red @endif;" 
				type="text" class="form-control" 
				value="{{number_format($disp, 2, '.', ',')}}"
				title="Disponible = Limite de Crédito - (Saldo deudor + Monto del pedido)" 
				>
			</div>
		</div>
		
	@endif


	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Estado</label>
			<input readonly style="@if ($tabla->estadocliente == 'INACTIVO') color: red @endif;" type="text" class="form-control" value="{{$tabla->estadocliente}}" title="Estado del cliente">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Dias crédito</label>
			<input readonly style="text-align: right;" type="text" value="{{$tabla->dcredito}}" class="form-control">
		</div>
	</div>

	@if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R')
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	    	<label>Acción</label>
	    	<select name="status" class="form-control">
	    		<option value="PRE-APROBADO">PRE-APROBADO</option>
	    		<option value="ANULADO">ANULADO</option>
	    	</select>
	    </div>
	</div>
	@endif

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	    	<label>Observación</label>
	    	@if (Auth::user()->tipo == 'V')
	    		<input readonly name="observacion" type="text" class="form-control" value="{{$tabla->observacion}}" >
	    	@else
	    		<input name="observacion" type="text" class="form-control" value="{{$tabla->observacion}}" >
	    	@endif
	    </div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	    	<label>Transporte de Mercancia</label>
	    	@if (Auth::user()->tipo == 'V')
	    		<input readonly name="codtransp" type="text" class="form-control" value="{{$tabla->codtransp}}" >
	    	@else
	    		<input name="codtransp" type="text" class="form-control" value="{{$tabla->codtransp}}" >
	    	@endif
	    </div>
	</div>

</div>

<!-- BOTON GUARDAR/CANCELAR -->
<br>
<div class="form-group" style="margin-top: 20px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
    @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R')
		<button class="btn-confirmar" type="submit">Procesar</button>
	@endif
</div>

{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection