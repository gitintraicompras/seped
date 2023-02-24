<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-enviar-{{$tabla->id}}">

{{Form::Open(array('action'=>array('AdreclamoController@enviar',$tabla->id),'method'=>'get'))}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">ENVIAR RECLAMO</h4>
		</div>
		<div class="modal-body">
			<p>Reclamo # {{$tabla->id}}</p>
			<p>Confirme si desea enviar el Reclamo ?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>