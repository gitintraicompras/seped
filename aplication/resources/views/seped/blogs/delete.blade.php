{{Form::Open(array('action'=>array('AdblogsController@destroy',$blog->id),'method'=>'delete'))}}
<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-{{$blog->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo" >
				<button type="button" 
					class="close" 
					data-dismiss="modal" 
					aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">ELIMINAR BLOG</h4>
			</div>
			<div class="modal-body">
				<p>iD: {{$blog->id}}</p>
				<p>Nombre: {{$blog->nombre}}</p>
				<p>Confirme si desea eliminar el blog ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
{{Form::Close()}}
