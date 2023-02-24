
<div class="btn-toolbar" role="toolbar">
    <div class="btn-group" role="group" style="width: 100%; height: 100%;">
 
        <!-- VER CATALOGO -->
        <a href="{{URL::action('AdcatalogoController@listado','C')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos" 
            @if ($tipo=='C')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Catálogo
            </button>
        </a>
        @if ($cfg->activarEntradasProducto=="1")
        <!-- VER ENTRADAS -->
        <a href="{{URL::action('AdcatalogoController@listado','E')}}">
            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver ultimas entradas" 
            @if ($tipo=='E')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">últ.Entradas
            </button>
        </a>
        @endif
        @if ($cfg->activarOfertasProducto=="1")
        <!-- VER OFERTAS -->
        <a href="{{URL::action('AdcatalogoController@listado','O')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver ofertas del día" 
            @if ($tipo=='O')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Ofertas
            </button>
        </a>
        @endif 
        @if ($cfg->activarDestacadoProducto=="1")
        <!-- PRODUCTOS DESTACADOS -->
        <a href="{{URL::action('AdcatalogoController@listado','D')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos destacados" 
            @if ($tipo=='D')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Destacados
            </button>
        </a>
        @endif
        @if ($cfg->activarCateProducto=="1")
        <a href="{{URL::action('AdcatalogoController@listado','G')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por categorias" 
            @if ($tipo=='G')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Categorias
            </button>
        </a>
        @endif
        @if ($cfg->activarMarcaProducto=="1")
        <a href="{{URL::action('AdcatalogoController@listado','M')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por marcas" 
            @if ($tipo=='M')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Marcas
            </button>
        </a>
        @endif
        @if ($cfg->activarBotonDias=="1")
        <a href="{{URL::action('AdcatalogoController@listado','I')}}">
            <button style="margin-right: 3px;" 
                type="button" 
                data-toggle="tooltip" 
                title="Ver catálogo de productos por Dias de Credito" 
            @if ($tipo=='I')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Dias
            </button>
        </a>
        @endif

        @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G")
            @if ($cfg->activarBotonPsicoCliente=="1")
            <a href="{{URL::action('AdcatalogoController@listado','P')}}">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                @if ($tipo=='P')
                    class="btn-catalogoX" 
                @else 
                    class="btn-catalogo" 
                @endif
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            @endif
        @endif
        @if (Auth::user()->tipo == "V")
            @if ($cfg->activarBotonPsico=="1")
            <a href="{{URL::action('AdcatalogoController@listado','P')}}">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                @if ($tipo=='P')
                    class="btn-catalogoX" 
                @else 
                    class="btn-catalogo" 
                @endif
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            @endif
        @endif
        @if (Auth::user()->tipo == "A")
            @if ($cfg->activarBotonPsico=="1" || $cfg->activarBotonPsicoCliente=="1")
            <a href="{{URL::action('AdcatalogoController@listado','P')}}">
                <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos Psicotropicos" 
                @if ($tipo=='P')
                    class="btn-catalogoX" 
                @else 
                    class="btn-catalogo" 
                @endif
                class="btn btn-default">Psicotropicos
                </button>
            </a>
            @endif
        @endif 
        @if ($cfg->activarBotonFallaAlerta=="1")
        <a href="{{URL::action('AdcatalogoController@listado','F')}}">
            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de fallas de productos" 
            @if ($tipo=='F')
                class="btn-catalogoX" 
            @else 
                class="btn-catalogo" 
            @endif
            class="btn btn-default">Alertas
            </button>
        </a>
        @endif
        @include('seped.catalogo.descargar')

    </div>   
</div>
@include('seped.catalogo.catasearch')

