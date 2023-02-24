
<?php $__env->startSection('contenido'); ?>
  
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.caracteristica.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<a href="<?php echo e(url('/seped/caracteristica?activa=1')); ?>">
			<i class="fa fa-check">
            	Mostrar solo productos con caracteristicas extendidas
            </i>
		</a>
	</div>
</div>
 
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					<th>PRODUCTO</th>
					<th style="width:120px;">CODIGO</th>
					<th title="Existencia real">EXISTENCIA</th>
					<th style="width:140px;" title="Unidad minima de facturación">UND. MINIMA</th>
					<th style="width:140px;" title="Unidad maxima de facturación">UND. MAXIMA</th>
					<th style="width:140px;" title="Unidad multiplos de facturación">UND.MULTIPLO</th>
					<th style="width:140px;" title="Existencia a publicar">EXIT.PUBLICAR</th>
					<th style="width:150px;" title="Clases de Producto">CLASE</th>
					<th style="width:180px;" title="Forzar fecha ultimas entradas">ENTRADAS RECIENTES</th>
					<th style="width:100px;" title="Producto no tiene devoculución">INDEVOLUTIVO</th>
					<th style="width:100px;" title="Producto en cuarentena">CUARENTENA</th>
					<th style="width:100px;" title="Producto psicotropico">PSICOTROPICO</th>
					<th style="width:100px;" title="Producto psicotropico">REFRIGERADO</th>
				</thead>
				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($loop->iteration); ?></td>
					<td>
						<b><?php echo e($t->desprod); ?></b>
					</td>
					<td><?php echo e($t->codprod); ?></td>
					<td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmin_<?php echo e($t->codprod); ?>" style="text-align: center; color: #000000; width: 90px;" value="<?php echo e($t->undmin); ?>" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_<?php echo e($t->codprod); ?>_<?php echo e('undmin'); ?>" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad minima" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_<?php echo e($t->codprod); ?>_<?php echo e('undmin'); ?>">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmax_<?php echo e($t->codprod); ?>" style="text-align: center; color: #000000; width: 90px;" value="<?php echo e($t->undmax); ?>" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_<?php echo e($t->codprod); ?>_<?php echo e('undmax'); ?>" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad maxima" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_<?php echo e($t->codprod); ?>_<?php echo e('undmax'); ?>">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmultiplo_<?php echo e($t->codprod); ?>" style="text-align: center; color: #000000; width: 90px;" value="<?php echo e($t->undmultiplo); ?>" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_<?php echo e($t->codprod); ?>_<?php echo e('undmultiplo'); ?>" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad multiplos" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_<?php echo e($t->codprod); ?>_<?php echo e('undmultiplo'); ?>">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idcantpub_<?php echo e($t->codprod); ?>" style="text-align: center; color: #000000; width: 120px;" value="<?php echo e($t->cantpub); ?>" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_<?php echo e($t->codprod); ?>_<?php echo e('cantpub'); ?>" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad a publicar" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_<?php echo e($t->codprod); ?>_<?php echo e('cantpub'); ?>">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

	   				<td>
						<div class="col-xs-12 input-group" >
						    <select id="idclase_<?php echo e($t->codprod); ?>" style="width: 120px;" class="form-control">
					    		<option value="NORMAL" 
					    		<?php if($t->clase == 'NORMAL'): ?> selected <?php endif; ?> >NORMAL
					    		</option>
					    		
					    		<option value="DESTACADO"  
					    		<?php if($t->clase == 'DESTACADO'): ?> selected <?php endif; ?> >DESTACADO
					    		</option>
					    		
					    		<option value="NUEVO" 
					    		<?php if($t->clase == 'NUEVO'): ?> selected <?php endif; ?>>NUEVO
					    		</option>

					    		<option value="INTERNO"
					    		<?php if($t->clase == 'INTERNO'): ?> selected <?php endif; ?>>INTERNO
					    		</option>
					    	</select>

						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idclase1_<?php echo e($t->codprod); ?>_clase" type="button" class="btn btn-pedido" data-toggle="tooltip"  >
						            <span id="idclase2_<?php echo e($t->codprod); ?>_clase" class="fa fa-check" aria-hidden="true">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idfechafalla_<?php echo e($t->codprod); ?>" style="text-align: center; color: #000000; width: 160px;" value="<?php echo e(date('Y-m-d', strtotime($t->fechafalla))); ?>" class="form-control" type="date" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_<?php echo e($t->codprod); ?>_<?php echo e('fechafalla'); ?>" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar ultima fecha de entrada" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_<?php echo e($t->codprod); ?>_<?php echo e('fechafalla'); ?>">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						<?php if($t->indevolutivo==0): ?>
						    <input type="checkbox" id="idindevolutivo_<?php echo e($t->codprod); ?>_indevolutivo"  />
						<?php else: ?>
							<input type="checkbox" id="idindevolutivo_<?php echo e($t->codprod); ?>_indevolutivo" checked />
						<?php endif; ?>
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						<?php if($t->cuarentena==0): ?>
						    <input type="checkbox" id="idcuarentena_<?php echo e($t->codprod); ?>_cuarentena"  />
						<?php else: ?>
							<input type="checkbox" id="idcuarentena_<?php echo e($t->codprod); ?>_cuarentena" checked />
						<?php endif; ?>
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						<?php if($t->psicotropico==0): ?>
						    <input type="checkbox" id="idpsicotropico_<?php echo e($t->codprod); ?>_psicotropico"  />
						<?php else: ?>
							<input type="checkbox" id="idpsicotropico_<?php echo e($t->codprod); ?>_psicotropico" checked />
						<?php endif; ?>
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						<?php if($t->refrigerado==0): ?>
						    <input type="checkbox" id="idrefrigerado_<?php echo e($t->codprod); ?>_refrigerado"  />
						<?php else: ?>
							<input type="checkbox" id="idrefrigerado_<?php echo e($t->codprod); ?>_refrigerado" checked />
						<?php endif; ?>
						</center>
						</span>
					</td>

				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
			<div align='right'>
				<?php echo e($tabla->render()); ?>

			</div><br>
		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

function tdclick(e) {
    var id = e.target.id.split('_');
    var codprod = id[1];
    var campo = id[2];

    var unidades = $('#idundmin_'+codprod).val();
    if (campo == 'undmin') {
    	unidades = $('#idundmin_'+codprod).val();
    	unidades = (unidades <= 0) ? 1 : unidades;
    }
    if (campo == 'undmax') {
    	unidades = $('#idundmax_'+codprod).val();
    	unidades = (unidades == 0) ? 99999999 : unidades;
    }
    if (campo == 'undmultiplo') {
    	unidades = $('#idundmultiplo_'+codprod).val();
    	unidades = (unidades <= 1 ) ? 0 : unidades;
    }
  	if (campo == 'cantpub') {
    	unidades = $('#idcantpub_'+codprod).val();
    	unidades = (unidades < 0 ) ? 0 : unidades;
  	}
    if (campo == 'clase') {
    	unidades = $('#idclase_'+codprod).val();
    }
    if (campo == 'fechafalla') {
    	unidades = $('#idfechafalla_'+codprod).val();
    }

    //alert('campo: ' + campo + ' valor: ' + unidades);

    $.ajax({
	  type:'POST',
	  url:'./caracteristica/modcaract',
	  dataType: 'json', 
	  encode  : true,
	  data: {codprod : codprod, unidades : unidades, campo : campo },
	  success:function(data) {
	    if (data.msg != "") {
	        alert(data.msg);
	    } 
	  }
  	});
}

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/caracteristica/index.blade.php ENDPATH**/ ?>