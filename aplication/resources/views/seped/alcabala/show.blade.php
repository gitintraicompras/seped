@extends ('layouts.menu')
@section ('contenido')

<div id="page-wrapper">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     	<div class="form-group">
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Pedido:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->id}}-{{$tabla->tipedido}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Estado:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Enviado:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecenviado))}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Unidades:</span>
                    <input readonly 
                        type="text" 
                        class="form-control" 
                        value="{{$tabla->numund}}" 
                        style="color: #000000; background: #F7F7F7;">

                    @if ( strlen($tabla->documento) > 0 )
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="FACT: {{$tabla->documento}}" style="color: #000000; background: #F7F7F7;">
                    @endif
                    
                </div>
            </div>
            <div class="row" style="margin-top: 4px; margin-bottom: 4px;">
                <div class="input-group input-group-sm">
           
                    <span class="input-group-addon">Procesado:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Origen:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->origen}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Usuario:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->usuario}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Dias credito:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->dcredito}}" style="color: #000000; background: #F7F7F7;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon hidden-xs">Descuento:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs" >Subtotal:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->subtotal, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Impuesto:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    @if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <input readonly type="text" class="form-control" value="{{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right; font-size: 20px;" id="idtotal">                 

                    @endif

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right; font-size: 20px;" id="idtotal">                 

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm" >
                    <span class="input-group-addon">Observación:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->observacion}}" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    
                    <span class="input-group-addon">Transporte de Mercancia:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->codtransp}}" >
         
                </div>
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="idtabla" 
                    class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th>#</th>
                        <th class="hidden-xs" style="width: 120px;">
                            <center>IMAGEN</center>
                        </th>
                        <th>PRODUCTO</th>
                        @if ( $cfg->mostrarCodigo > 0 )
                            <th class="hidden-xs">CODIGO</th>
                        @endif        
                        <th>LOTE</th>
                        <th>CANTIDAD</th>

                        <th>PRECIO</th>
                        <th class="hidden-xs">IVA</th>
                        <th class="hidden-xs" title="{{$cfg->msgLitDa}}">{{$cfg->LitDa}}</th>
                        @if ( $cfg->mostrarDp > 0 )
                            <th class="hidden-xs" title="{{$cfg->msgLitDp}}">{{$cfg->LitDp}}</th>
                        @endif 
                        @if ( $cfg->mostrarDi > 0 )
                            <th class="hidden-xs" title="{{$cfg->msgLitDi}}">{{$cfg->LitDi}}</th>
                        @endif        
                        @if ( $cfg->mostrarDc > 0 )     
                            <th class="hidden-xs" title="{{$cfg->msgLitDc}}">{{$cfg->LitDc}}</th>
                        @endif    
                        @if ( $cfg->mostrarDv > 0 )     
                            <th class="hidden-xs" title="{{$cfg->msgLitDv}}">{{$cfg->LitDv}}</th>
                        @endif 
                        @if ( $cfg->mostrarPp > 0 )     
                            <th class="hidden-xs" title="{{$cfg->msgLitPp}}">{{$cfg->LitPp}}</th>
                        @endif 
                        <th class="hidden-xs">NETO</th>
                        <th>SUBTOTAL</th>
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
                            <b>{{$t->desprod}}</b>
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
                        @if ( $cfg->mostrarCodigo > 0 )
                            <td class="hidden-xs">{{$t->codprod}}</td>
                        @endif
                        <td>{{$t->lote}}</td>
                        <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>

                        <td align="right">
                            {{number_format($t->precio, 2, '.', ',')}}
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->precio/$cfg->tasacambiaria, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>
                        <td class="hidden-xs" align="right">{{number_format($t->iva, 2, '.', ',')}}</td>
                        <td class="hidden-xs" align="right">{{number_format($t->da, 2, '.', ',')}}</td>
                        @if ( $cfg->mostrarDp > 0 )
                        <td class="hidden-xs" align="right">{{number_format($t->dp, 2, '.', ',')}}</td>
                        @endif
                        @if ( $cfg->mostrarDi > 0 )
                        <td class="hidden-xs" align="right">{{number_format($t->di, 2, '.', ',')}}</td>
                        @endif
                        @if ( $cfg->mostrarDc > 0 )
                        <td class="hidden-xs" align="right">{{number_format($t->dc, 2, '.', ',')}}</td>
                        @endif
                        @if ( $cfg->mostrarDv > 0 )
                        <td class="hidden-xs" align="right">{{number_format($t->dv, 2, '.', ',')}}</td>
                        @endif
                        @if ( $cfg->mostrarPp > 0 )
                        <td class="hidden-xs" align="right">{{number_format($t->pp, 2, '.', ',')}}</td>
                        @endif
                        <td class="hidden-xs" align="right">
                            {{number_format($t->neto, 2, '.', ',')}}
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->neto/$cfg->tasacambiaria, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>
                        <td align="right">
                            {{number_format($t->subtotal, 2, '.', ',')}}
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->subtotal/$cfg->tasacambiaria, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  
                </table>

                @if ( $cfg->mostrarPedidoOM > 0 )
                <h4>
                     *** {{$cfg->LiteralTasaCambiaria}} {{number_format($tabla->factorcambiario, 2, '.', ',')}} ***
                </h4>          
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br>
        <div class="form-group" style="margin-left: 0px;">
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