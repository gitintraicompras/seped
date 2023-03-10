
<?php $__env->startSection('contenido'); ?>

<input hidden id="idforma" type="text" value="<?php echo e($forma); ?>">

<!-- ENCABEZADO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if($cfg->modoVisual=="1"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->estado); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Enviado:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecenviado))); ?>" style="color:#000000; background: #F7F7F7;" >                  
                
                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Procesado:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecprocesado))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Origen:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->origen); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Usuario:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->usuario); ?>" style="color: #000000; background: #F7F7F7;">

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observaci??n:</span>
                <input id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if($cfg->modoVisual=="2"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->estado); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observaci??n:</span>
                <input id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if($cfg->modoVisual=="3"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observaci??n:</span>
                <input id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row" >

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
		<!-- ENVIA PAGO-->
	    <?php echo $__env->make('seped.pago.enviar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<div class="form-group">
			<div class="input-group input-group-sm">
				<span class="input-group-addon hidden-xs">Marcados:</span>
				<input readonly type="text" class="form-control" id="idmarcado" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;" placeholder="Monto total">
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="form-group">
			<div class="input-group input-group-sm">
				<span class="input-group-addon hidden-xs">Total:</span>
				<input readonly type="text" class="form-control" id="idtot" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;" placeholder="Monto total">
			</div>
		</div>
	</div>
</div>

<ul class="nav nav-tabs" >
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#menu1">DOCUMENTOS PENDIENTE</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2">REGISTRAR PAGOS</a>
    </li>
</ul>

<!-- Tab panes -->
<div style="margin-top: 10px;" class="tab-content" >
    <div id="menu1" class="container tab-pane active" style="width: 100%;">
		<div class="row">
			<!-- TABLA DOCUMENTOS PENDIENTES-->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
						<thead class="colorTitulo">
							<th>#</th>
							<th>DOCUMENTO</th>
							<th>TIPO</th>
							<th>FECHA</th>
							<th>MONTO</th>
							<th>SALDO</th>
							<th>OBSERVACION</th>
							<th>SELECCIONAR</th>
						</thead>
						<?php $__currentLoopData = $cxc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($t->numerod); ?></td>
							<td><?php echo e($t->tipocxc); ?></td>
							<td><?php echo e(date('d-m-Y', strtotime($t->fechai))); ?></td>
							<td align="right"><?php echo e(number_format($t->monto, 2, '.', ',')); ?></td>
							<td align="right"><?php echo e(number_format($t->saldo, 2, '.', ',')); ?></td>
							<td><?php echo e($t->notas1); ?></td>
							<td align="center">
							    <!-- SELECCIONAR DOCUMENTO -->
							    <?php $marca = 0; ?>
							    <?php $__currentLoopData = $pagdoc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    	<?php if(trim($pd->coddoc) == trim($t->numerod)): ?>
										<?php $marca = 1; ?>
										<?php break; ?>;
							    	<?php endif; ?>
							    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							    <?php if($marca==0): ?>
								    <input type="checkbox" class="BtnModificar" id="idFila_<?php echo e($loop->iteration); ?>_<?php echo e($pago->id); ?>" />
								<?php else: ?>
									<input type="checkbox" class="BtnModificar" id="idFila_<?php echo e($loop->iteration); ?>_<?php echo e($pago->id); ?>" checked />
								<?php endif; ?>
					        </td>
			         	</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div id="menu2" class="container tab-pane fade" style="width: 100%;">

		<div class="row">
            <?php echo $__env->make('seped.pago.pagren', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>

       	<div class="row">
       		<!-- TABLA PAGOS ENGLON-->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table id="idtabla2" class="table table-striped table-bordered table-condensed table-hover">
		                <thead class="colorTitulo">
		                 	<th style="width:60px;">OPCION</th>
		                    <th>ITEM</th>
		                    <th>REFERENCIA</th>
		                    <th>CUENTA</th>
		                    <th>FECHA</th>
		                    <th>MONTO</th>
		                    <th>MODO</th>
		                    <th>CHEQUE</th>
		                    <th>BANCO</th>
		                </thead>

			            <?php $__currentLoopData = $pagren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                  	<td>
	                            <!-- ELIMINAR PAGO RENGLON -->
	                            <a href="" data-target="#modal-delete-<?php echo e($t->item); ?>" data-toggle="modal">
	                                <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar Pago renglon"></button>
	                            </a>
		                	</td>
		                    <td><?php echo e($t->item); ?></td>
		                    <td><?php echo e($t->referencia); ?></td>
		                    <td><?php echo e($t->cuenta); ?></td>
		                    <td><?php echo e(date('d-m-Y', strtotime($t->fecha))); ?></td>
		                    <td align="right"><?php echo e(number_format($t->monto, 2, '.', ',')); ?></td>
		                    <td><?php echo e($t->modo); ?></td>
		                    <td><?php echo e($t->cheque); ?></td>
		                    <td><?php echo e($t->banco); ?></td>
		                </tr>
		                <?php echo $__env->make('seped.pago.delpagren', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		            </table><br>
		        </div>
			</div>
       	</div>
   	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

var forma = document.getElementById("idforma").value;
window.onload = function(){
	var tableReg = document.getElementById('idtabla');
    var tot = 0.00;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var s1 = cellsOfRow[5].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var inv = parseFloat(s2).toFixed(2);
        tot += parseFloat(inv);
    }
    $("#idtot").val(number_format(tot, 2, '.', ','));
	SumarMarcados();

	var tableReg = document.getElementById('idtabla2');
    var tot = 0.00;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var s1 = cellsOfRow[5].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var inv = parseFloat(s2).toFixed(2);
        tot += parseFloat(inv);
    }
    $("#idtotalpago").val(number_format(tot, 2, '.', ','));
}

$('.BtnModificar').on('click',function(e){
	var s1 = e.target.id.split('_');
    var id = s1[2];
   	var tableReg = document.getElementById('idtabla');
	var url = './limpiarpagdoc';
	if (forma=='M') {
		url = '../limpiarpagdoc';
	}
 	$.ajax({
	    type: "POST", 
	    url: url,
	    data: { id : id },
	    dataType: "json",
	    success: function (data) {
	        var iFila = 0;
	        var url = './insertpagdoc';
			if (forma=='M') {
				url = '../insertpagdoc';
			}
		 	$('#idtabla').find('tr').each(function () {
		        var row = $(this);
		        if (row.find('input[type="checkbox"]').is(':checked'))  {
		        	cellsOfRow = tableReg.rows[iFila].getElementsByTagName('td');
	        	    var coddoc = cellsOfRow[1].innerHTML;
	        	    coddoc = coddoc.trim();
			        var tipo = cellsOfRow[2].innerHTML;
					var fecha = cellsOfRow[3].innerHTML;
					var monto = parseFloat(cellsOfRow[4].innerHTML.replace(/,/g, '')).toFixed(2);
					var saldo = parseFloat(cellsOfRow[5].innerHTML.replace(/,/g, '')).toFixed(2);
					$.ajax({
					    type: "POST", 
					    url: url,
					    data: { id : id, coddoc : coddoc, tipo : tipo, fecha : fecha, vence : fecha, monto : monto, saldo : saldo },
					    dataType: "json",
					    success: function (data) {
					    },
					    failure: function (data) {
					        alert("Error: Intente nuevamente ");
					    }
					});
		        }
		        iFila++;
		    });
		    SumarMarcados();
	    },
	    failure: function (data) {
	        alert("Error: Intente nuevamente ");
	    }
	});
});

function SumarMarcados() { 
	var marcado = 0.00;
    var iFila = 0;
   	var tableReg = document.getElementById('idtabla');
 	$('#idtabla').find('tr').each(function () {
        var row = $(this);
        if (row.find('input[type="checkbox"]').is(':checked'))  {
        	cellsOfRow = tableReg.rows[iFila].getElementsByTagName('td');
    		var s1 = cellsOfRow[5].innerHTML;
    		var s2 = s1.replace(/,/g, '');
	        var inv = parseFloat(s2).toFixed(2);
	        marcado += parseFloat(inv);
        }
        iFila++;
    });
	$("#idmarcado").val(number_format(marcado, 2, '.', ','));   
	$("#idmonto").val(number_format(marcado, 2, '.', ','));
}

$(document).keypress(function(e) {
   if(e.which == 13) {
 		var obs = document.getElementById('idobs').value;
		var id = document.getElementById("id").value;
		var url = './updateobs';
		if (forma=='M') {
			url = '../updateobs';
		}

		$.ajax({
		    type: "POST", 
		    url: url,
		    data: { id : id, obs : obs },
		    dataType: "json",
		    success: function (data) {
		    },
		    failure: function (data) {
		        alert("Error: Intente nuevamente ");
		    }
		});
   }
});

</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pago/create.blade.php ENDPATH**/ ?>