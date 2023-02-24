@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">

 	<div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->codcli}}" style="color: #000000; background: #F7F7F7;">
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
                <label>Entrega</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->entrega}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Teléfono</label>
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
                <label>Usuario</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->usuario}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Clave</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->clave}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dia corte</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->dcorte}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Estado</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Zona</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->zona}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Limite de crédito</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->limite, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Días de crédito</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->dcredito, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dto. comercial</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->dcomercial, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Saldo</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->saldo, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Vencido</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->vencido, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
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
                <label>Dto. internet</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->dinternet, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dto. pronto pago</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->ppago, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dto. otro</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->dotro, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Tipo catálogo</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->tipocatalogo}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Canal</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->canal}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Cadena</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->cadena}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Agenda</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->agenda}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Tipo de pago</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->tipo}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Ruta</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->ruta}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código bancario</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->cb}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Monto especial</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->especial, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Monto permiso</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->mpermiso, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Tipo de precio</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->usaprecio}}" style="text-align: right; background: #f7f7f7;" >
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

