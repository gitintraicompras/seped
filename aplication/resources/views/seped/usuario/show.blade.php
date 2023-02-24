@extends ('layouts.menu')
@section ('contenido')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab"><B>BASICA</B></a></li>
      @if ($sucursal->count() > 1)
      <li><a href="#tab_2" data-toggle="tab"><B>SUCURSALES</B></a></li>
      @endif
      <li class="pull-right">
      	<a href="{{url('/seped/config')}}" class="text-muted">
      		<i class="fa fa-window-close-o"></i>
      	</a>
      </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
			<div class="row">
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Código</label>
			            <input readonly id="codcli" type="text" class="form-control" name="name" value="{{$usuario->codcli}}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Nombre</label>
			            <input readonly id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div> 

				@if ($usuario->tipo=='C')
				 	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					    <div class="form-group">
					    	<label>Descripción del cliente</label>
					    	<input readonly type="text" class="form-control"  value="{!! !empty($cliven->nombre) ? $cliven->nombre : 'cliente no encontrado' !!}" style="color: #000000; background: #F7F7F7;">
					    </div>
					</div>
				@endif
				@if ($usuario->tipo=='V')
				    @if (!is_null($cliven)) {
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					    <div class="form-group">
					    	<label>Descripción del vendedor</label>
					    	<input readonly type="text" class="form-control" value="{{$cliven->nombre}}" style="color: #000000; background: #F7F7F7;">
					    </div>
					</div>
					@endif
				@endif
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				        <label for="email">Correo:</label>
			            <input readonly id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				    	<label>Tipo usuario</label>
				    	@if ($usuario->tipo == "C")
				    		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CLIENTE" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "A")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="ADMINISTRADOR" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "V")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="VENDEDOR" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "G")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="GRUPO" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "R")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CREDITO Y COBRANZA" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "S")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="SUPERVISOR" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "T")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CHOFER" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    	@if ($usuario->tipo == "P")
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="PROVEEDOR" style="color: #000000; background: #F7F7F7;">
				    	@endif
				    </div>
			    </div>

			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				        <label for="estado">Status</label>
			            <input readonly id="estado" type="text" class="form-control" name="estado" value="{{ $usuario->estado }}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

			    @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'S')
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Clave</label>
			            <input readonly id="clave" type="text" class="form-control" name="name" value="{{$usuario->clave}}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Sucursal predeterminada</label>
			            <input readonly 
			            	type="text" 
			            	class="form-control" 
			            	value="{{sLeercfg($usuario->codisbpredet, 'SedeSucursal')}}" 
			            	style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    @endif

			    @if (Auth::user()->tipo == 'R' && $usuario->tipo != "A")
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Clave</label>
			            <input readonly id="clave" type="text" class="form-control" name="name" value="{{$usuario->clave}}" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    @endif

				@if ($usuario->tipo == "V")
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group" style="padding-top: 25px;">
					    	<div class="form-check">
								@if ($usuario->vendsuper==1)
							    	<input disabled checked type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    @else
							    	<input disabled type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    @endif
							    <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group" style="padding-top: 25px;">
					    	<div class="form-check">
								@if ($usuario->cambiarNegociacion==1)
							    	<input disabled checked type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    @else
							    	<input disabled type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    @endif
							    <label class="form-check-label" for="materialUnchecked">Cambiar precios</label>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
		<div class="tab-pane" id="tab_2">
			<div class="table-responsive">
                <table id="idtabla" 
                    class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th style="width: 100px;">ACTIVO</th>
                        <th style="width: 100px;">PREDET</th>
                    </thead>
                    @foreach ($sucursal as $suc)
                    @php
                    $predet = 0;
                    if ($usuario->codisbpredet == $suc->codisb) {
                        $predet = 1;
                    }
                    @endphp
                    <tr>
                        <td>{{$suc->codisb}}</td>
                        <td>{{sLeercfg($suc->codisb, "SedeSucursal")}}</td>
                        <td>
                          @if ($suc->codisbactivo==1) 
                          	<i class="fa fa-check" aria-hidden="true"></i> 
                          @endif 
                        </td>
                        <td>
                        	@if ($predet==1) 
                        		<i class="fa fa-check" aria-hidden="true"></i>
                        	@endif 
                        </td>
                    </tr>
                    @endforeach
                </table><br>
            </div>
		</div>
	</div>
</div>
@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection