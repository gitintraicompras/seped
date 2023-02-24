<div  align="left" class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-enviar-{{$tabla->id}}">

{{Form::Open(array('action'=>array('AdcatalogoController@enviar',$tabla->id),'method'=>'get'))}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">ENVIAR PEDIDO</h4>
		</div>
		<div class="modal-body">
			<p>Pedido # {{$tabla->id}}</p>
			<div class="form-group">
				<label>Observación</label>
				<input type="text" name="observ" value="{{$tabla->observacion}}" class="form-control">
			</div>
			<div class="form-group">
				<label>Transporte de Mercancia</label>
				<select name="codtransp" class="form-control" >
					@foreach($transplit as $tl)
					<option value="{{$tl->literal}}">{{$tl->literal}}</option>
					@endforeach
				</select>
			</div>
			<br>
			<p>Confirme si desea enviar el Pedido ?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>