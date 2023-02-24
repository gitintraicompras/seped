
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">

	<!-- ENCABEZADO -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if($cfg->modoVisual=="1"): ?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->factnum); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fec.Factura:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecfact))); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon">Enviado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecenviado))); ?>" style="color:#000000; background: #F7F7F7;" >     

                    <span class="input-group-addon" style="border:0px; "></span>     
                    <span class="input-group-addon">Procesado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))); ?>" style="color: #000000; background: #F7F7F7;">           

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Origen:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($tabla->origen); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Usuario:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($tabla->usuario); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon hidden-xs">Estado:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">renglones:</span>
                    <input id="idrenglon" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Unidades:</span>
                    <input id="idunidad" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" type="text" class="form-control" value="<?php echo e($tabla->observacion); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($cfg->modoVisual=="2"): ?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->factnum); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fec.Factura:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecfact))); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon hidden-xs">Estado:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">renglones:</span>
                    <input id="idrenglon" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Unidades:</span>
                    <input id="idunidad" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" type="text" class="form-control" value="<?php echo e($tabla->observacion); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($cfg->modoVisual=="3"): ?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->factnum); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" type="text" class="form-control" value="<?php echo e($tabla->observacion); ?>" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

	<!-- LINEA 1 -> BOTON ENVIAR/REGRESAR -->
	<div class="row" style="margin-top: 4px; margin-bottom: 4px;">
		
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" >

			<!-- ENVIAR RECLAMO -->
			<a href="" data-target="#modal-enviar-<?php echo e($tabla->id); ?>" data-toggle="modal">
				<button class="btn-normal" data-toggle="tooltip" title="Enviar reclamo">Enviar</button>
			</a>
			<?php echo $__env->make('seped.reclamo.enviar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

		</div>
    </div>

	<!-- TABLA -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
					<thead class="colorTitulo">
						<th>#</th>
						<th>DESCRIPCION</th>
						<th class="hidden-xs">CODIGO</th>
						<th>CANTIDAD</th>
						<th>PRECIO</th>
						<th style="width: 150px;">MOTIVO</th>
						<th style="width: 110px;">RECLAMO</th>
						<th style="display:none;">ITEM</th>
					</thead>
					<?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($loop->iteration); ?></td>
						<td><?php echo e($t->desprod); ?></td>
						<td class="hidden-xs"><?php echo e($t->codprod); ?></td>
						<td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
						<td align="right"><?php echo e(number_format($t->precio, 2, '.', ',')); ?></td>
						<td>
                            <?php if($t->indevolutivo == 1): ?>
                                <option value="">
                                    <?php echo e('INDEVOLUTIVO'); ?>

                                </option>
                            <?php else: ?>
     							<!-- MODIFICAR MOTIVO -->
                                <select style="width: 150px;" name="motivo_<?php echo e($t->item); ?>" id="idmotivo_<?php echo e($t->item); ?>" class="form-control ">

                                    <?php $__currentLoopData = $recmotivo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($t->motivo == $rm->motivo): ?> selected <?php endif; ?>
                                            value="<?php echo e($rm->motivo); ?>">
                                            <?php echo e($rm->motivo); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            

    					    	</select>
                            <?php endif; ?>
                        </td>
						<td>
                            <?php if($t->indevolutivo == 0): ?>
    						    <!-- MODIFICAR CANTIDAD DEL RECLAMO -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group" id="idModificar_<?php echo e($t->item); ?>" >
                                    <input style="width: 60px; text-align: center; color: #000000" id="idcantrec_<?php echo e($t->item); ?>" value="<?php echo e(number_format($t->cantrec, 0, '.', ',')); ?>" class="form-control" >

                                    <span class="input-group-btn BtnModificar" >
                                        <button type="button" class="btn btn-default btn-pedido" id="idmodificar_<?php echo e($t->item); ?>_<?php echo e($t->precio); ?>_<?php echo e($t->cantidad); ?>_<?php echo e($t->desprod); ?>_<?php echo e($t->codprod); ?>" data-toggle="tooltip" title="Modificar cantidad">
                                        <span class="fa fa-check" id="idmodificar_<?php echo e($t->item); ?>_<?php echo e($t->precio); ?>_<?php echo e($t->cantidad); ?>_<?php echo e($t->desprod); ?>_<?php echo e($t->codprod); ?>" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td style="display:none;" id="iditem_<?php echo e($t->item); ?>" align="right"><?php echo e($t->item); ?></td>
           			</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
			</div>
		</div>
	</div>

	<?php if($tabla2->count() > 10): ?>
	<!-- LINEA 2 -> BOTON ENVIAR/REGRESAR -->
	<div class="row" style="margin-top: 4px; margin-bottom: 4px;">
		
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" >

			<!-- ENVIAR RECLAMO -->
			<a href="" data-target="#modal-enviar-<?php echo e($tabla->id); ?>" data-toggle="modal">
				<button class="btn-normal" data-toggle="tooltip" title="Enviar reclamo">Enviar</button>
			</a>
			<?php echo $__env->make('seped.reclamo.enviar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

		</div>
    </div>
    <?php endif; ?>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
window.onload = function() {
  
   	$('.BtnModificar').on('click',function(e){
        var id = e.target.id.split('_');
        var item = id[1];
        var precio = id[2];
        var cantidad = id[3];
        var desprod = id[4];
        var codprod = id[5];
        var cantrec = $('#idcantrec_'+item).val();
        var idreclamo = '<?php echo e($tabla->id); ?>';
        var motivo = $('#idmotivo_'+item).val();
        var obs = $('#idobs').val();
        var subtitulo = '<?php echo e($subtitulo); ?>';
        if (subtitulo == "RECLAMO NUEVO") {
	        $.ajax({
	            type:'POST',
	            url:'../seped/reclamo/modificar',
	            dataType: 'json', 
	            encode  : true,
	            data: {item : item, cantidad : cantidad, precio : precio, cantrec : cantrec, motivo : motivo, idreclamo : idreclamo, obs : obs, desprod : desprod, codprod : codprod },
	            success:function(data){
	            	if (data.msg != null)
	                {
	                	refrescar();
	           			if (data.msg == '-1') {
		       	    		alert("RENGLON ELIMINADO");
	                	}
	                	if (data.msg > '0') {
	                		alert("RENGLON AGREGADO");
	                	}
	             	}
	           }
	        });
    	}
    	else {
    	   	$.ajax({
	            type:'POST',
	            url:'../modificar',
	            dataType: 'json', 
	            encode  : true,
	            data: {item : item, cantidad : cantidad, precio : precio, cantrec : cantrec, motivo : motivo, idreclamo : idreclamo, obs : obs, desprod : desprod, codprod : codprod },
	            success:function(data){
	            	if (data.msg != null)
	                {
	 	       			if (data.msg == '-1') {
		       				// MOTIVO RECLAMO
	  						$('#idmotivo_'+item).val('');
 	                		alert("ITEM ELIMINADO");
	                	}
	                	if (data.msg > '0') {
	                		alert("ITEM AGREGADO");
	                	}
	                	if (data.msg == '0') {
	                		$('#idcantrec_'+item).val('');
	                		alert("CANTIDAD RECLAMO MAYOR > CANTIDAD FACTURADO");
	                	}
	                	if (data.msg == '-2') {
	                		$('#idcantrec_'+item).val('');
	                		alert("DEBE SELECCIONAR EL MOTIVO");
	                	}
	                	refrescar();
	             	}
	           }
	        });	
    	}
    });

  	refrescar();
}
function refrescar(){
	var tableReg = document.getElementById('idtabla');
    var monto = 0.00;
    var renglon = 0;
    var unidad = 0;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

		// CODIGO ITEM
        var item = cellsOfRow[7].innerHTML;

        // MOTIVO RECLAMO
	  	var sMotivo = $('#idmotivo_'+item).val();
 	
        if (sMotivo != '') {
  	        // CANTIDAD RECLAMO
		  	var subcantrec = $('#idcantrec_'+item).val();
	        unidad += parseFloat(subcantrec);

	        if (sMotivo != 'SOBRANTE') {
	            // PRECIO
	            var s1 = cellsOfRow[4].innerHTML;
	            var s2 = s1.replace(/,/g, '');
	            var submonto = parseFloat(s2).toFixed(2);
	            monto += (parseFloat(submonto) * parseFloat(subcantrec)) * (-1)
	        }

	        // CANTIDAD DE RENGLONES DEL RECLAMO
	        renglon++;
    	}
    }
    $("#idmonto").val(number_format(monto, 2, '.', ','));
    $("#idrenglon").val(number_format(renglon, 0, '.', ','));
    $("#idunidad").val(number_format(unidad, 0, '.', ','));
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/reclamo/edit.blade.php ENDPATH**/ ?>