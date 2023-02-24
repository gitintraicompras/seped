@extends ('layouts.menu')
@section ('contenido')

<?php
$monto = 0;
$imp = 0;
$factr = DB::table('factren')
->select(DB::raw('sum(subtotal) as subtotal'), DB::raw('sum(impuesto) as imp'))
->where('factnum','=',$factnum)
->where('marca','LIKE','%'.$codmarca.'%')
->first();
if ($factr) {
    $monto = $factr->subtotal;
    $imp = $factr->imp;
}
?>

<div id="page-wrapper">
 
 	<div class="form-group">
        <div style="margin-top: 4px;" class="input-group input-group-sm">
            <span class="input-group-addon">Factura:</span>
            <input readonly type="text" class="form-control" value="{{$fact->factnum}}" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
		    <span class="input-group-addon hidden-xs">Fecha:</span>
            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($fact->fecha))}}" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon hidden-xs" style="border:0px; "></span>
            <span class="input-group-addon hidden-xs">Monto:</span>
            <input readonly type="text" class="form-control hidden-xs" value="{{number_format($monto, 2, '.', ',')}}" style="color: #000000; text-align: right; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon hidden-xs">Iva:</span>
            <input readonly type="text" class="form-control" value="{{number_format($imp, 2, '.', ',')}}" style="color: #000000; text-align: right; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Total:</span>
            <input readonly type="text" class="form-control" value="{{number_format($monto + $imp, 2, '.', ',')}}" style="color: #000000; text-align: right; background: #F7F7F7;">

        </div>

        <div style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input id="idobs" readonly type="text" class="form-control" value="{{$fact->observacion}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>

    <div  class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead class="colorTitulo">
                <th>#</th>
                @if ( $cfg->mostrarImagen > 0 )
                    <th class="hidden-xs">IMAGEN</th>
                @else
                    <th class="hidden-xs">OPCION</th>
                @endif
                <th>PRODUCTO</th>
                <th class="hidden-xs">CODIGO</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>IVA</th>
                <th>SUBTOTAL</th>
                <th class="hidden-xs">REFERENCIA</th>
            </thead>
          
            @foreach ($factren as $fr)
            <tr>
                <td>{{$loop->iteration}}</td>
                @if ( $cfg->mostrarImagen > 0)
                    <td class="hidden-xs">
                        <div align="center">
                            <a href="{{URL::action('AdreportController@producto',$fr->codprod)}}">
                                <img src="{{asset('/public/storage/'.NombreImagen($fr->codprod)  )}}" width="50" height="25" class="img-responsive">
                            </a>
                        </div>
                    </td>
                @else
                    <td class="hidden-xs">
                        <!-- VER DETALLES -->
                        <a href="{{URL::action('AdreportController@producto',$fr->codprod)}}">
                            <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                            </button>
                        </a>
                    </td>
                @endif
                <td>
                    <b>{{$fr->desprod}}</b>
                </td>
                <td class="hidden-xs">{{$fr->codprod}}</td>
                <td align="right">{{number_format($fr->cantidad, 0, '.', ',')}}</td>
                <td align="right">{{number_format($fr->precio, 2, '.', ',')}}</td>
                <td align="right">{{number_format($fr->impuesto, 2, '.', ',')}}</td>
                <td align="right">{{number_format($fr->subtotal, 2, '.', ',')}}</td>
                <td class="hidden-xs">{{$fr->referencia}}</td>
            </tr>
            @endforeach
          
        </table>
    </div>

    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
   
  
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection
