@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
 
    <div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla2->codcli}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Cliente</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla2->nombre}}" style="background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla->tipocxc}} - {{$tabla->numerod}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Total Operación</label>
                <input readonly type="text" class="form-control"  value="{{number_format($tabla->monto, 2, '.', ',')}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número control</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla->nroctrol}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Comentario</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla->notas1}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Fecha emisión</label>
                <input readonly  type="text" class="form-control"  value="{{date('d-m-Y H:i:s', strtotime($tabla->fechai))}}" style="background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Estación</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla->codesta}}" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Usuarios</label>
                <input readonly  type="text" class="form-control"  value="{{$tabla->codusua}}" style="background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" style="margin-left: 0px;">
                <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
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

