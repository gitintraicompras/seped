@extends ('layouts.menu')
@section ('contenido')
<?php  $factor = $tabla->factorcambiario;
    if ($tabla->estado == 'NUEVO') 
        $factor = $cfg->tasacambiaria;
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Id:</span>
                    <input readonly 
                        type="text" 
                        class="form-control" 
                        value="{{$tabla->id}}" 
                        style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Recipiente</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->recipiente}}" style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Fecha:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecha))}}" style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Reng:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->numren}}" style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Und:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->numund}}" style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Cliente:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->nomcli}}"  style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Solicitado:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->numund}}"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Status:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->estado}}"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Dias credito:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->dcredito}}"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon hidden-xs">Descuento:</span>
                <input readonly type="text" class="form-control hidden-xs" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs" >Subtotal:</span>
                <input readonly type="text" class="form-control" value="{{number_format($tabla->subtotal, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Monto IVA:</span>
                <input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                @if ( $cfg->mostrarPedidoOM > 0 )
                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->total/$factor, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal">
                @endif


                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal">                 
            </div>
        </div>
    </div>

    <br>
    <ul class="nav nav-tabs" >
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#menu1">BASICA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">DETALLE</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div style="margin-top: 10px;" class="tab-content" >
        <div id="menu1" class="container tab-pane active" style="width: 100%;">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Código:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->codcli}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Origen:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->origen}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Destino:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->destino}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Usuario:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->usuario}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Vendedor:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->codvend}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Tipo:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->tipedido}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Rif:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->rif}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Creado:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecha))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Enviado:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecenviado))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Procesado:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecprocesado))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Recibido:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecrecibido))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Picking:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecpicking))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Packing:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecpacking))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Facturado:</span>
                            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecfacturado))}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Despachador:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->despachador}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Documento:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->documento}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Observación:</span>
                            <input readonly type="text" class="form-control" value="{{$tabla->observacion}}" style="color: #000000;" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu2" class="container tab-pane" style="width: 100%;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="colorTitulo">
                                <th>#</th>
                                <th class="hidden-xs" style="width: 120px;">
                                    <center>IMAGEN</center>
                                </th>
                                <th>CODIGO</th>
                                <th>PRODUCTO</th>
                                <th>REFERENCIA</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>SUBTOTAL</th>
                                <th style="display:none;">ITEM</th>
                            </thead>
                          
                            @foreach ($tabla2 as $t)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <!-- 1 IMAGEN -->
                                <td class="hidden-xs">
                                    <div align="center" style="width: 110px;">
                                        <a href="{{URL::action('AdreportController@producto',$t->codprod)}}">
                                            <img src="{{asset('/public/storage/'.NombreImagen($t->codprod))}}" 
                                            width="100%"  
                                            class="img-responsive">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    {{$t->codprod}}
                                    @if ($t->dcredito > 0)
                                        <div class="colorPromDias"
                                            style="margin-top: 5px;
                                            border-radius: 5px; 
                                            font-size: 14px;
                                            text-align: center;
                                            padding: 1px; 
                                            color: white;
                                            width: 100px;
                                            background-color: black;"
                                            title="DIAS DE CREDITO: {{$t->dcredito}}">
                                            DIAS: {{$t->dcredito}} 
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <b>{{$t->desprod}}</b>
                                </td>
                                <td>{{$t->barra}}</td>
                                <td align="right">
                                    {{number_format($t->cantidad, 0, '.', ',')}}
                                </td>
                                <td align="right">
                                    {{number_format($t->precio, 2, '.', ',')}}
                                    @if ( $cfg->mostrarPedidoOM > 0 )
                                    <br>
                                    <span style="color: green">
                                        {{number_format($t->precio/$factor, 2, '.', ',')}}
                                    </span>
                                    @endif
                                </td>
                                <td align="right">
                                    {{number_format($t->subtotal, 2, '.', ',')}}
                                    @if ( $cfg->mostrarPedidoOM > 0 )
                                    <br>
                                    <span style="color: green">
                                        {{number_format($t->subtotal/$factor, 2, '.', ',')}}
                                    </span>
                                    @endif
                                </td>
                                <td style="display:none;">{{$t->item}}</td>
                            </tr>
                            @endforeach
                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <br>
            <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
        </div>
    </div>

</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection