@extends ('layouts.menu')
@section ('contenido')

{!!Form::model($tabla,['method'=>'PATCH','route'=>['pedcrisep.update',$tabla->id]])!!}
{{Form::token()}}

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label>ID</label>
            <input readonly type="text" class="form-control" name="id" value="{{$tabla->id}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label>Descripción</label>
            <input type="text" class="form-control" name="descrip" value="{{ $tabla->descrip }}">
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label>Criterio</label>
            <input type="text" class="form-control" name="criterio" value="{{ $tabla->criterio }}">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Días crédito</label>
            <input type="number" class="form-control" name="diasCredito" value="{{ $tabla->diasCredito }}">
        </div>
    </div>

    <!-- ACTIVAR/INACTIVAR CLIENTE -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control">
                @if ($tabla->estado == 'ACTIVO')
                    <option value="ACTIVO" selected>ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                @else
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO" selected>INACTIVO</option>
                @endif
            </select>
        </div>
    </div>



</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group">
    <div class="form-group" style="margin-top: 20px;">
        <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
        <button class="btn-confirmar" type="submit">Guardar</button>
    </div>
</div>


{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection

