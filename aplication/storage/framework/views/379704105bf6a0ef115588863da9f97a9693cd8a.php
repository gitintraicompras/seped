<?php echo e(Form::Open(array('action'=>array('AdpromdiasController@delprod',$pr->id.'_'.$pr->codprod.'_'.$pr->codisb),'method'=>'get'))); ?>

<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-delete-<?php echo e($pr->id); ?>-<?php echo e($pr->codprod); ?>-<?php echo e($pr->codisb); ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">RETIRAR PRODUCTO</h4>
			</div>
			<div class="modal-body">
				<p>ID: <?php echo e($promdias->id); ?></p>
				<p>Descripción: <?php echo e($promdias->descrip); ?></p>
				<p>Producto: <?php echo e($pr->codprod); ?> <?php echo e($pr->desprod); ?></p>
				<p>Confirme si desea retirar el producto de la promoción ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
</div>
</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/promdias/delprod.blade.php ENDPATH**/ ?>