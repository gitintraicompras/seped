<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-<?php echo e($gr->id); ?>-<?php echo e($gr->codcli); ?>">
<?php echo e(Form::Open(array('action'=>array('AdgrupoController@delcli',$gr->id.'_'.$gr->codcli),'method'=>'get'))); ?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">RETIRAR CLIENTE</h4>
		</div>
		<div class="modal-body">
			<p>ID: <?php echo e($grupo->id); ?></p>
			<p>Grupo: <?php echo e($grupo->nomgrupo); ?></p>
			<p>Cliente: <?php echo e($gr->codcli); ?> <?php echo e($gr->nomcli); ?></p>
			<p>Confirme si desea retirar el cliente del grupo ?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar">Confirmar</button>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/grupo/delcli.blade.php ENDPATH**/ ?>