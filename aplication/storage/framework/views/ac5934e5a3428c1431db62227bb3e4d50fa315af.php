<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-confirmar-<?php echo e($metodo); ?>">
<?php $metodox = 'AdnotiServidorController@'.$metodo; ?>
<?php echo e(Form::Open(array('action'=>array( $metodox ),'method'=>'GET'))); ?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title"><?php echo e($mensaje); ?></h4>
		</div>
		<div class="modal-body">
			<p>Confirme si desea procesar la solicitud ?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/notiservidor/confirmar.blade.php ENDPATH**/ ?>