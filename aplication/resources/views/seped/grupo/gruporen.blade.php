<a href="" data-target="#modal-gruporen-{{$grupo->id}}" data-toggle="modal">
    <button style="font-size: 18px; width: 200px;" title="Crear grupo nuevo" class="btn-normal">
        Agregar cliente
    </button>
</a>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-gruporen-{{$grupo->id}}">

{!! Form::open(array('action'=>array('AdgrupoController@gruporen','method'=>'POST','autocomplete'=>'off'))) !!}
{{ Form::token() }}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">NUEVO MIEMBRO</h4>
		</div>
		<div class="modal-body">
			<div class="col-xs-12">
				<div class="form-group">
					<label>ID</label>
					<input type="text" name="id" readonly value="{{$grupo->id}}" class="form-control">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label>Grupo</label>
					<input type="text" readonly value="{{$grupo->nomgrupo}}" class="form-control">
				</div>
			</div>
			<div class="col-xs-12" >
			    <div class="form-group">
			    	<label>Clientes</label>
			    	<select name="codcli" class="form-control selectpicker" data-live-search="true">
			    		@foreach($cliente as $c)
		    			<option style="width: 520px;" value="{{$c->codcli}} | {{$c->nombre}}">
		    				{{$c->codcli}} | {{$c->nombre}}
		    			</option>
			    		@endforeach
			    	</select>
			    </div>
			</div>
		</div>
		<div class="modal-footer" style="margin-right: 20px;">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>

