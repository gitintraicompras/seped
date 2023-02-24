
<div class="btn-toolbar" role="toolbar">
    <div class="btn-group" role="group" style="width: 100%; height: 100%;">
 
        <!-- VER CATALOGO -->
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos" 
            <?php if($tipo=='C'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Catálogo
            </button>
        </a>
        <?php if($cfg->activarEntradasProducto=="1"): ?>
        <!-- VER ENTRADAS -->
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','E')); ?>">
            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver ultimas entradas" 
            <?php if($tipo=='E'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">últ.Entradas
            </button>
        </a>
        <?php endif; ?>
        <?php if($cfg->activarOfertasProducto=="1"): ?>
        <!-- VER OFERTAS -->
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','O')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver ofertas del día" 
            <?php if($tipo=='O'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Ofertas
            </button>
        </a>
        <?php endif; ?> 
        <?php if($cfg->activarDestacadoProducto=="1"): ?>
        <!-- PRODUCTOS DESTACADOS -->
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos destacados" 
            <?php if($tipo=='D'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Destacados
            </button>
        </a>
        <?php endif; ?>
        <?php if($cfg->activarCateProducto=="1"): ?>
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','G')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por categorias" 
            <?php if($tipo=='G'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Categorias
            </button>
        </a>
        <?php endif; ?>
        <?php if($cfg->activarMarcaProducto=="1"): ?>
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','M')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por marcas" 
            <?php if($tipo=='M'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Marcas
            </button>
        </a>
        <?php endif; ?>
        <?php if($cfg->activarBotonDias=="1"): ?>
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','I')); ?>">
            <button style="margin-right: 3px;" 
                type="button" 
                data-toggle="tooltip" 
                title="Ver catálogo de productos por Dias de Credito" 
            <?php if($tipo=='I'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Dias
            </button>
        </a>
        <?php endif; ?>

        <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G"): ?>
            <?php if($cfg->activarBotonPsicoCliente=="1"): ?>
            <a href="<?php echo e(URL::action('AdcatalogoController@listado','P')); ?>">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                <?php if($tipo=='P'): ?>
                    class="btn-catalogoX" 
                <?php else: ?> 
                    class="btn-catalogo" 
                <?php endif; ?>
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(Auth::user()->tipo == "V"): ?>
            <?php if($cfg->activarBotonPsico=="1"): ?>
            <a href="<?php echo e(URL::action('AdcatalogoController@listado','P')); ?>">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                <?php if($tipo=='P'): ?>
                    class="btn-catalogoX" 
                <?php else: ?> 
                    class="btn-catalogo" 
                <?php endif; ?>
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(Auth::user()->tipo == "A"): ?>
            <?php if($cfg->activarBotonPsico=="1" || $cfg->activarBotonPsicoCliente=="1"): ?>
            <a href="<?php echo e(URL::action('AdcatalogoController@listado','P')); ?>">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                <?php if($tipo=='P'): ?>
                    class="btn-catalogoX" 
                <?php else: ?> 
                    class="btn-catalogo" 
                <?php endif; ?>
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            <?php endif; ?>
        <?php endif; ?> 
        <?php if($cfg->activarBotonFallaAlerta=="1"): ?>
        <a href="<?php echo e(URL::action('AdcatalogoController@listado','F')); ?>">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de fallas de productos" 
            <?php if($tipo=='F'): ?>
                class="btn-catalogoX" 
            <?php else: ?> 
                class="btn-catalogo" 
            <?php endif; ?>
            class="btn btn-default">Alertas
            </button>
        </a>
        <?php endif; ?>
        <?php echo $__env->make('seped.catalogo.descargar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>   
</div>
<?php echo $__env->make('seped.catalogo.catasearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/catalogo/catabarra.blade.php ENDPATH**/ ?>