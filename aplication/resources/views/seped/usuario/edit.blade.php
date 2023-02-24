@extends ('layouts.menu')
@section ('contenido')

@if (count($errors)>0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif

{!!Form::model($usuario,['method'=>'PATCH','route'=>['usuario.update',$usuario->id]])!!}
{{Form::token()}}
<input hidden="" name="tipo" value="{{$usuario->tipo}}" >
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
                        <input readonly 
                            id="codcli" 
                            type="text" 
                            class="form-control" 
                            name="codcli" 
                            value="{{$usuario->codcli}}" 
                            style="color: #000000; background: #F7F7F7;">
                    </div>
                </div>

                <!-- NOMBRE DEL USUARIO (IDENTIFICADOR) -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            	        <label for="name">Nombre</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" >
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
            	    </div>
                </div>

            	<!-- CORREO -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            	    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            	        <label for="email">Correo:</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
            	    </div>
                </div>

             	<!-- TIPO DE USUARIO -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            	    <div class="form-group">
            	    	<label>Tipo usuario</label>
                        @if ($usuario->tipo=='C')
                            <input readonly type="text" class="form-control" value="CLIENTE" style="color: #000000; background: #F7F7F7;">
                        @endif 
                        @if ($usuario->tipo=='A')
                        	<input readonly type="text" class="form-control" value="ADMINISTRADOR" style="color: #000000; background: #F7F7F7;">
                        @endif 
                        @if ($usuario->tipo=='V')
                           	<input readonly type="text" class="form-control" value="VENDEDOR" style="color: #000000; background: #F7F7F7;">
                        @endif
                        @if ($usuario->tipo=='G')
                            <input readonly type="text" class="form-control" value="GRUPO" style="color: #000000; background: #F7F7F7;">
                        @endif  
                        @if ($usuario->tipo=='S')
                            <input readonly type="text" class="form-control" value="SUPERVISOR" style="color: #000000; background: #F7F7F7;">
                        @endif  
                        @if ($usuario->tipo=='R')
                            <input readonly type="text" class="form-control" value="CREDITO Y COBRANZA" style="color: #000000; background: #F7F7F7;">
                        @endif
                        @if ($usuario->tipo=='P')
                            <input readonly type="text" class="form-control" value="PROVEEDOR" style="color: #000000; background: #F7F7F7;">
                        @endif
                        @if ($usuario->tipo=='T')
                            <input readonly type="text" class="form-control" value="CHOFER" style="color: #000000; background: #F7F7F7;">
                        @endif  
                    </div>
                </div>

                <!-- ACTIVAR/INACTIVAR USUARIO -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            		<div class="form-group">
            	    	<label>Status</label>
            	    	<select name="estado" class="form-control">
            	    		@if ($usuario->estado == 'ACTIVO')
            		    		<option value="ACTIVO" selected>ACTIVO</option>
            		    		<option value="INACTIVO">INACTIVO</option>
            	    		@else
            		    		<option value="ACTIVO">ACTIVO</option>
            		    		<option value="INACTIVO" selected>INACTIVO</option>
            	    		@endif
            	    	</select>
            	    </div>
                </div>

                @if ($usuario->tipo == "V")
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group" style="padding-top: 25px;">
                            <div class="form-check">
                                @if ($usuario->vendsuper==1)
                                    <input checked name="vendsuper" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                @else
                                    <input name="vendsuper" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                @endif
                                <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group" style="padding-top: 25px;">
                            <div class="form-check">
                                @if ($usuario->cambiarNegociacion==1)
                                    <input checked name="cambiarNegociacion" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                @else
                                    <input name="cambiarNegociacion" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
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
                        <th style="width: 100px;">ACTIVAR</th>
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
                            <input type="checkbox" 
                                class="BtnModcuenta" 
                                name="codisbactivo[{{$suc->codisb}}]"
                                @if ($suc->codisbactivo==1) checked @endif />
                        </td>
                        <td>
                            <input type="checkbox" 
                                class="BtnModcuenta case"  
                                name="predeter[{{$suc->codisb}}]"
                                onclick='clickmodpredet(event);'
                                id='idcheck_{{$suc->codisb}}'
                                @if ($predet==1) checked @endif />
                        </td>
                    </tr>
                    @endforeach
                </table><br>
            </div>
        </div>
    </div>
</div>

<!-- BOTON REGRESAR/GUARDAR -->
<div class="form-group" style="margin-top: 20px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>
{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
if ($(".case").length == $(".case:checked").length) {
    $("#selectall").prop("checked", true);
} else {
    $("#selectall").prop("checked", false);
}
function clickmodpredet(e) {
    var id = e.target.id.split('_');
    var codsuc = id[1];
    $(".case").prop("checked", false);
    $("#idcheck_" + codsuc).prop("checked", true);
}

</script>
@endpush

@endsection