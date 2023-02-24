<?php echo e(Form::Open(array('action'=>array('AdcargaController@destroy',$t->id),'method'=>'delete'))); ?>

<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-<?php echo e($t->id); ?>">
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
				<p>Id: <?php echo e($t->id); ?></p>
				<p>Descripción: <?php echo e($t->descrip); ?></p>
				<p>Confirme si desea eliminar de la lista ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/carga/delete.blade.php ENDPATH**/ ?>