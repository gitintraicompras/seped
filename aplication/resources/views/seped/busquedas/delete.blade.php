{{Form::Open(array('action'=>array('AdbusquedasController@destroy',$t->id),'method'=>'delete'))}}
<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-{{$t->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo" >
				<button type="button" 
					class="close" 
					data-dismiss="modal" 
					aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">ELIMINAR DE LA LISTA</h4>
			</div>
			<div class="modal-body">
				<p>Id: {{$t->id}}</p>
				<p>Busqueda: {{$t->texto}}</p>
				<p>Confirme si desea eliminar de la lista ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
{{Form::Close()}}
