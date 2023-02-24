<?php echo Form::open(array('url'=>'/seped/catalogo/listado/'.$tipo,'method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<?php
if ($tipo=="G") 
	$tipo = 'G_'.$codigo2;
if ($tipo=="M") 
	$tipo = 'M_'.$codigo2;  
?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 input-group md-form form-sm form-2 pl-0" 
	style="margin-right: 3px;">
  <input class="form-control my-0 py-1 red-border" 
  	type="text" name="filtro" 
  	value="<?php echo e($filtro); ?>" 
  	placeholder="Descripción, Código o Referencia" 
  	aria-label="Search">
    <span class="input-group-btn">
        <button type="submit" 
        	class="btn btn-buscar" 
        	data-toggle="tooltip" 
        	title="Buscar producto">
            <span class="fa fa-search" aria-hidden="true"></span>
        </button>
    </span>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/catalogo/catasearch.blade.php ENDPATH**/ ?>