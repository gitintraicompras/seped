@extends ('layouts.menu')
@section ('contenido')

<div class="row">

     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>ID</label>
            <input readonly type="text" class="form-control" name="descrip" value="{{ $tabla->id }}">
        </div>
    </div>


    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label>Descripción</label>
            <input readonly type="text" class="form-control" name="descrip" value="{{ $tabla->descrip }}">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Criterio</label>
            <input readonly type="text" class="form-control" name="criterio" value="{{ $tabla->criterio }}">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Días crédito</label>
            <input readonly type="number" class="form-control" name="diasCredito" value="{{ $tabla->diasCredito }}">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Estado</label>
            <input readonly type="text" class="form-control" name="estado" value="{{ $tabla->estado }}">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
        </div>
    </div>


</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection