@extends ('layouts.menu')
@section ('contenido')

<div id="page-wrapper">
    <!-- ENCABEZADO -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if ($cfg->modoVisual=="1")
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->id}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Estado:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->factnum}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fec.Factura:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecfact))}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon">Enviado:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecenviado))}}" style="color:#000000; background: #F7F7F7;" >     

                    <span class="input-group-addon" style="border:0px; "></span>     
                    <span class="input-group-addon">Procesado:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))}}" style="color: #000000; background: #F7F7F7;">           

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Origen:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{$tabla->origen}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Usuario:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{$tabla->usuario}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon hidden-xs">renglones:</span>
                    <input id="idrenglon" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Unidades:</span>
                    <input id="idunidad" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" readonly type="text" class="form-control" value="{{$tabla->observacion}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        @endif
        @if ($cfg->modoVisual=="2")
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->id}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Estado:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->factnum}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fec.Factura:</span>
                    <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecfact))}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon hidden-xs">renglones:</span>
                    <input id="idrenglon" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Unidades:</span>
                    <input id="idunidad" readonly type="text" class="form-control" value="0" style="color: #000000; background: #F7F7F7; text-align: right;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">
                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" readonly type="text" class="form-control" value="{{$tabla->observacion}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        @endif
        @if ($cfg->modoVisual=="3")
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon">Reclamo:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->id}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Estado:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Factura:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->factnum}}" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Monto:</span>
                    <input id="idmonto" readonly type="text" class="form-control" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    <span class="input-group-addon">Observación:</span>
                    <input id="idobs" readonly type="text" class="form-control" value="{{$tabla->observacion}}" style="color: #000000; background: #F7F7F7;">
                </div>
            </div>
        </div>
        @endif

        @if (!empty($tabla->nota))
        <div class="form-group">
            <div class="row">
                <div class="input-group input-group-sm" >
                    <span class="input-group-addon">Notas:</span>
                    <input readonly type="text" class="form-control" value="{{$tabla->nota}}" >
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- TABLA -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th>#</th>
                        <th>PRODUCTO</th>
                        <th class="hidden-xs">CODIGO</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO</th>
                        <th>RECLAMO</th>
                        <th>MOTIVO</th>
                    </thead>
                  
                    @foreach ($tabla2 as $t)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <b>{{$t->desprod}}</b>
                        </td>
                        <td class="hidden-xs">{{$t->codprod}}</td>
                        <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
                        <td align="right">{{number_format($t->precio, 2, '.', ',')}}</td>
                        <td align="right">{{number_format($t->cantrec, 0, '.', ',')}}</td>
                        <td>{{$t->motivo}}</td>
                    </tr>
                    @endforeach
                  
                </table>
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

window.onload = function() {
  
    var tableReg = document.getElementById('idtabla');
    var monto = 0.00;
    var renglon = 0;
    var unidad = 0;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

        // MOTIVO RECLAMO
        var sMotivo = cellsOfRow[6].innerHTML;

        // CANTIDAD RECLAMO
        var s1 = cellsOfRow[5].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var subcantrec = parseFloat(s2).toFixed(2);
        unidad += parseFloat(subcantrec);

        if (sMotivo != 'SOBRANTE') {
            // PRECIO
            var s1 = cellsOfRow[4].innerHTML;
            var s2 = s1.replace(/,/g, '');

            var submonto = parseFloat(s2).toFixed(2);
            monto += (parseFloat(submonto) * parseFloat(subcantrec)) * (-1)
        }

        // CANTIDAD DE RENGLONES DEL RECLAMO
        renglon++;
    }
    $("#idmonto").val(number_format(monto, 2, '.', ','));
    $("#idrenglon").val(number_format(renglon, 0, '.', ','));
    $("#idunidad").val(number_format(unidad, 0, '.', ','));
}
function number_format(number, decimals, dec_point, thousands_sep) { 
    number = (number + '').replace(',', '').replace(' ', ''); 
    var n = !isFinite(+number) ? 0 : +number, 
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), 
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, 
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point, 
      s = '', 
      toFixedFix = function (n, prec) { 
       var k = Math.pow(10, prec); 
       return '' + Math.round(n * k)/k; 
      }; 
    // Fix for IE parseFloat(0.55).toFixed(0) = 0; 
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.'); 
    if (s[0].length > 3) { 
     s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep); 
    } 
    if ((s[1] || '').length < prec) { 
     s[1] = s[1] || ''; 
     s[1] += new Array(prec - s[1].length + 1).join('0'); 
    } 
    return s.join(dec); 
}
</script>
@endpush
@endsection
