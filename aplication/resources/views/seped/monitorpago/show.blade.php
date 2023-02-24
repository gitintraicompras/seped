@extends ('layouts.menu')
@section ('contenido')

<!-- ENCABEZADO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="{{$pago->id}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control" value="{{$pago->estado}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($pago->fecha))}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Enviado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i:s', strtotime($pago->fecenviado))}}" style="color:#000000; background: #F7F7F7;" >                  

            </div>
        </div>

        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Procesado:</span>
                <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($pago->fecprocesado))}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Origen:</span>
                <input readonly type="text" class="form-control hidden-xs" value="{{$pago->origen}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Usuario:</span>
                <input readonly type="text" class="form-control hidden-xs" value="{{$pago->usuario}}" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="{{number_format(SubtotalPago($pago->id), 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   

            </div>
        </div>

        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input readonly id="idobs" type="text" class="form-control" value="{{$pago->observacion}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-tabs" >
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#menu1">DOCUMENTOS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2">PAGOS</a>
    </li>
</ul>

<!-- Tab panes -->
<div style="margin-top: 10px;" class="tab-content" >
    <div id="menu1" class="container tab-pane active" style="width: 100%;">
        <div class="row">
            <!-- TABLA DOCUMENTOS PENDIENTES-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>#</th>
                            <th>DOCUMENTO</th>
                            <th class="hidden-xs">TIPO</th>
                            <th>FECHA</th>
                            <th>MONTO</th>
                            <th>SALDO</th>
                            <th class="hidden-xs">OBSERVACION</th>
                        </thead>
                        @foreach ($cxc as $t)
                        <tr>
                            <!-- SELECCIONAR DOCUMENTO -->
                            <?php $marca = 0; ?>
                            @foreach ($pagdoc as $pd)
                                @if ($pd->coddoc == $t->numerod)
                                    <?php $marca = 1; ?>
                                    @break;
                                @endif
                            @endforeach
                            @if($marca==1)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$t->numerod}}</td>
                                <td class="hidden-xs">{{$t->tipocxc}}</td>
                                <td>{{date('d-m-Y', strtotime($t->fechai))}}</td>
                                <td align="right">{{number_format($t->monto, 2, '.', ',')}}</td>
                                <td align="right">{{number_format($t->saldo, 2, '.', ',')}}</td>
                                <td class="hidden-xs">{{$t->notas1}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="menu2" class="container tab-pane fade" style="width: 100%;">
        <div class="row">
            <!-- TABLA PAGOS ENGLON-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="idtabla2" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>ITEM</th>
                            <th>REFERENCIA</th>
                            <th>CUENTA</th>
                            <th>FECHA</th>
                            <th>MONTO</th>
                            <th>MODO</th>
                            <th>CHEQUE</th>
                            <th>BANCO</th>
                        </thead>

                        @foreach ($pagren as $t)
                        <tr>
                            <td>{{$t->item}}</td>
                            <td>{{$t->referencia}}</td>
                            <td>{{$t->cuenta}}</td>
                            <td>{{date('d-m-Y', strtotime($t->fecha))}}</td>
                            <td align="right">{{number_format($t->monto, 2, '.', ',')}}</td>
                            <td>{{$t->modo}}</td>
                            <td>{{$t->cheque}}</td>
                            <td>{{$t->banco}}</td>
                        </tr>
                        @endforeach
                    </table><br>
                </div>
            </div>
        </div>
    </div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection