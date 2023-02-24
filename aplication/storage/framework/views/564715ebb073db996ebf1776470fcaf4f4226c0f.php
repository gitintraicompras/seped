<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-procesar-<?php echo e($t->id); ?>">
<?php echo Form::open(array('action'=>array('AdmonitorreclamoController@procesar','method'=>'POST','autocomplete'=>'off'))); ?>

<?php echo e(Form::token()); ?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">PROCESAR RECLAMO</h4>
		</div>
		<div class="modal-body">
		
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>ID</label>
					<input readonly type="text" name="id" value="<?php echo e($t->id); ?>" class="form-control">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    <div class="form-group">
			    	<label>Acción</label>
			    	<select name="status" class="form-control">
			    		<option value="PROCESADO">PROCESADO</option>
			    		<option value="EN REVISION">EN REVISION</option>
			    		<option value="NO PROCEDE">NO PROCEDE</option>
			    		<option value="SIN EFECTO">SIN EFECTO</option>
			    	</select>
			    </div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<label>Nota</label>
					<input type="text" name="nota" class="form-control">
				</div>
			</div>
		
		</div>
		<br>
		<div class="modal-footer" >
			<div class="col-xs-12">
				<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
				<button type="submit" class="btn-confirmar btnAccion">Confirmar</button>
			</div>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

</div>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/monitorreclamo/procesar.blade.php ENDPATH**/ ?>