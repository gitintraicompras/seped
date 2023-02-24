@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    
    <div class="col-lg-1 col-md-1col-sm-1 col-xs-12">
        <div class="form-group">
            <label>ID</label>
            <input readonly type="text" class="form-control" value="{{$reg->id}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
        <div class="form-group">
            <label>ITEM</label>
            <input readonly type="text" class="form-control" value="{{$reg->item}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label>Remite</label>
            <input readonly type="text" class="form-control" value="{{$reg->remite}} {{$reg->nombre}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label>MARCA</label>
            @if ($reg->leido > 0)
                <input readonly type="text" class="form-control" value="LEIDO" style="color: #000000; background: #F7F7F7;">
            @else
                <input readonly type="text" class="form-control" value="SIN LEER" style="color: #000000; background: #F7F7F7;">
            @endif
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Tipo</label>
            <input readonly type="text" class="form-control" value="{{$reg->tiponoti}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Fecha envio</label>
            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($reg->fechaenvio))}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Fecha leido</label>
            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($reg->fechaleido))}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label>Asunto</label>
            <textarea readonly rows="5" style="width: 100%; color: #000000; background: #F7F7F7;">{{$reg->asunto}}</textarea>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <a href="{{url('/seped/notiservidor?tab=2')}}" class="text-muted">
                <button type="button" class="btn-normal">Regresar</button>
            </a>
        </div> 
    </div> 
</div>

   

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection