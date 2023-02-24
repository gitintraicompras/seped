@extends ('layouts.menu')
@section ('contenido')
@php  $factor = $tabla->factorcambiario;
    if ($tabla->estado == 'NUEVO') 
        $factor = $cfg->tasacambiaria;
@endphp 
<div id="page-wrapper">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if ($cfg->modoVisual=="1")
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
                    <span class="input-group-addon hidden-xs">Monto IVA:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    @if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$factor, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    @endif

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>   

                    @if (!empty($tabla->documento))
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: {{$tabla->documento}}" style="color: #000000; background: #F7F7F7;">
                    @endif
                  

                </div>
            </div>
        </div>
        @endif
        @if ($cfg->modoVisual=="2")
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
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$factor, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    @endif


                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"> </b>  

                    @if (!empty($tabla->documento))
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: {{$tabla->documento}}" style="color: #000000; background: #F7F7F7;">
                    @endif
     

                </div>
            </div>
        </div>
        @endif
        @if ($cfg->modoVisual=="3")
        <div class="form-group">
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Pedido:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->id}}-{{$tabla->tipedido}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Impuesto:</span>
                    <input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    @if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$factor, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    @endif


                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Total:</span>
                    <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>     

                    @if (!empty($tabla->documento))
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: {{$tabla->documento}}" style="color: #000000; background: #F7F7F7;">           
                    @endif

                </div>
            </div>
        </div>
        @endif

        <div class="form-group">
            <div class="row">
                <div class="input-group input-group-sm" >
                    <span class="input-group-addon">Observación:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->observacion}}" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    
                    <span class="input-group-addon">Transporte de Mercancia:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->codtransp}}" >
         
                    <span class="input-group-addon" style="border:0px; "></span>

                    <span class="input-group-addon" >Unidades:</span>
                    <input readonly 
                        type="text" 
                        class="form-control" 
                        value="{{$tabla->numund}}" >
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
                        @if ( $cfg->mostrarImagenPedido > 0 )
                            <th class="hidden-xs">IMAGEN</th>
                        @endif
                        <th title="Descripción de producto">
                            PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        
                        @if ( $cfg->mostrarCodigo > 0 )
                            <th class="hidden-xs">CODIGO</th>
                        @endif
                        <th>LOTE</th>
                        <th>CANTIDAD</th>

                        <th title="{{$cfg->msgLitPrecio}}">
                            {{$cfg->LitPrecio}}
                        </th>

                        <th class="hidden-xs">IVA</th>

                        @if ( $cfg->mostrarDa > 0 )
                            <th title="{{$cfg->msgLitDa}}" class="hidden-xs">
                                {{$cfg->LitDa}}
                            </th>
                        @endif

                        @if ( $cfg->mostrarDp > 0 )
                            <th title="{{$cfg->msgLitDp}}" class="hidden-xs">
                                {{$cfg->LitDp}}
                            </th>
                        @endif

                        @if ( $cfg->mostrarDi > 0 )
                            <th title="{{$cfg->msgLitDi}}" class="hidden-xs">
                                {{$cfg->LitDi}}
                            </th>
                        @endif

                        @if ( $cfg->mostrarDc > 0 )
                            <th title="{{$cfg->msgLitDc}}" class="hidden-xs">
                                {{$cfg->LitDc}}
                            </th>
                        @endif

                        @if ( $cfg->mostrarDv > 0 )     
                            <th class="hidden-xs" title="{{$cfg->msgLitDv}}">
                                {{$cfg->LitDv}}
                            </th>
                        @endif 

                        @if ( $cfg->mostrarPp > 0 )
                            <th title="{{$cfg->msgLitPp}}" class="hidden-xs">
                                {{$cfg->LitPp}}
                            </th>
                        @endif

                        <th>NETO</th>
                        <th>SUBTOTAL</th>
                    </thead>
                  
                    @foreach ($tabla2 as $t)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        @if ( $cfg->mostrarImagenPedido > 0 )
                        <td class="hidden-xs">
                            <div align="center">
                                <a href="{{URL::action('AdreportController@producto',$t->codprod)}}">
                                    <img src="{{asset('/public/storage/'.NombreImagen($t->codprod)  )}}" width="40" height="25" class="img-responsive">
                                </a>
                            </div>
                        </td>
                        @endif
                        <td><b>{{$t->desprod}}</b></td>
                        @if ( $cfg->mostrarCodigo > 0 )
                            <td class="hidden-xs">{{$t->codprod}}</td>
                        @endif
                        <td>{{$t->lote}}</td>
                        <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
                        <td align="right">
                            <span title= "{{$cfg->simboloMoneda}}">
                                {{number_format($t->precio, 2, '.', ',')}}
                            </span>
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->precio/$factor, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>
                        <td class="hidden-xs" align="right">{{number_format($t->iva, 2, '.', ',')}}</td>
                        
                        @if ( $cfg->mostrarDa > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->da > 0) style="color: red;" @endif>
                                {{number_format($t->da, 2, '.', ',')}}
                            </td>
                        @endif
                        
                        @if ( $cfg->mostrarDp > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->dp > 0) style="color: red;" @endif>
                                {{number_format($t->dp, 2, '.', ',')}}
                            </td>
                        @endif

                        @if ( $cfg->mostrarDi > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->di > 0) style="color: red;" @endif>
                                {{number_format($t->di, 2, '.', ',')}}
                            </td>
                        @endif

                        @if ( $cfg->mostrarDc > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->dc > 0) style="color: red;" @endif>
                                {{number_format($t->dc, 2, '.', ',')}}
                            </td>
                        @endif

                        @if ( $cfg->mostrarDv > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->dv > 0) style="color: red;" @endif>
                                {{number_format($t->dv, 2, '.', ',')}}
                            </td>
                        @endif

                        @if ( $cfg->mostrarPp > 0 )
                            <td class="hidden-xs" align="right"
                                @if ($t->pp > 0) style="color: red;" @endif>
                                {{number_format($t->pp, 2, '.', ',')}}
                            </td>
                        @endif

                        <td align="right">
                            <span title= "{{$cfg->simboloMoneda}}">
                                {{number_format($t->neto, 2, '.', ',')}}
                            </span>
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->neto/$factor, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>

                        <td align="right">
                            <span title= "{{$cfg->simboloMoneda}}">
                                {{number_format($t->subtotal, 2, '.', ',')}}
                            </span>
                            @if ( $cfg->mostrarPedidoOM > 0 )
                                <br>
                                <span style="color: green;" title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->subtotal/$factor, 2, '.', ',')}}</b>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                @if ( $cfg->mostrarPedidoOM > 0 )
                <h4>
                     *** {{$cfg->LiteralTasaCambiaria}} {{number_format($factor, 2, '.', ',')}} ***
                </h4>          
                @endif
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <br>
     <div class="form-group" style="margin-left: 0px;">
        <button type="button" 
            class="btn-normal" 
            onclick="history.back(-1)">
            Regresar
        </button>
     </div>
</div>
@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection