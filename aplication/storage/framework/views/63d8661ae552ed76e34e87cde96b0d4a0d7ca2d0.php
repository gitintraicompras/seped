
<?php $__env->startSection('contenido'); ?>

<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li <?php if($tab=="1"): ?> class="active" <?php endif; ?>>
	          	<a href="#tab_1" data-toggle="tab">
	          		BANDEJA SALIDA (<?php echo e(number_format($contSalidas, 0, '.', ',')); ?>)
	          	</a>
	          </li>
	          <li <?php if($tab=="2"): ?> class="active" <?php endif; ?>>
	          	<a href="#tab_2" data-toggle="tab">
	          		BANDEJA ENTRADAS (<?php echo e(number_format($contEntradas, 0, '.', ',')); ?>)
	          	</a>
	          </li>
	          <li class="pull-right"><a href="<?php echo e(url('/home')); ?>" class="text-muted"><i class="fa fa-gear"></i></a></li>
	        </ul>
	        <div class="tab-content">
	          	<div <?php if($tab=="1"): ?> class="tab-pane active" <?php else: ?> class="tab-pane" <?php endif; ?> id="tab_1">
 					<div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
			            <div class="btn-group" role="group" style="width: 100%;">
			                <div class="input-group md-form form-sm form-2 pl-0" style="width: 15%; margin-right: 3px;">
			                    <span class="input-group-btn">
			                        <button disabled="" class="btn btn-buscar" data-toggle="tooltip" title="Buscar cliente">
			                            <span class="fa fa-search" aria-hidden="true"></span>
			                        </button>
			                    </span>
			                    <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Buscar" style="height: 34px;">
			                </div>
			                &nbsp;&nbsp;
							<a href="<?php echo e(url('/seped/notiservidor/create')); ?>" title="Crear notificación nueva">
							    <i class="fa fa-file-o" style="margin-top: 15px;">
							    	Notificaciún nueva
								</i> 
							</a>
							<?php if(Auth::user()->tipo == "A" || Auth::user()->tipo == "S"): ?>
							&nbsp;&nbsp;
						    <?php echo $__env->make('seped.notiservidor.confirmar', array('metodo'=>'borrar','mensaje'=>'BORRAR TODAS LAS NOTIFICACIONES'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	        				<a href="" data-target="#modal-confirmar-borrar" data-toggle="modal">
								<i class="fa fa-trash-o">
					            	Borrar todas las notificaciones
					            </i>
							</a>
					        <?php endif; ?>
			            </div>
			        </div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="myTable1" class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width:30px;">ID</th>
										<th style="width:100px;">OPCION</th>
										<th style="width:70px;">REMITE</th>
										<th>ASUNTO</th>
										<th style="width:20px;">TIPO</th>
										<th style="width:100px;">ENVIADO</th>
									</thead>
									<?php $__currentLoopData = $notisalidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($t->id); ?></td>
										<td>
											<a href="<?php echo e(URL::action('AdnotiServidorController@show',$t->id)); ?>"><button style="height: 35px;" class="btn btn-default btn-pedido fa fa-file-o" title="Consultar notificaciún">
											</button>
											</a>
											<?php if(Auth::user()->tipo == "A" || Auth::user()->tipo == "S"): ?>
											<a href="" data-target="#modal-delete-<?php echo e($t->id); ?>" data-toggle="modal">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar notificaciún">
												</button>
											</a>
											<?php endif; ?>
										</td>
										<td>
											<?php echo e($t->remite); ?>

										</td>
										<td>
											<?php echo e($t->asunto); ?>

										</td>
										<td>
											<?php echo e($t->tipo); ?>

										</td>
										<td>
											<?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?>

										</td>
									</tr>
									<?php echo $__env->make('seped.notiservidor.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</table><br>
							</div>
						</div>
					</div>
			  	</div>
		        <div <?php if($tab=="2"): ?> class="tab-pane active" <?php else: ?> class="tab-pane" <?php endif; ?> id="tab_2">
		        	<div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
			            <div class="btn-group" role="group" style="width: 100%;">
			                <div class="input-group md-form form-sm form-2 pl-0" style="width: 15%; margin-right: 3px;">
			                    <span class="input-group-btn">
			                        <button disabled="" class="btn btn-buscar" data-toggle="tooltip" title="Buscar cliente">
			                            <span class="fa fa-search" aria-hidden="true"></span>
			                        </button>
			                    </span>
			                    <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Buscar" style="height: 34px;">
			                </div>
			                &nbsp;&nbsp;
			  			    <?php echo $__env->make('seped.notiservidor.confirmar', array('metodo'=>'leido','mensaje'=>'MARCAR TODAS LAS NOTIFICACIONES COMO LEIDAS'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	        				<a href="" data-target="#modal-confirmar-leido" data-toggle="modal">
								<i class="fa fa-check-square-o" style="margin-top: 15px;">
					            	Marcar todas las notificaciones como leidas
					            </i>
							</a>
						    <?php if(Auth::user()->tipo == "A" || Auth::user()->tipo == "S"): ?>
						    &nbsp;&nbsp;
						    <?php echo $__env->make('seped.notiservidor.confirmar', array('metodo'=>'borrar2','mensaje'=>'BORRAR TODAS LAS NOTIFICACIONES'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	        				<a href="" data-target="#modal-confirmar-borrar2" data-toggle="modal">
								<i class="fa fa-trash-o">
					            	Borrar todas las notificaciones
					            </i>
							</a>
					        <?php endif; ?>
			            </div>
			        </div>
		        	<div class="row" style="margin-top: 10px;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="myTable2" class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width: 30px;">ID</th>
										<th style="width: 30px;">ITEM</th>
										<th style="width: 60px;" title="Marcar como leido">LEIDO</th>
										<th style="width: 100px;">OPCION</th>
										<th style="width: 200px;">REMITE</th>
										<th>ASUNTO</th>
										<th>TIPO</th>
										<th>ENVIADO</th>
										<th>RECIBIDO</th>
									</thead>
									<?php $__currentLoopData = $notientradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($t->id); ?></td>
										<td><?php echo e($t->item); ?></td>
										<td style="padding-top: 10px;">
											<?php if($t->envio > 0): ?>
												<span onclick='tdclick(event);' >
												<center>
											    <input type="checkbox" id="idalerta_<?php echo e($t->item); ?>"  />
						                    	</center>
												</span>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo e(URL::action('AdnotiServidorController@show2',$t->item)); ?>">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-file-o" title="Consultar notificaciún">
												</button>
											</a>
											<?php if(Auth::user()->tipo == "A" || Auth::user()->tipo == "S"): ?>
											<a href="" data-target="#modal-delete2-<?php echo e($t->item); ?>" data-toggle="modal">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar notificaciún">
												</button>
											</a>
											<?php endif; ?>
										</td>
										<td>
											<?php if($t->envio > 0): ?>
												<b><?php echo e($t->remite); ?> <?php echo e($t->nombre); ?></b>
											<?php else: ?>
												<?php echo e($t->remite); ?> <?php echo e($t->nombre); ?>

											<?php endif; ?>
										</td>
										<td>
											<?php if($t->envio > 0): ?>
												<b><?php echo e($t->asunto); ?></b>
											<?php else: ?>
												<?php echo e($t->asunto); ?>

											<?php endif; ?>
										</td>
										<td>
											<?php if($t->envio > 0): ?>
												<b><?php echo e($t->tiponoti); ?></b>
											<?php else: ?>
												<?php echo e($t->tiponoti); ?>

											<?php endif; ?>
										</td>
										<td>
											<?php if($t->envio > 0): ?>
												<b><?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaenvio))); ?></b>
											<?php else: ?>
												<?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaenvio))); ?>

											<?php endif; ?>
										</td>
										<td>
											<?php if($t->envio > 0): ?>
												<b><?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaleido))); ?></b>
											<?php else: ?>
												<?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaleido))); ?>

											<?php endif; ?>
										</td>
									</tr>
									<?php echo $__env->make('seped.notiservidor.delete2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

function tdclick(e) {
    var valor = e.target.id.split('_');
    var item = valor[1];
    $.ajax({
	  type:'POST',
	  url:'./notiservidor/modleido',
	  dataType: 'json', 
	  encode  : true,
	  data: {item : item },
	  success:function(data) {
	    //location.reload(true); 
	    var url = "<?php echo e(url('/seped/notiservidor?tab=2')); ?>";
		window.location.href=url;
	  }
  	});
}

function myFunction1() {
  // Declare variables 
  var input, filter, table, tr, td, i, j, visible;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no sólo la primera */
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        visible = true;
      }
    }
    if (visible === true) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
function myFunction2() {
  // Declare variables 
  var input, filter, table, tr, td, i, j, visible;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no sólo la primera */
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        visible = true;
      }
    }
    if (visible === true) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}


</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/notiservidor/index.blade.php ENDPATH**/ ?>