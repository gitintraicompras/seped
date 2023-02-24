<?php echo Form::open(array('action'=>array('AdpromdiasController@agregarprod','method'=>'POST','autocomplete'=>'off'))); ?>

<?php echo e(Form::token()); ?>

<input hidden="" name="id" value="<?php echo e($id); ?>">
<div class="modal fade modal-slide-in-right" 
	aria-hidden="true" 
	role="dialog" tabindex="-1" 
	id="modal-agregar-<?php echo e($id); ?>" >
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="modal-header colorTitulo"  >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">AGREGAR PRODUCTO NUEVO </h4>
			</div>
			<div class="modal-body">
				<div class="input-group md-form form-sm form-2 pl-0" 
				  	style="margin-left: 15px; margin-right: 15px; margin-bottom: 5px;">
			  	    	<input class="form-control my-0 py-1 red-border catserch" 
					    	type="text" 
					    	name="filtro" 
					    	value="<?php echo e($filtro); ?>"
					    	style="margin-top: 25px;" 
					    	placeholder="Buscar por descripción, código, referencia o marca" 
					    	aria-label="Search"
					    	id="idfiltro"
					    	autofocus >
				      	<span class="input-group-btn">
				      	  <a onclick="cargarProd(); return false;" >
					          <button class="btn btn-buscar" 
					          	data-toggle="tooltip" 
					            style="border-radius: 0 5px 5px 0; margin-top: 25px;"
					          	title="Buscar producto">
					              <span class="fa fa-search" aria-hidden="true"></span>
					          </button>
				          </a>
					    </span>
				</div>

				<div class="col-xs-12">
					<div class="table-responsive" 
						style="height: 300px; margin-bottom: 20px;">
						<table id="myTable1" 
			                class="table table-striped table-bordered table-condensed table-hover">
			                <thead style="background-color: #b7b7b7;">
			                	<th>MARCA</th>
			                    <th>PRODUCTO</th>
			                    <th>CODIGO</th>
			                    <th>BARRA</th>
			                    <th>MARCA</th>
			                </thead>
			                <tbody id="tbodyProducto">
	            			</tbody>
				       </table>
			       </div>
		     	</div>
			</div>

			<div class="modal-footer" >
				<div class="col-xs-12">
					<button type="button" 
						class="btn-normal" 
						data-dismiss="modal">
						Regresar
					</button>
				 	<button type="submit" class="btn-confirmar">Confirmar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo e(Form::Close()); ?>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/promdias/agregar.blade.php ENDPATH**/ ?>