
<?php $__env->startSection('contenido'); ?>

<?php echo Form::open(array('url'=>'/seped/notiservidor','method'=>'POST','autocomplete'=>'off')); ?>

<?php echo e(Form::token()); ?>


<div class="row">
    <input type="text" hidden="" name="remite" value="<?php echo e($cfg->codisb); ?>" >
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo" class="form-control">
                <option value="INFO" selected>INFO</option>
                <option value="URGENTE">URGENTE</option>
                <option value="COBRANZA">COBRANZA</option>
                <option value="PFA">PFA</option>
                <option value="OTRO">OTRO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        <div class="form-group">
            <label>Remite</label>
            <input readonly="" type="text" class="form-control" value="<?php echo e($cfg->codisb); ?> <?php echo e($cfg->nombre); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>
    
    <div class="col-xs-12">
        <div class="form-group">
            <label>Asunto</label>
            <textarea type="text" name="asunto" rows="5" style="width: 100%;"></textarea>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
            <div class="btn-group" role="group" style="width: 100%;">
                <div class="input-group md-form form-sm form-2 pl-0" style="width: 15%; margin-right: 3px;">
                    <span class="input-group-btn">
                        <button disabled="" class="btn btn-buscar" data-toggle="tooltip" title="Buscar cliente">
                            <span class="fa fa-search" aria-hidden="true"></span>
                        </button>
                    </span>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar" style="height: 34px;">
                </div>
                <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
                <button class="btn-confirmar" type="submit">Enviar</button>
            </div>
        </div>
    </div>

    
</div>

<div class="table-responsive">
    <table id='myTable' class="table table-striped table-bordered table-condensed table-hover">
        <thead class="colorTitulo">
            <th style="width: 20px">#</th>
            <th>
                <center><input type="checkbox" id="selectall"></center>
            </th>
            <th style="width: 10%">CODIGO</th>
            <th style="width: 85%">DESTINO</th>
        </thead>
      
        <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>

        
            <td style="padding-top: 5px;">
                <span>
                <center><input name='destino[]' class="case" type="checkbox" value="<?php echo e($t->codcli); ?>" /></center>
                </span>
            </td>
            <td>
                <?php echo e($t->codcli); ?>

            </td>
            <td><?php echo e($t->nombre); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
    </table>
</div>

<?php echo e(Form::close()); ?>



<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, j, visible;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no s??lo la primera */
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
// add multiple select/unselect functionality
$("#selectall").on("click", function() {
  $(".case").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".case").on("click", function() {
  if ($(".case").length == $(".case:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/notiservidor/create.blade.php ENDPATH**/ ?>