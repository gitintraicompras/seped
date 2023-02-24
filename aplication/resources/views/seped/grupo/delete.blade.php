{{Form::Open(array('action'=>array('AdgrupoController@destroy',$gp->id),'method'=>'delete'))}}
<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-{{$gp->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo">
				<button type="button" 
					class="close" 
					data-dismiss="modal" 
					aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">ELIMINAR GRUPO</h4>
			</div>
			<div class="modal-body">
				<p>Nombre: {{$gp->nomgrupo}}</p>
				<p>También eliminará los usuarios que usen este grupo !!!</p>
				<p>Confirme si desea eliminar el grupo ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
{{Form::Close()}}
