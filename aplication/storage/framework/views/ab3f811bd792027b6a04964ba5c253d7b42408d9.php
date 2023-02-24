
<?php $__env->startSection('contenido'); ?>

<?php echo Form::open(array('action'=>array('AdpromdiasController@grabar','method'=>'POST','autocomplete'=>'off'))); ?>

<?php echo e(Form::token()); ?>

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label>Id</label>
            <input readonly 
                type="text" 
                class="form-control" 
                name="id" 
                value="<?php echo e($promdias->id); ?>" 
                style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

	<div class="col-xs-8">
		<div class="form-group">
	        <label>Nombre</label>
            <input type="text" 
                class="form-control" 
                name="descrip" 
                value="<?php echo e($promdias->descrip); ?>" >
 	    </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Dias</label>
            <input type="text" 
                class="form-control" 
                name="dias" 
                value="<?php echo e($promdias->dias); ?>" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Desde</label>
            <input type="date" 
                class="form-control" 
                name="desde" 
                value="<?php echo e($promdias->desde); ?>" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Hasta</label>
            <input type="date" 
                class="form-control" 
                name="hasta" 
                value="<?php echo e($promdias->hasta); ?>" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Status</label>
            <select name="estado" class="form-control">
                <option value="ACTIVO" 
                    <?php if($promdias->estado == 'ACTIVO'): ?> selected <?php endif; ?> >
                    ACTIVO
                </option>
                <option value="INACTIVO" 
                    <?php if($promdias->estado == 'INACTIVO'): ?> selected <?php endif; ?>>
                    INACTIVO
                </option>
            </select>
        </div>
    </div>

    <div class="modal-footer" style="margin-right: 20px;">
        <a href="<?php echo e(url('/home')); ?>" class="text-muted">
            <button type="button" class="btn-normal">Regresar</button>
        </a>
        <button type="submit" class="btn-confirmar">Confirmar</button>
    </div>
</div>
<?php echo e(Form::Close()); ?>


<div class="row" style="margin-bottom: 10px;"> 
    <div class="col-xs-12">
    

        <!-- AGREGAR PRODUCTO NUEVO -->
        <a href="" 
            data-target="#modal-agregar-<?php echo e($id); ?>" 
            data-toggle="modal">
            <button style="width: 90px; height: 34px; border-radius: 5px;" 
                type="button" 
                data-toggle="tooltip" 
                title="Agregar producto a la promoción" 
                class="btn-catalogo">
                Agregar
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


    </div>
</div>
<?php echo $__env->make('seped.promdias.agregar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th style="width: 50px;">#</th>
                    <th style="width: 50px;"></th>
                    <th style="width: 50px;">CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>MARCA</th>
                    <th>SUCURSAL</th>
                </thead>
                <?php $__currentLoopData = $promren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <a href="" 
                            data-target="#modal-delete-<?php echo e($pr->id); ?>-<?php echo e($pr->codprod); ?>-<?php echo e($pr->codisb); ?>" 
                            data-toggle="modal">
                            <button 
                                class="btn btn-default btn-pedido fa fa-trash-o" 
                                title="Eliminar producto">
                            </button>
                        </a>
                    </td>
                    <td><?php echo e($pr->codprod); ?></td>
                    <td><?php echo e($pr->desprod); ?></td>
                    <td><?php echo e($pr->marca); ?></td>
                    <td><?php echo e(sLeercfg($pr->codisb, "SedeSucursal")); ?></td>
                </tr>
                <?php echo $__env->make('seped.promdias.delprod', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

function cargarProd() {
    var resp;
    var filtro = $('#idfiltro').val();
    if (filtro == "") {
        alert("FALTAN PARAMETROS PARA REALIZAR LAS BUSQUEDA");
    } else {
        var jqxhr = $.ajax({
            type:'POST',
            url: '../cargarprod',
            dataType: 'json', 
            encode  : true,
            data: { filtro:filtro },

            success:function(data) {
                $("#tbodyProducto").empty();
                $.each(data.resp, function(index, item){
                   var valor = 
                    '<tr>' +
                      "<td style='padding-top: 10px;'>" +
                      "<span onclick='tdclick(event);'>" +
                      "<center>" +
                      "<input name='tdcheck[" + item.codprod + "]' type='checkbox' id='idcheck_" + item.codprod + "' />" +
                      "</center>" +
                      "</span>" +
                      "</td>" +
                      "<td>" + item.desprod + "</td>" +
                      "<td>" + item.codprod + "</td>" +
                      "<td>" + item.barra + "</td>" +
                      "<td>" + item.marcamodelo + "</td>" +
                    "</tr>";
                    $(valor).appendTo("#tbodyProducto");
                });
            }
        });
    }
}

function ejecutarAgregarbORRAR() {

    //$codprod = trim($s1[0]);
    //$desprod = trim($s1[1]);
    //$marca = trim($s1[2]);  

    var id = '<?php echo e($id); ?>';
    var tdcheck = $('#tdcheck').val();

    alert(tdcheck);

    var barra = $('#idcodprod').val();
    var ctipo = id + "_"+ codprod +"_"+ barra;
    alert(ctipo);
    if (codprod == '') {
        alert("FALTAN PARAMETROS PARA AGREGAR UN PRODUCTO");
    } else {
        var url = "<?php echo e(url('/seped/promdias/agregarprod/X')); ?>";
        url = url.replace('X', ctipo);
        window.location.href=url;
    }
}


</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/promdias/edit.blade.php ENDPATH**/ ?>