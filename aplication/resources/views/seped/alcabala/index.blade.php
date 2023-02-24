@extends ('layouts.menu')
@section('contenido')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            @include('seped.alcabala.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th style="width:140px;">OPCION</th>
                        <th title="Identificador del pedido">PEDIDO</th>
                        <th title="Descripción del cliente">CLIENTE</th>
                        <th title="Código del cliente">CODIGO</th>
                        <th title="Fecha de creación">FECHA</th>
                        <th title="Estado del pedido">ESTATUS</th>
                        @if ($cfg->mostrarModnofiscal > 0)
                            <th title="Pedido fiscal o No fiscal">FISCAL</th>
                        @endif
                        <th title="Origen del pedido">ORIGEN</th>
                        <th title="Monto total del pedido">TOTAL</th>
                        <th>SUCURSAL</th>
                    </thead>

                    @foreach ($tabla as $t)
                        <tr>
                            <td>
                                <!-- CONSULTA DE PEDIDO -->
                                <a href="{{ URL::action('AdalcabalaController@show', $t->id) }}">
                                    <button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip"
                                        title="Consultar pedido">
                                    </button>
                                </a>

                                <!-- DESCARGAR PEDIDO -->
                                <a href="{{ URL::action('AdpedidoController@descargar', $t->id) }}">
                                    <button class="btn btn-default btn-pedido fa fa-download" data-toggle="tooltip"
                                        title="Descargar pedido en pdf">
                                    </button>
                                </a>

                                <!-- PRE-APROBAR PEDIDO -->
                                @if ($t->estado == 'POR-APROBAR')
                                    @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R')
                                        <a href="{{ URL::action('AdalcabalaController@edit', $t->id) }}">
                                            <button class="btn btn-default btn-pedido fa fa-check"
                                                title="Pre-Aprobar pedido">
                                            </button>
                                        </a>
                                    @endif
                                    @if (Auth::user()->tipo == 'V')
                                        <a href="{{ URL::action('AdalcabalaController@edit', $t->id) }}">
                                            <button class="btn btn-default btn-pedido fa fa-search-plus"
                                                title="Ver estado crediticio">
                                            </button>
                                        </a>
                                    @endif
                                @endif

                            </td>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->cliente }}</td>
                            <td>{{ $t->codcli }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($t->fecha)) }}</td>
                            @if ($t->estado == 'POR-APROBAR')
                                <td style="color: red;">{{ $t->estado }}</td>
                            @else
                                <td>{{ $t->estado }}</td>
                            @endif
                            @if ($cfg->mostrarModnofiscal > 0)
                                <td align="center">{{ $t->pedfiscal == 1 ? 'SI' : 'NO' }}</td>
                            @endif

                            <td>{{ $t->origen }}</td>

                            <td align="right">
                                <span title="MONTO EN BOLIVARES">
                                    <b>{{ number_format($t->total, 2, '.', ',') }}</b>
                                </span><br>
                                @if ($cfg->mostrarPedidoOM > 0)
                                    <span align="right" title="MONTO EN OTRA MONEDA" style="color: green">
                                        <b>{{ number_format($t->total / $cfg->tasacambiaria, 2, '.', ',') }}</b>
                                    </span>
                                @endif
                            </td>

                            <td>{{ sLeercfg($t->codisb, 'SedeSucursal') }}</td>
                        </tr>
                    @endforeach
                </table><br>
                {{ $tabla->render() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#subtitulo').text('{{ $subtitulo }}');
            setTimeout('document.location.reload()', 30000);
        </script>
    @endpush
@endsection
