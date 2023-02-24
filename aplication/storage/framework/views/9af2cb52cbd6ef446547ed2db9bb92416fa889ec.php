
<a href="" data-target="#modal-enviar-<?php echo e($pago->id); ?>" data-toggle="modal">
	<button class="btn-normal" data-toggle="tooltip" title="Enviar pago">Enviar</button>
</a>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-enviar-<?php echo e($pago->id); ?>">
<?php echo e(Form::Open(array('action'=>array('AdpagoController@enviar',$pago->id),'method'=>'get'))); ?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">ENVIAR PAGO</h4>
		</div>
		<div class="modal-body">
			<p>Pago # <?php echo e($pago->id); ?></p>
			<p>Confirme si desea enviar el Pago ?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pago/enviar.blade.php ENDPATH**/ ?>