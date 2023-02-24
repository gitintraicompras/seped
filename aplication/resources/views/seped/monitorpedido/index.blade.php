@extends ('layouts.menu')
@section('contenido')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            @include('seped.monitorpedido.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th style="width:140px;">OPCION</th>
                        <th>PEDIDO</th>
                        <th>CLIENTE</th>
                        <th>ENVIADO</th>
                        <th>RENGLON</th>
                        <th>UNIDAD</th>
                        <th>PROCESADO</th>
                        <th>ORIGEN</th>
                        <th>STATUS</th>
                        @if (sLeercfg($sucactiva, 'mostrarModnofiscal') > 0)
                            <th title="Pedido fiscal o No fiscal">FISCAL</th>
                        @endif
                        <th title="Factor cambiario del pedido">FACTOR</th>
                        <th>TOTAL</th>
                        <th>SUCURSAL</th>
                    </thead>
                    @foreach ($tabla as $t)
                        <tr>
                            <td>
                                <!-- CONSULTA DE PEDIDO -->
                                <a href="{{ URL::action('AdmonitorpedidoController@show', $t->id) }}">
                                    <button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip"
                                        title="Consultar pedido">
                                    </button>
                                </a>

                                @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'S')
                                    <!-- ELIMINAR PEDIDO -->
                                    <a href="" data-target="#modal-delete-{{ $t->id }}" data-toggle="modal">
                                        <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip"
                                            title="Eliminar pedido"></button>
                                    </a>
                                    @if ($t->estado == 'ANULADO' || $t->estado == 'ENVIADO')
                                        <!-- MODIFICAR PEDIDO -->
                                        <a href="{{ URL::action('AdmonitorpedidoController@edit', $t->id) }}">
                                            <button class="btn btn-default btn-pedido fa fa-pencil"
                                                title="Modificar estatus del pedido">
                                            </button>
                                        </a>
                                    @endif
                                @endif

                            </td>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->nomcli }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($t->fecenviado)) }}</td>
                            <td align="right">{{ $t->numren }}</td>
                            <td align="right">{{ $t->numund }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($t->fecprocesado)) }}</td>
                            <td>{{ $t->origen }}</td>
                            <td>{{ $t->estado }}</td>
                            @if (sLeercfg($sucactiva, 'mostrarModnofiscal') > 0)
                                <td align="center">{{ $t->pedfiscal == 1 ? 'SI' : 'NO' }}</td>
                            @endif
                            <td align="right">{{ number_format($t->factorcambiario, 2, '.', ',') }}</td>
                            <td align="right">
                                <b>{{ number_format($t->total, 2, '.', ',') }}</b>
                            </td>
                            <td>{{ sLeercfg($t->codisb, 'SedeSucursal') }}</td>
                        </tr>
                        @include('seped.monitorpedido.delete')
                    @endforeach
                </table>
                <div align='right'>
                    {{ $tabla->render() }}
                </div><br>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#subtitulo').text('{{ $subtitulo }}');
        </script>
    @endpush
@endsection
