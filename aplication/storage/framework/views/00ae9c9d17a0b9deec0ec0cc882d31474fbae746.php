<div  align="left" class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-enviar-<?php echo e($tabla->id); ?>">

<?php echo e(Form::Open(array('action'=>array('AdcatalogoController@enviar',$tabla->id),'method'=>'get'))); ?>


<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">ENVIAR PEDIDO</h4>
		</div>
		<div class="modal-body">
			<p>Pedido # <?php echo e($tabla->id); ?></p>
			<div class="form-group">
				<label>Observación</label>
				<input type="text" name="observ" value="<?php echo e($tabla->observacion); ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>Transporte de Mercancia</label>
				<select name="codtransp" class="form-control" >
					<?php $__currentLoopData = $transplit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($tl->literal); ?>"><?php echo e($tl->literal); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo e(Form::Close()); ?>

</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/catalogo/enviar.blade.php ENDPATH**/ ?>