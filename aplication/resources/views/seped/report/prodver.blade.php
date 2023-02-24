@extends('layouts.menu')
@section('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">BASICA</a></li>
              <li><a href="#tab_2" data-toggle="tab">PRECIOS</a></li>
              <li><a href="#tab_3" data-toggle="tab">DETALLES</a></li>
              <li><a href="#tab_4" data-toggle="tab">ADICIONALES</a></li>
              <li class="pull-right">
                <a href="{{url('/home')}}" class="text-muted">
                    <i class="fa fa-window-close-o"></i>
                </a>
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">

                        @if ( $cfg->mostrarImagen > 0)
                            <td>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <center>
                                        <img src="{{asset('/public/storage/'.NombreImagen($tabla->codprod)  )}}" class="img-responsive" style="width: 370px; height: 370px;">
                                    </center>
                                </div>
                            </td>
                        @endif
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Código</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->codprod}}" style="color: #000000; background: #F7F7F7;" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input readonly  type="text" class="form-control" value="{{number_format($tabla->cantidad, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Iva</label>
                                    <input readonly  type="text" class="form-control" value="{{number_format($tabla->iva, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->tipo}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Regulado</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->regulado}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->barra}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Principio Activo</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->pactivo}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            @if (Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S")
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Fecha Última compra</label>
                                    <input readonly  type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fechafalla))}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input readonly  type="text" class="form-control" value="{{$tabla->desprod}}" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">

                        @if (Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S")
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}1</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio1, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}2</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio2, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}3</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio3, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}4</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio4, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}5</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio5, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Precio6</label>
                                    <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio6, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                        @else 
                            <?php 
                                $usaprecio = 1;
                                $codcli = sCodigoClienteActivo();
                                $cliente = DB::table('cliente')
                                ->where('codcli','=',$codcli)
                                ->first();
                                if ($cliente) {
                                    $usaprecio = $cliente->usaprecio;
                                }
                            ?>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>{{$cfg->LitPrecio}}</label>
                                    @if ($usaprecio == 1)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio1, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                    @if ($usaprecio == 2)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio2, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                    @if ($usaprecio == 3)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio3, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                    @if ($usaprecio == 4)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio4, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                    @if ($usaprecio == 5)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio5, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                    @if ($usaprecio == 6)
                                        <input title="{{$cfg->msgLitPrecio}}" readonly  type="text" class="form-control" value="{{number_format($tabla->precio1, 6, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Preempaque</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->upre, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>
                                    {{$cfg->LitDp}}
                                </label>
                                <input title="{{$cfg->msgLitDp}}" readonly  type="text" class="form-control" value="{{number_format($tabla->ppre, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Precio Sugerido</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->psugerido, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Precio Gris</label>
                                <input readonly type="text" class="form-control" value="{{$tabla->pgris}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Descuento Neto</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->dctoneto}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Tipo catálogo</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->tipocatalogo}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->codprov}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Bulto</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->original}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>{{$cfg->LitDa}}</label>
                                <input title="{{$cfg->msgLitDa}}" readonly  type="text" class="form-control" value="{{number_format($tabla->da, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Otra Oferta</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->oferta, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Minima facturación</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->undmin, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Maxima facturación</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->undmax, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Multiplo facturación</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->undmultiplo, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        @if (Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S")
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Cantidad a Publicar</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->cantpub, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Cantidad Real</label>
                                <input readonly  type="text" class="form-control" value="{{number_format($tabla->cantreal, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane" id="tab_4">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Lote</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->lote}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Vencimiento</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->fecvence}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Marca o Modelo</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->marcamodelo}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                      
                        @if (Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S")
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Costo</label>
                                <input readonly type="text" class="form-control" value="{{number_format($tabla->costo, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;">
                            </div>
                        </div>
                        @endif
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Ubicación</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->ubicacion}}" style="color: #000000; background: #F7F7F7;" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Descripción corta</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->descorta}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Codisb</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->codisb}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Fecha catálogo</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->feccatalogo}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Departamento</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->departamento}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Grupo</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->grupo}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Subgrupo</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->subgrupo}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional1</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->opc1}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional2</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->opc2}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional3</label>
                                <input readonly  type="text" class="form-control" value="{{$tabla->opc3}}" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" style="margin-left: 15px;">
    <button type="button" 
        class="btn-normal" 
        onclick="history.back(-1)">
        Regresar
    </button>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection

