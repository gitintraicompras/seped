@extends ('layouts.menu')
@section ('contenido')

{!! Form::open(array('url'=>'/seped/usuario','method'=>'POST','autocomplete'=>'off')) !!}
{{ Form::token() }}
<div class="row">
	@if (count($errors)>0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	    	<label>Tipo usuario</label>
	    	<select name="tipo" class="form-control" id="SelClickTipo">
				<option value='C' 
                    @if ($ctipo=='C')
                        selected='selected'
                    @endif 
                    >CLIENTE
                </option>
                <option value='A' 
                    @if ($ctipo=='A')
                        selected='selected'
                    @endif 
                    >ADMINISTRADOR
                </option>
                <option value='S' 
                    @if ($ctipo=='S')
                        selected='selected'
                    @endif 
                    >SUPERVISOR
                </option>
                <option value='R' 
                    @if ($ctipo=='R')
                        selected='selected'
                    @endif 
                    >CREDITO Y COBRANZA
                </option>
                <option value='V' 
                    @if ($ctipo=='V')
                        selected='selected'
                    @endif 
                    >VENDEDOR
                </option>
                <option value='G' 
                    @if ($ctipo=='G')
                        selected='selected'
                    @endif 
                    >GRUPO
                </option>
                <option value='P' 
                    @if ($ctipo=='P')
                        selected='selected'
                    @endif 
                    >PROVEEDOR
                </option>
                <option value='T' 
                    @if ($ctipo=='T')
                        selected='selected'
                    @endif 
                    >CHOFERES
                </option>
 	    	</select>
	    </div>
    </div> 

    @if ($ctipo == "C" || $ctipo == "")
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    	    <div class="form-group">
    	    	<label for="cliente">Cliente</label>
    	    	<select name="codcli" 
                    class="form-control selectpicker" 
                    data-live-search="true" 
                    id="SelClickCliente">
    	    		@foreach($cliente as $cli)
    	    			<option style="width: 520px;" value="{{$cli->codcli}}">{{$cli->codcli}} | {{$cli->nombre}}</option>
    	    		@endforeach
    	    	</select>
    	    </div>
    	</div>
	@endif
 	@if ($ctipo == "V")
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    	    <div class="form-group">
    	    	<label for="cliente">Vendedor</label>
    	    	<select name="codcli" i
                    d="idcodcli" 
                    class="form-control selectpicker" 
                    data-live-search="true">
    	    		@foreach($vendedor as $ven)
    	    			<option style="width: 520px;" 
                            value="{{$ven->codigo}}">
                            {{$ven->codigo}} | {{$ven->nombre}}
                        </option>
    	    		@endforeach
    	    	</select>
    	    </div>
    	</div>
	@endif
    @if ($ctipo == "G")
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select name="codcli" id="idgrupo" class="form-control selectpicker" data-live-search="true">
                    @foreach($grupo as $g)
                        <option style="width: 520px;" value="{{$g->id}}">
                            {{$g->id}} | {{$g->nomgrupo}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    @if ($ctipo == "P")
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Proveedor</label>
                <select name="codcli" id="SelClickProveedor" class="form-control selectpicker" data-live-search="true">
                    @foreach($marca as $m)
                        <option style="width: 520px;" value="{{$m->codmarca}}">
                            {{$m->codmarca}} 
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    @if ($ctipo == "T")
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Choferes</label>
                <select name="codcli" id="idgrupo" class="form-control selectpicker" data-live-search="true">
                    @foreach($choferes as $ch)
                        <option style="width: 520px;" value="{{$ch->chof_co}}">
                            {{$ch->chof_co}} | {{$ch->chof_nom}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Correo:</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
  
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	        <label for="name">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
	    </div>
    </div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	        <label for="password">Clave</label>
            <input id="password" type="password" class="form-control" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
	    </div>
    </div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	        <label for="password-confirm">Confirmar Clave</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
	    </div>
    </div>

    @if ($ctipo == "C" || $ctipo == "P")
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Rif</label>
            <input id="rif" readonly type="text" class="form-control" >
        </div>
    @endif
    @if ($ctipo == "V")
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group" style="padding-top: 20px;">
                <div class="form-check">
                    <input name="vendsuper" type="checkbox" class="form-check-input" >
                    <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group" style="padding-top: 20px;">
                <div class="form-check">
                    <input name="cambiarNegociacion" type="checkbox" class="form-check-input" >
                    <label class="form-check-label" for="materialUnchecked">Cambiar precios</label>
                </div>
            </div>
        </div>
	@endif

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br>
		<div class="form-group">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
			<button class="btn-confirmar" type="submit">Guardar</button>
		</div>
	</div>
</div>
{{ Form::close() }}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');

$('#SelClickTipo').on('change', function()
{
    var ctipo = this.value;
  	var url = "{{url('/seped/usuario/create?ctipo=X')}}";
	url = url.replace('X', ctipo);
	window.location.href=url;
});

$('#SelClickCliente').on('change', function()
{
    var codigo = this.value;
    $.ajax({
        type:'POST',
        url:'../leercorreoclie',
        dataType: 'json', 
        encode  : true,
        data: {codigo : codigo },
        success:function(data) {
            $('#email').val(data.email);
            $('#name').val(data.nombre);
            $('#rif').val(data.rif);
        }
    });
});

$('#SelClickProveedor').on('change', function()
{
    var codigo = this.value;
    $.ajax({
        type:'POST',
        url:'../leercorreoprov',
        dataType: 'json', 
        encode  : true,
        data: { codigo : codigo },
        success:function(data) {
            $('#email').val(data.email);
            $('#name').val(data.nombre);
            $('#rif').val(data.rif);
        }
    });
});

</script>
@endpush

@endsection