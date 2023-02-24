<!-- BUSCAR FACTURA -->
<?php echo Form::open(array('url'=>'/seped/report/facturas','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="form-group">
	<div class="input-group" style="margin-left: 0px; width: 100px;">
 	   	<span class="input-group-addon">Fecha:</span>
	   	<span class="input-group-btn">
	   		<input type="date" name="desde" class="form-control" value="<?php echo e(date('Y-m-d', strtotime($desde))); ?>">
	   	</span>
	   	<span class="input-group-addon" style="border:0px; "></span>
	   	<span class="input-group-btn">
	   		<input type="date" name="hasta" class="form-control" value="<?php echo e(date('Y-m-d', strtotime($hasta))); ?>">
	   	</span>
		<span class="input-group-addon" style="border:0px; "></span>
	   	<input style="width: 150px;" type="text" name="filtro" class="form-control" placeholder="Buscar" value="<?php echo e($filtro); ?>">

		<span class="input-group-btn">
			<button type="submit" class="btn btn-default btn-buscar">
				<span class="fa fa-search" aria-hidden="true"></span>
			</button>
		</span>
	</div>
</div>
<?php echo e(Form::close()); ?>



<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/factsearch.blade.php ENDPATH**/ ?>