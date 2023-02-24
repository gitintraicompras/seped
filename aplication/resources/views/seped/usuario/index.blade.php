@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="usuario/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear usuario nuevo">
				Nuevo usuario
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.usuario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					<th style="width: 190px;">OPCION</th>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>USUARIO</th>
					<th>CODIGO</th>
					<th>TIPO</th>
					<th>PREDET</th>
				</thead>
				@foreach ($usuario as $usu)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{URL::action('AdusuarioController@show',$usu->id)}}">
							<button class="btn btn-default btn-pedido fa fa-file-o" 
								title="Consultar Usuario">
							</button>
						</a>
						<a href="{{URL::action('AdusuarioController@edit',$usu->id)}}">
							<button class="btn btn-default btn-pedido fa fa-pencil" 
								title="Modificar Usuario">
							</button>
						</a>
						@if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'S')
							<a href="" 
								data-target="#modal-delete-{{$usu->id}}" 
								data-toggle="modal">
								<button class="btn btn-default btn-pedido fa fa-trash-o" 
									title="Eliminar Usuario">
								</button>
							</a>
							<button data-toggle="tooltip" 
								title="Resetear clave" 
								class="btn btn-default btn-pedido fa fa-unlock-alt BtnReset" 
								id="idReset_{{$usu->id}}_{{$usu->name}}">
							</button>
						@endif
					</td>
					<td>{{$usu->id}}</td>
					<td>{{$usu->name}}</td>
					<td>{{$usu->email}}</td>
					<td>{{$usu->codcli}}</td>
					<td>{{$usu->tipo}}</td>
					<td>{{sLeercfg($usu->codisbpredet, "SedeSucursal")}}</td>
				</tr>
				@include('seped.usuario.delete')
				@endforeach
			</table>
		</div>
	</div>
</div>

<!-- MODAL RESETEAR CLAVE -->
<div class="modal fade" id="ModalReset" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorTitulo" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">RESETEAR CLAVE</h4>
            </div>

            <div class="modal-body">

                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <span style="width: 100px;" class="input-group-addon">Código:</span>
                    <input readonly type="text" class="form-control" value="" style="color:#000000" id="idCodusu" name="codusu">   
                </div>
                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                    <span style="width: 100px;" class="input-group-addon">Nombre:</span>
                    <input readonly type="text" class="form-control" value="" style="color:#000000" id="idNombre" name="nombre">   
                </div>
                
           	    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top: 15px;">
			        <label for="password">Clave</label>
		            <input id="idPassword" type="password" class="form-control" name="password">
		            @if ($errors->has('password'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('password') }}</strong>
		                </span>
		            @endif
			    </div>
			   
		    </div>

            <div class="modal-footer">
                <div style="margin-top: 5px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
                    <button type="button" class="btn-confirmar BtnResetear" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');

$('.BtnReset').on('click',function(e){
	var variable = e.target.id.split('_');
    var id = variable[1];
    var name = variable[2];
    $('#idCodusu').val(id);
	$('#idNombre').val(name);
    $('#ModalReset').modal({show:true});
});

$('.BtnResetear').on('click',function(e){
    var codusu = $('#idCodusu').val();
    var password = $('#idPassword').val();
    $.ajax({
        type:'POST',
        url:'../seped/resetear',
        dataType: 'json', 
        encode  : true,
        data: {codusu : codusu, password : password },
        success:function(data){
            if (data.msg != null)
            {
                
            }   
       }
    });
});

</script>
@endpush

@endsection