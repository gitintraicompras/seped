<?php echo e(Form::Open(array('action'=>array('AdmarcaimgController@destroy',$m->codmarca),'method'=>'delete'))); ?>

<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-<?php echo e($m->codmarca); ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo">
				<button type="button" 
					class="close" 
					data-dismiss="modal" 
					aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">ELIMINAR MARCA</h4>
			</div>
			<div class="modal-body">
				<p>Código: <?php echo e($m->codmarca); ?></p>
				<p>Confirme si desea eliminar la marca ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/marcaimg/delete.blade.php ENDPATH**/ ?>