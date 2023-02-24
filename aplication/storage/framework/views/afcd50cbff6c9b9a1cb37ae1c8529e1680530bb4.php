<!-- NUEVO PAGO RENGLON  -->
<a href="" data-target="#modal-pagren-<?php echo e($pago->id); ?>" data-toggle="modal">
    <button style="margin-left: 16px; margin-bottom: 5px;" class="btn-normal" data-toggle="tooltip" title="Nuevo renglon pago" >Nuevo</button>
</a>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pagren-<?php echo e($pago->id); ?>">
<?php echo Form::open(array('action'=>array('AdpagoController@pagren','method'=>'POST','autocomplete'=>'off'))); ?>

<?php echo e(Form::token()); ?>


<input hidden type="text" name="forma" value="<?php echo e($forma); ?>">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header colorTitulo" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">NUEVO RENGLON DE PAGO (<?php echo e($pago->id); ?>)</h4>
		</div>
		<div class="modal-body">
			<input hidden type="text" name="id" value="<?php echo e($pago->id); ?>">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Referencia</label>
					<input type="text" name="referencia" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    <div class="form-group">
			    	<label>Cuenta destino</label>
			    	<select name="cuenta" class="form-control selectpicker" data-live-search="true">
			    		<?php $__currentLoopData = $ctabanco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    			<option value="<?php echo e($c->co_banco); ?>-<?php echo e($c->num_cuenta); ?>"><?php echo e($c->co_banco); ?>-<?php echo e($c->num_cuenta); ?></option>
			    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    	</select>
			    </div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Fecha</label>
					<input type="date" value="<?php echo e(date('Y-m-d')); ?>" name="fecha" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Monto</label>
					<input type="text" name="monto" id="idmonto" style="text-align: right;" class="form-control">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Modo</label>
					<select name="modo" class="form-control" >
						<option value="TOTAL" selected="">TOTAL</option>
						<option value="ABONO">ABONO</option>
					</select>
				</div>
			</div>

			<input hidden type="text" name="cheque">
			<!--
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Cheque</label>
					<input type="text" name="cheque" class="form-control">
				</div>
			</div>
			-->

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="form-group">
					<label>Banco emisor</label>
					<select name="banco" class="form-control" >
						<option value="" selected=""></option>
						<option value="100% Banco">100% Banco</option>
						<option value="Bancaribe">Bancaribe</option>
						<option value="Banco Activo">Banco Activo</option>
						<option value="Banco Bicentenario">Banco Bicentenario</option>
						<option value="Banco Caroni">Banco Caroni</option>
						<option value="Banco de Venezuela">Banco de Venezuela</option>
						<option value="Banco del Tesoro">Banco del Tesoro</option>
						<option value="Banco del Sur">Banco del Sur</option>
						<option value="Banco Exterior">Banco Exterior</option>
						<option value="Banco Fondo Comun">Banco Fondo Comun</option>
						<option value="Banco Mercantil">Banco Mercantil</option>
						<option value="Banco Nacional de Credito">Banco Nacional de Credito</option>
						<option value="BOD">BOD</option>
						<option value="Banco Provincial">Banco Provincial</option>
						<option value="Banco Sofitasa">Banco Sofitasa</option>
						<option value="Bancrecer">Bancrecer</option>
						<option value="Banesco">Banesco</option>
						<option value="Banplus">Banplus</option>
						<option value="Otro">Otro</option>
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer" style="margin-right: 20px;">
			<button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
			<button type="submit" class="btn-confirmar btnAccion">Confirmar</button>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

</div>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pago/pagren.blade.php ENDPATH**/ ?>