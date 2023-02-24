<?php echo Form::open(array('action'=>array('AdpromdiasController@promren','method'=>'POST','autocomplete'=>'off'))); ?>

<?php echo e(Form::token()); ?>


<!-- AGREGAR PRODUCTO NUEVO -->
<a href="" 
    data-target="#modal-agregar-<?php echo e($id); ?>" 
    data-toggle="modal">
    <button style="width: 90px; height: 34px; border-radius: 5px;" 
        type="button" 
        data-toggle="tooltip" 
        title="Agregar producto nuevo al pedido" 
        class="btn-catalogo">
        Agregar producto
    </button>
</a>

<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" 
	tabindex="-1" 
	id="modal-promren-<?php echo e($promdias->id); ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header colorTitulo">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">NUEVO PRODUCTO</h4>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<div class="form-group">
						<label>ID</label>
						<input type="text" name="id" readonly value="<?php echo e($promdias->id); ?>" class="form-control">
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label>Promoción</label>
						<input type="text" readonly value="<?php echo e($promdias->descrip); ?>" class="form-control">
					</div>
				</div>
				<div class="col-xs-12" >
				    <div class="form-group">
				    	<label>Productos</label>
				    	<select name="codprod" class="form-control selectpicker" data-live-search="true">
				    		<?php $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    			<option style="width: 520px;" 
			    				value="<?php echo e($p->codprod); ?> | <?php echo e($p->desprod); ?> | <?php echo e($p->marcamodelo); ?> |">
			    				<?php echo e($p->codprod); ?> | <?php echo e($p->desprod); ?> | <?php echo e($p->marcamodelo); ?> |
			    			</option>
				    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    	</select>
				    </div>
				</div>
			</div>
			<div class="modal-footer" style="margin-right: 20px;">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>


<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/promdias/promren.blade.php ENDPATH**/ ?>