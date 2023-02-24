@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
 
 	<div class="form-group">
        <div style="margin-bottom: 10px; margin-top: 10px;" class="input-group input-group-sm">
            <span class="input-group-addon">Factura:</span>
            <input readonly type="text" class="form-control" value="{{$tabla->factnum}}" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
		    <span class="input-group-addon">Fecha:</span>
            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

			<span class="input-group-addon" style="border:0px; "></span>     
            <span class="input-group-addon">Código:</span>
            <input readonly type="text" class="form-control" value="{{$tabla->codcli}}" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Cliente:</span>
            <input readonly type="text" class="form-control" value="{{$tabla->descrip}}" style="color: #000000; background: #F7F7F7;">
        </div>

        <div style="margin-bottom: 10px;" class="input-group input-group-sm">

            <span class="input-group-addon">Monto:</span>
            <input readonly type="text" class="form-control" value="{{number_format($tabla->monto, 2, '.', ',')}}" style="color: #000000;  background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Iva:</span>
            <input readonly type="text" class="form-control" value="{{number_format($tabla->iva, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7;  background: #F7F7F7; text-align: right;">

			<span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Gravable:</span>
            <input readonly type="text" class="form-control" value="{{number_format($tabla->gravable, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Descuento:</span>
            <input readonly type="text" class="form-control" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Total:</span>
            <input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;">
        </div>
    </div>

    <div  class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead class="colorTitulo">
                <th>#</th>
                <th>CODIGO</th>
                <th>PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>SUBTOTAL</th>
                <th>REFERENCIA</th>
            </thead>
          
            @foreach ($tabla2 as $t)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$t->codprod}}</td>
                <td>
                    <b>{{$t->desprod}}</b>
                </td>
                <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
                <td align="right">{{number_format($t->precio, 2, '.', ',')}}</td>
                <td align="right">{{number_format($t->subtotal, 2, '.', ',')}}</td>
                <td>{{$t->referencia}}</td>
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

