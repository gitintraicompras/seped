@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
 
 	<div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->codprov}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->nombre}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Rif</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->rif}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->direccion}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->telefono}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Contacto</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->contacto}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Días de crédito</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->diascred}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Correo</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->email}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Saldo</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->saldo, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
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
@endpush
@endsection

