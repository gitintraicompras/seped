
<?php $__env->startSection('contenido'); ?>
    
<div id="page-wrapper"> 

	<!-- ENCABEZADO -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php if($cfg->modoVisual=="1"): ?>
		<div class="form-group">
			<div class="row" >
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Estado:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
			      	<span class="input-group-addon hidden-xs">Fecha:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

					<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Enviado:</span>
					<input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecenviado))); ?>" style="color:#000000; background: #F7F7F7;" >		

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="<?php echo e($tabla->numund); ?>" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>	        

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Procesado:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Origen:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->origen); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Usuario:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->usuario); ?>" style="color: #000000; background: #F7F7F7;">

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		<span class="input-group-addon hidden-xs">Descuento:</span>
            		<input readonly type="text" class="form-control hidden-xs" value="<?php echo e(number_format($tabla->descuento, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

            		<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Subtotal:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->subtotal, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    <?php endif; ?>

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon">Total:</span>
					<b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>		        
			    </div>
			</div>
		</div>
		<?php endif; ?>
		<?php if($cfg->modoVisual=="2"): ?>
		<div class="form-group">
			<div class="row">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Estado:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
			      	<span class="input-group-addon hidden-xs">Fecha:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

					<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Enviado:</span>
					<input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecenviado))); ?>" style="color:#000000; background: #F7F7F7;" >		

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="<?php echo e($tabla->numund); ?>" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>	        

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
            		<span class="input-group-addon hidden-xs">Descuento:</span>
            		<input readonly type="text" class="form-control hidden-xs" value="<?php echo e(number_format($tabla->descuento, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

            		<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Subtotal:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->subtotal, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    <?php endif; ?>

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon">Total:</span>
					<b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>		        

			    </div>
			</div>
		</div>
		<?php endif; ?>
		<?php if($cfg->modoVisual=="3"): ?>
		<div class="form-group">
			<div class="row">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon hidden-xs">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    <?php endif; ?>

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Total:</span>
					<b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="<?php echo e($tabla->numund); ?>" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>

			    </div>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<?php if($tabla->estado != "POR-APROBAR"): ?> 
		<!-- BOTONES PRINCIPALES -->
		<div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
		    <div class="btn-group" role="group" style="width: 100%;">

		        <!-- BUSCAR PRODUCTOS EN EL CATALOGO -->
		        <?php echo $__env->make('seped.catalogo.catasearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		        <!-- VER CATALOGO -->
		   	    <a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos " 
		            class="btn-catalogo">
		            Catálogo
		            </button>
		        </a>
		        <?php if($cfg->activarEntradasProducto=="1"): ?>
		        <!-- VER ENTRADAS -->
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','E')); ?>">
		            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos con entradas recientes" 
		            class="btn-catalogo">
		            últ.Entradas
		            </button>
		        </a>
		        <?php endif; ?>
		        <?php if($cfg->activarOfertasProducto=="1"): ?>
		        <!-- VER OFERTAS -->
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','O')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de ofertas de productos" 
		            class="btn-catalogo">
		            Ofertas
		            </button>
		        </a>
		        <?php endif; ?>
		        <?php if($cfg->activarDestacadoProducto=="1"): ?>
		        <!-- VER OFERTAS -->
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos destacados" 
		            class="btn-catalogo">
		            Destacados
		            </button>
		        </a>
		        <?php endif; ?>

		        <?php if($cfg->activarCateProducto=="1"): ?>
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','G')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por categorias" 
		            class="btn-catalogo">
		            Categorias
		            </button>
		        </a>
		        <?php endif; ?>

		        <?php if($cfg->activarMarcaProducto=="1"): ?>
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','M')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por marcas" 
		            class="btn-catalogo">
		            Marcas
		            </button>
		        </a>
		        <?php endif; ?>

		        <?php if($cfg->activarBotonDias=="1"): ?>
		        <a href="<?php echo e(URL::action('AdcatalogoController@listado','I')); ?>">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" 
		            title="Ver catálogo de productos por Dias de Credito" 
		            class="btn-catalogo">
		            Dias
		            </button>
		        </a>
		        <?php endif; ?>

		        <!-- PSICOTROPICOS -->
		        <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G"): ?>
            		<?php if($cfg->activarBotonPsicoCliente=="1"): ?>
			        <a href="<?php echo e(URL::action('AdcatalogoController@listado','P')); ?>">
			            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos psicotropicos" 
			            class="btn-catalogo">
			            Psicotropicos
			            </button>
			        </a>
			        <?php endif; ?>
			    <?php endif; ?>
			    <?php if(Auth::user()->tipo == "V"): ?>
            		<?php if($cfg->activarBotonPsico=="1"): ?>
            		<a href="<?php echo e(URL::action('AdcatalogoController@listado','P')); ?>">
			            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos psicotropicos" 
			            class="btn-catalogo">
			            Psicotropicos
			            </button>
			        </a>
					<?php endif; ?>
			    <?php endif; ?>
		        <!-- ENVIA PEDIDO -->
		        <a href="" data-target="#modal-enviar-<?php echo e($tabla->id); ?>" data-toggle="modal">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Enviar pedido" class="btn-confirmar">
		                Enviar
		            </button>
		        </a>
		        <?php echo $__env->make('seped.catalogo.enviar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

		    </div>   
		</div>
	<?php endif; ?>

	<!-- TABLA -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table id="idtabla" 
					class="table table-striped table-bordered table-condensed table-hover">
					<thead class="colorTitulo">
						<!-- O NUMERO -->
						<th>#</th>

						<!-- 1 IMAGEN -->
						<?php if( $cfg->mostrarImagenPedido > 0 ): ?>
                        	<th title="Imagen del producto" style="width: 120px;">
                        		<center>IMAGEN</center>
                        	</th>
                        <?php else: ?>
                        	<th style="display:none;">IMAGEN</th>
                 		<?php endif; ?>

                 		<!-- 2 PEDIR -->
						<th style="width: 110px;" title="Cantidad pedir">PEDIR</th>

						<!-- 3 OPCION -->
						<th style="width: 40px;"></th>

						<!-- 4 DESPROD -->
						<th title="Descripción de producto">
                            PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
					    
						<!-- 5 CODPROD -->
					    <th title="Código del producto" <?php if($cfg->mostrarCodigo > 0): ?>>
                        <?php else: ?>
                            style="display:none;">
                        <?php endif; ?>
                        CODIGO
                        </td>

        				<!-- 6 PRECIO -->
						<th title="<?php echo e($cfg->msgLitPrecio); ?>">
							<?php echo e($cfg->LitPrecio); ?>

			            </td>
 
 						<!-- 7 IVA -->
						<th title="Porcentaje del Iva">IVA</th>

						<!-- 8 DV -->
						<th <?php if( $cfg->mostrarDv > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitDv); ?>">
							<?php echo e($cfg->LitDv); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">DV</th>
						<?php endif; ?>

						<!-- 9 DA -->
						<th <?php if( $cfg->mostrarDa > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitDa); ?>">
							<?php echo e($cfg->LitDa); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">DA</th>
						<?php endif; ?>

						<!-- 10 DP -->
						<th <?php if( $cfg->mostrarDp > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitDp); ?>">
							<?php echo e($cfg->LitDp); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">DP</th>
						<?php endif; ?>

						<!-- 11 DI -->
						<?php if( $cfg->mostrarDi > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitDi); ?>">
							<?php echo e($cfg->LitDi); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">DI</th>
                 		<?php endif; ?>
                 		
                 		<!-- 12 DC -->
                 		<?php if( $cfg->mostrarDc > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitDc); ?>">
							<?php echo e($cfg->LitDc); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">DC</th>
                 		<?php endif; ?>
                 		
                 		<!-- 13 PP -->
                 		<?php if( $cfg->mostrarPp > 0 ): ?>
							<th title="<?php echo e($cfg->msgLitPp); ?>">
							<?php echo e($cfg->LitPp); ?>

							</th>
						<?php else: ?>
							<th style="display:none;">PP</th>
                 		<?php endif; ?>

                   		<!-- 14 NETO  -->
						<th title="MONTO NETO">NETO</th>

	               		<!-- 15 SUBTOTAL -->
                        <th title="MONTO SUBTOTAL">SUBTOTAL</th>


                        <?php if(!empty($cliente->DctoPreferencial)): ?>
							<?php
								$data = MesActivoPreferencial($cliente->DctoPreferencial);
						        $dcto = $data['dcto'];
							?>
	                   		<!-- 16 NETO VIP -->
							<th title="MONTO NETO <?php echo e($cfg->msgLitVip); ?>">NETO <?php echo e($cfg->LitVip); ?></th>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <th title="MONTO SUBTOTAL <?php echo e($cfg->msgLitVip); ?>">SUBTOTAL <?php echo e($cfg->LitVip); ?></th>
                        <?php else: ?>
	                        <!-- 16 NETO VIP -->
							<th style="display:none;">NET.VIP</th>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <th style="display:none;">SUB.VIP</th>
                        <?php endif; ?>

                   		<!-- 18 ITEM -->
						<th style="display:none;">ITEM</th>
					</thead>
					<?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						$tooltip = sVerificarCaractExt($t->codprod); 
				      	if (!empty($cliente->DctoPreferencial)) {
				      		$netoSinDvp = $t->neto + ($t->neto*$dcto/100);
				      		$subtotalSinDvp = $t->subtotal + ($t->subtotal*$dcto/100);
				      		$neto = $t->neto;
				      		$subtotal = $t->subtotal;
				      	} else {
				      		$netoSinDvp = $t->neto;
				      		$subtotalSinDvp = $t->subtotal;
				      		$neto = $t->neto;
				      		$subtotal = $t->subtotal;
				      	}
				 	?>
					<tr>
					    <!-- O NUMERO -->
						<td><?php echo e($loop->iteration); ?></td>

					    <!-- 1 IMAGEN -->
						<?php if( $cfg->mostrarImagenPedido > 0 ): ?>
                        <td >
        					<div align="center" 
        						style="width: 110px;">
                                <a href="<?php echo e(URL::action('AdreportController@producto',$t->codprod)); ?>">
                                    <img src="<?php echo e(asset('/public/storage/'.NombreImagen($t->codprod))); ?>" 
                                    width="100%"
                                    style="border: 2px solid #D2D6DE;"  
                                    class="img-responsive">
                                </a>
                            </div>
                        </td>
                        <?php else: ?>
                        <td style="display:none;"></td>
                 		<?php endif; ?>

				    	<!-- 2 MODIFICAR CANTIDAD DEL CARRO DE COMPRA -->
						<td>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group" id="idModificar_<?php echo e($t->item); ?>_<?php echo e($t->codprod); ?>" >
                                <input style="text-align: center; color: #000000; width: 60px;" 
                                	id="idpedir_<?php echo e($t->item); ?>" 
                                	value="<?php echo e(number_format($t->cantidad, 0, '.', ',')); ?>" 
                                	class="form-control" >

                                <span class="input-group-btn BtnModificar" >
                                    <button type="button" 
                                    	class="btn btn-default btn-pedido" 
                                    	id="idModificar_<?php echo e($t->item); ?>_<?php echo e($t->codprod); ?>" 
                                    	data-toggle="tooltip" title="Modificar cantidad">
                                    	<span class="fa fa-check" 
                                    		id="idModificar_<?php echo e($t->item); ?>_<?php echo e($t->codprod); ?>" 
                                    		aria-hidden="true">
                                    	</span>
                                    </button>
                                </span>
                            </div>
                        </td>

                		<!-- 3 DELETE RENGLON -->
						<td>
							<a href="" data-target="#modal-delete-<?php echo e($t->item); ?>" data-toggle="modal">
								<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar producto"></button>
							</a>
						</td>
	
						<!-- 4 DESPROD -->        
						<td title="<?php echo e($tooltip); ?>">
							<?php if($tooltip != ''): ?>
                                <span style="color: red; font-size: 20px;"> <b>!</b> </span>
                            <?php endif; ?>
							<b><?php echo e($t->desprod); ?></b>
							<?php if($t->dcredito > 0): ?>
                                <div class="colorPromDias"
                                    style="margin-top: 5px;
                                    border-radius: 5px; 
                                    font-size: 14px;
                                    text-align: center;
                                    padding: 1px; 
                                    color: white;
                                    width: 70px;
                                    background-color: black;"
                                    title="DIAS DE CREDITO: <?php echo e($t->dcredito); ?>">
                                    DIAS: <?php echo e($t->dcredito); ?> 
                                </div>
                            <?php endif; ?>
						</td>

						<!-- 5 CODIGO -->        
						<td <?php if( $cfg->mostrarCodigo > 0 ): ?> >
                        <?php else: ?>
                            style="display:none;">
                        <?php endif; ?>
                        <?php echo e($t->codprod); ?>

                        </td>

                    	<!-- 6 PRECIO  -->                             
						<td align="right">
							<span title= "<?php echo e($cfg->simboloMoneda); ?>">
								<b><?php echo e(number_format($t->precio, 2, '.', ',')); ?></b>
							</span>
							<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
								<br>
								<span style="color: green;" 
                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                    <b><?php echo e(number_format($t->precio/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                             	</span>
							<?php endif; ?>
						</td>

                        <!-- 7 IVA -->        
						<td align="right"><?php echo e(number_format($t->iva, 2, '.', ',')); ?></td>

                        <!-- 8 DESCUENTO POR VOLUMEN -->        
						<?php if( $cfg->mostrarDv > 0 ): ?> 
							<?php
								$dvDetalle = "";
								$reg = DB::table('producto')
									->where('codprod','=',$t->codprod)
									->first();
								if ($reg) 
									$dvDetalle = $reg->dvDetalle;
							?>
							<td id="iddv1_<?php echo e($t->item); ?>"
								<?php
                                $toltips = "\n";
                                $separador = ";";
                                if (substr($dvDetalle, -1) != $separador)
                                    $dvDetalle = $dvDetalle.$separador;

                                $listaDcto = explode($separador, $dvDetalle);
                                for ($i = 0; $i < count($listaDcto); $i++) {
                                    $s1 = explode("-", $listaDcto[$i]);
                                    if (count($s1) > 1) {
                                        $desde = $s1[0];
                                        $hasta = $s1[1];
                                        $dcto = $s1[2];
                                        if ($i == count($listaDcto)-2)
                                            $hasta = "INFINITO";
                                        $toltips .= $desde.' - '.$hasta." => ".$dcto."% \n";
                                    }
                                }
                                ?>
                                title = "<?php echo e(strtoupper($cfg->msgLitDv)); ?> &#10======================== <?php echo e($toltips); ?>"
								align="right" 
								<?php if(($t->dv > 0) && !is_null($dvDetalle)): ?>
									style="color: red;"
								<?php endif; ?>
								>			
								<?php echo e(number_format($t->dv, 2, '.', ',')); ?>

							</td>
						<?php else: ?>
							<td style="display:none;"><?php echo e(number_format($t->dv, 2, '.', ',')); ?></td>
						<?php endif; ?>

						<!-- 9 DESCUENTO ADICIONAL -->
						<?php if( $cfg->mostrarDa > 0 ): ?>
							<?php if($t->da > 0): ?>
								<td title = "<?php echo e(strtoupper($cfg->msgLitDa)); ?>" align="right" style="color: red;"><?php echo e(number_format($t->da, 2, '.', ',')); ?>

								</td>
							<?php else: ?>
								<td align="right"><?php echo e(number_format($t->da, 2, '.', ',')); ?></td>
							<?php endif; ?>
						<?php else: ?>
							<td style="display:none;"><?php echo e(number_format($t->da, 2, '.', ',')); ?></td>
						<?php endif; ?>

						<!-- 10 DESCUENTO DE PRE-EMPAQUE -->
						<?php if( $cfg->mostrarDp > 0 ): ?>
							<?php if($t->dp > 0): ?>
								<?php
									$up = 0;
									$reg = DB::table('producto')
								    ->where('codprod','=',$t->codprod)
								    ->first();
								    if ($reg) 
								    	$up = $reg->upre;
								?>
								<td id="iddp1_<?php echo e($t->item); ?>" align="right" style="color: red;" title = "<?php echo e(strtoupper($cfg->msgLitDp)); ?> &#10======================== &#10Multiplos de pre-emapque: <?php echo e($up); ?>">
									<?php echo e(number_format($t->dp, 2, '.', ',')); ?>

								</td>
							<?php else: ?>
								<td id="iddp2_<?php echo e($t->item); ?>" align="right">
									<?php echo e(number_format($t->dp, 2, '.', ',')); ?>

								</td>
							<?php endif; ?>
						<?php else: ?>
							<td style="display:none;">
								<?php echo e(number_format($t->dp, 2, '.', ',')); ?>

							</td>
						<?php endif; ?>

						<!-- 11 DESCUENTO INTERNET -->
						<?php if( $cfg->mostrarDi > 0 ): ?>
							<?php if($t->di > 0): ?>
								<td title = "<?php echo e(strtoupper($cfg->msgLitDi)); ?>" align="right" style="color: red;"><?php echo e(number_format($t->di, 2, '.', ',')); ?>

								</td>
							<?php else: ?>
								<td align="right"><?php echo e(number_format($t->di, 2, '.', ',')); ?></td>
							<?php endif; ?>
						<?php else: ?>
							<td style="display:none;"><?php echo e(number_format($t->di, 2, '.', ',')); ?></td>
                 		<?php endif; ?>

                 		<!-- 12 DESCUENTO COMERCIAL -->
                 		<?php if( $cfg->mostrarDc > 0 ): ?>
							<?php if($t->dc > 0): ?>
								<td title = "<?php echo e(strtoupper($cfg->msgLitDc)); ?>" align="right" style="color: red;"><?php echo e(number_format($t->dc, 2, '.', ',')); ?>

								</td>
							<?php else: ?>
								<td align="right"><?php echo e(number_format($t->dc, 2, '.', ',')); ?></td>
							<?php endif; ?>
						<?php else: ?>
							<td style="display:none;"><?php echo e(number_format($t->dc, 2, '.', ',')); ?></td>
                 		<?php endif; ?>

                 		<!-- 13 DESCUENTO DE PRONTO PAGO -->
                 		<?php if( $cfg->mostrarPp > 0 ): ?>
							<?php if($t->pp > 0): ?>
								<td title = "<?php echo e(strtoupper($cfg->msgLitPp)); ?>" align="right" style="color: red;"><?php echo e(number_format($t->pp, 2, '.', ',')); ?>

								</td>
							<?php else: ?>
								<td align="right"><?php echo e(number_format($t->pp, 2, '.', ',')); ?></td>
							<?php endif; ?>
						<?php else: ?>
							<td style="display:none;"><?php echo e(number_format($t->pp, 2, '.', ',')); ?></td>
                 		<?php endif; ?>

                 		<!-- 14 NETO  -->
						<td align="right">
							<span title= "<?php echo e($cfg->simboloMoneda); ?>">
								<?php echo e(number_format($netoSinDvp, 2, '.', ',')); ?>

							</span>
							<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
								<br>
								<span style="color: green;" 
                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                    <?php echo e(number_format($netoSinDvp/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                             	</span>
							<?php endif; ?>
						</td>
    		
                   		<!-- 15 SUBTOTAL  -->
                        <td align="right">
                        	<span title= "<?php echo e($cfg->simboloMoneda); ?>">
								<b><?php echo e(number_format($subtotalSinDvp, 2, '.', ',')); ?></b>
							</span>
                        	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
								<br>
								<span style="color: green;" 
                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                    <b><?php echo e(number_format($subtotalSinDvp/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                             	</span>
							<?php endif; ?>
                        </td>
						
						<?php if(!empty($cliente->DctoPreferencial)): ?>
							<!-- 16 NETO VIP -->
							<td align="right">
								<span title= "<?php echo e($cfg->simboloMoneda); ?>">
									<b><?php echo e(number_format($t->neto, 2, '.', ',')); ?></b>
								</span>
								<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
									<br>
									<span style="color: green;" 
	                                    title= "<?php echo e($cfg->simboloOM); ?>">
	                                    <b><?php echo e(number_format($t->neto/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
	                             	</span>
								<?php endif; ?>
							</td>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <td align="right">
	                        	<span title= "<?php echo e($cfg->simboloMoneda); ?>">
									<b><?php echo e(number_format($t->subtotal, 2, '.', ',')); ?></b>
								</span>
	                        	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
									<br>
									<span style="color: green;" 
	                                    title= "<?php echo e($cfg->simboloOM); ?>">
	                                    <b><?php echo e(number_format($t->subtotal/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
	                             	</span>
								<?php endif; ?>
	                        </td>
                        <?php else: ?>
                        	<!-- 16 NETO VIP -->
							<td style="display:none;">0.00</td>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <td style="display:none;">0.00</td>
                        <?php endif; ?>

                   		<!-- 18 ITEM -->
                   		<td style="display:none;"><?php echo e($t->item); ?></td>
					</tr>
					<?php echo $__env->make('seped.catalogo.deleprod', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
			</div>
		</div>
	</div>

	<?php if($contItem == 0): ?>
	    <div class="row">
	        <center><h2>Carro de compra vacio</h2></center>
	        <br><br><br><br><br><br><br>
	    </div>
	<?php endif; ?>
	<?php if($contItem > 20): ?>
	<div class="btn-toolbar" role="toolbar" style="margin-top: 8px;">
	    <div class="btn-group" role="group" style="width: 100%;">

	        <!-- BUSCAR PRODUCTOS EN EL CATALOGO -->
	        <?php echo $__env->make('seped.catalogo.catasearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	 
	        <!-- VER CATALOGO -->
	   	    <a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catalogo de productos" 
	            class="btn-catalogo">
	            Catálogo
	            </button>
	        </a>
	        <?php if($cfg->activarEntradasProducto=="1"): ?>
	        <!-- VER ENTRADAS -->
	        <a href="<?php echo e(URL::action('AdcatalogoController@listado','E')); ?>">
	            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver entradas recientes de productos" 
	            class="btn-catalogo">
	            Entradas
	            </button>
	        </a>
	        <?php endif; ?>
	        <?php if($cfg->activarOfertasProducto=="1"): ?>
	        <!-- VER OFERTAS -->
	        <a href="<?php echo e(URL::action('AdcatalogoController@listado','O')); ?>">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver ofertas de productos" 
	            class="btn-catalogo">
	            Ofertas
	            </button>
	        </a>
	        <?php endif; ?>
	        <?php if($cfg->activarDestacadoProducto=="1"): ?>
	        <!-- VER OFERTAS -->
	        <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver productos destacados" 
	            class="btn-catalogo">
	            Destacados
	            </button>
	        </a>
	        <?php endif; ?>
	 		<?php if($cfg->activarCateProducto=="1"): ?>
	        <a href="<?php echo e(URL::action('AdcatalogoController@listado','G')); ?>">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catalogo por categorias" 
	            class="btn-catalogo">
	            Categorias
	            </button>
	        </a>
	        <?php endif; ?>
	 
	        <!-- ENVIA PEDIDO -->
	        <a href="" data-target="#modal-enviar-<?php echo e($tabla->id); ?>" data-toggle="modal">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Enviar pedido" class="btn-confirmar">
	                Enviar
	            </button>
	        </a>
	        <?php echo $__env->make('seped.catalogo.enviar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

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
        var codprod = id[2];
        var pedir = $('#idpedir_'+item).val();
        var idpedido = '<?php echo e($tabla->id); ?>';
        var tasacambiaria = '<?php echo e($cfg->tasacambiaria); ?>';
        var simboloOM = '<?php echo e($cfg->simboloOM); ?>';
        $.ajax({
            type:'POST',
            url:'../modificar',
            dataType: 'json', 
            encode  : true,
            data: {item : item, pedir : pedir, idpedido : idpedido, codprod : codprod },
            success:function(data){
            	if (data.msg != "") {
                    alert(data.msg);
                } 
                location.reload(true);
            }
        });
    });
    refrescar();
}
function refrescar() {
	var tableReg = document.getElementById('idtabla');
	var s1 = "";
	var s2 = "";
	var valor = 0;
    for (var i = 1; i < tableReg.rows.length; i++) {
		var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

		// DESCUENTO POR VOLUMEN
		s1 = cellsOfRow[8].innerHTML;  
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[8].style.color = "red";
		else 
			cellsOfRow[8].style.color = "black";
		
		// DESCUENTO ADICIONAL
		s1 = cellsOfRow[9].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[9].style.color = "red";
		else 
			cellsOfRow[9].style.color = "black";
		
		// DESCUENTO PRE-EMPAQUE
		s1 = cellsOfRow[10].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[10].style.color = "red";
		else 
			cellsOfRow[10].style.color = "black";

		// DESCUENTO INTERNET
		s1 = cellsOfRow[11].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[11].style.color = "red";
		else 
			cellsOfRow[11].style.color = "black";

		// DESCUENTO COMERCIAL
		s1 = cellsOfRow[12].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[12].style.color = "red";
		else 
			cellsOfRow[12].style.color = "black";

		// DESCUENTO PRONTO PAGO
		s1 = cellsOfRow[13].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[13].style.color = "red";
		else 
			cellsOfRow[13].style.color = "black";
	}
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/catalogo/edit.blade.php ENDPATH**/ ?>