
<?php $__env->startSection('contenido'); ?>
 
<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>CUENTAS</B></a></li>
	          <li class="pull-right">
	          	<a href="<?php echo e(url('/seped/config')); ?>" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
		          	<div class="row">
		          		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
				        	<div class="table-responsive">
				                <table id="idtablacb" class="table table-striped table-bordered table-condensed table-hover">
				             
					                <thead class="colorTitulo">
					                	<th>CODIGO</th>
					                  	<th>BANCO</th>
					                  	<th>CUENTA BANCARIA</th>
						                <th style="width: 100px;">ACTIVAR</th>
						            </thead>

						            <?php $__currentLoopData = $ctabanco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                <tr>
						                  	<td><?php echo e($cb->co_cta); ?></td>
						                	<td><?php echo e($cb->co_banco); ?></td>
						                	<td><?php echo e($cb->num_cuenta); ?></td>
						                  	<td>
						                  		<?php if($cb->activo==0): ?>
												    <input type="checkbox" class="BtnModcuenta" id="idFilacb_<?php echo e($cb->co_cta); ?>" />
												<?php else: ?>
													<input type="checkbox" class="BtnModcuenta" id="idFilacb_<?php echo e($cb->co_cta); ?>" checked />
												<?php endif; ?>
						                  	</td>
						                </tr>
						            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					            </table><br>
				            </div>
						</div>
		          	</div>
	          	</div>
	        </div>
      	</div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
$('.BtnModcuenta').on('click',function(e) {
	var s1 = e.target.id.split('_');
    var id = s1[1];
	$.ajax({
      type:'POST',
      url:'./modcuenta',
      dataType: 'json', 
      encode  : true,
      data: {id : id },
      success:function(data) {
        if (data.msg != "") {
        	alert(data.msg);
        } 
      }
	});
});


</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/config/cuenta.blade.php ENDPATH**/ ?>