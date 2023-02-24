
<?php $__env->startSection('contenido'); ?>

<?php echo Form::open(array('url'=>'/seped/usuario','method'=>'POST','autocomplete'=>'off')); ?>

<?php echo e(Form::token()); ?>

<div class="row">
	<?php if(count($errors)>0): ?>
	<div class="alert alert-danger">
		<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	    	<label>Tipo usuario</label>
	    	<select name="tipo" class="form-control" id="SelClickTipo">
				<option value='C' 
                    <?php if($ctipo=='C'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >CLIENTE
                </option>
                <option value='A' 
                    <?php if($ctipo=='A'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >ADMINISTRADOR
                </option>
                <option value='S' 
                    <?php if($ctipo=='S'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >SUPERVISOR
                </option>
                <option value='R' 
                    <?php if($ctipo=='R'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >CREDITO Y COBRANZA
                </option>
                <option value='V' 
                    <?php if($ctipo=='V'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >VENDEDOR
                </option>
                <option value='G' 
                    <?php if($ctipo=='G'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >GRUPO
                </option>
                <option value='P' 
                    <?php if($ctipo=='P'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >PROVEEDOR
                </option>
                <option value='T' 
                    <?php if($ctipo=='T'): ?>
                        selected='selected'
                    <?php endif; ?> 
                    >CHOFERES
                </option>
 	    	</select>
	    </div>
    </div> 

    <?php if($ctipo == "C" || $ctipo == ""): ?>
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    	    <div class="form-group">
    	    	<label for="cliente">Cliente</label>
    	    	<select name="codcli" class="form-control selectpicker" data-live-search="true" id="SelClickCliente">
    	    		<?php $__currentLoopData = $cliente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	    			<option style="width: 520px;" value="<?php echo e($cli->codcli); ?>"><?php echo e($cli->codcli); ?> | <?php echo e($cli->nombre); ?></option>
    	    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	    	</select>
    	    </div>
    	</div>
	<?php endif; ?>
 	<?php if($ctipo == "V"): ?>
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    	    <div class="form-group">
    	    	<label for="cliente">Vendedor</label>
    	    	<select name="codcli" i
                    d="idcodcli" 
                    class="form-control selectpicker" 
                    data-live-search="true">
    	    		<?php $__currentLoopData = $vendedor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ven): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	    			<option style="width: 520px;" 
                            value="<?php echo e($ven->codigo); ?>">
                            <?php echo e($ven->codigo); ?> | <?php echo e($ven->nombre); ?>

                        </option>
    	    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	    	</select>
    	    </div>
    	</div>
	<?php endif; ?>
    <?php if($ctipo == "G"): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select name="codcli" id="idgrupo" class="form-control selectpicker" data-live-search="true">
                    <?php $__currentLoopData = $grupo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option style="width: 520px;" value="<?php echo e($g->id); ?>">
                            <?php echo e($g->id); ?> | <?php echo e($g->nomgrupo); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <?php if($ctipo == "P"): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Proveedor</label>
                <select name="codcli" id="SelClickProveedor" class="form-control selectpicker" data-live-search="true">
                    <?php $__currentLoopData = $marca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option style="width: 520px;" value="<?php echo e($m->codmarca); ?>">
                            <?php echo e($m->codmarca); ?> 
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <?php if($ctipo == "T"): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Choferes</label>
                <select name="codcli" id="idgrupo" class="form-control selectpicker" data-live-search="true">
                    <?php $__currentLoopData = $choferes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option style="width: 520px;" value="<?php echo e($ch->chof_co); ?>">
                            <?php echo e($ch->chof_co); ?> | <?php echo e($ch->chof_nom); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <label for="email">Correo:</label>
            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>
  
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
	        <label for="name">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">
            <?php if($errors->has('name')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                </span>
            <?php endif; ?>
	    </div>
    </div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
	        <label for="password">Clave</label>
            <input id="password" type="password" class="form-control" name="password">
            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
	    </div>
    </div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
	        <label for="password-confirm">Confirmar Clave</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            <?php if($errors->has('password_confirmation')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                </span>
            <?php endif; ?>
	    </div>
    </div>

    <?php if($ctipo == "C" || $ctipo == "P"): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Rif</label>
            <input id="rif" readonly type="text" class="form-control" >
        </div>
    <?php endif; ?>
    <?php if($ctipo == "V"): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group" style="padding-top: 20px;">
                <div class="form-check">
                    <input name="vendsuper" type="checkbox" class="form-check-input" >
                    <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group" style="padding-top: 20px;">
                <div class="form-check">
                    <input name="cambiarNegociacion" type="checkbox" class="form-check-input" >
                    <label class="form-check-label" for="materialUnchecked">Cambiar precios</label>
                </div>
            </div>
        </div>
	<?php endif; ?>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br>
		<div class="form-group">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
			<button class="btn-confirmar" type="submit">Guardar</button>
		</div>
	</div>
</div>
<?php echo e(Form::close()); ?>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

$('#SelClickTipo').on('change', function()
{
    var ctipo = this.value;
  	var url = "<?php echo e(url('/seped/usuario/create?ctipo=X')); ?>";
	url = url.replace('X', ctipo);
	window.location.href=url;
});

$('#SelClickCliente').on('change', function()
{
    var codigo = this.value;
    $.ajax({
        type:'POST',
        url:'../leercorreoclie',
        dataType: 'json', 
        encode  : true,
        data: {codigo : codigo },
        success:function(data) {
            $('#email').val(data.email);
            $('#name').val(data.nombre);
            $('#rif').val(data.rif);
        }
    });
});

$('#SelClickProveedor').on('change', function()
{
    var codigo = this.value;
    $.ajax({
        type:'POST',
        url:'../leercorreoprov',
        dataType: 'json', 
        encode  : true,
        data: { codigo : codigo },
        success:function(data) {
            $('#email').val(data.email);
            $('#name').val(data.nombre);
            $('#rif').val(data.rif);
        }
    });
});

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/usuario/create.blade.php ENDPATH**/ ?>