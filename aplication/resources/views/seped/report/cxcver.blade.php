@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
 
 	<div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla2->codcli}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Cliente</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla2->nombre}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->tipocxc}}-{{$tabla->numerod}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Total operación</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->monto, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número control</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->nroctrol}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Comentario</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->notas1}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Fecha emisión</label>
                <input type="text" class="form-control" readonly="" value="{{date('d-m-Y H:i:s', strtotime($tabla->fechai))}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Estación</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->codesta}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->codusua}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>

    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group" style="margin-left: 0px;">
        <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
    </div>
</div>


@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
</script>
@endpush
@endsection

