@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<div class="form-group">
	        <label>ID</label>
            <input readonly type="text" class="form-control" value="{{$reg->id}}" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
	        <label>Remite</label>
            <input readonly type="text" class="form-control" value="{{$reg->remite}} {{$cfg->nombre}}" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
	        <label>Tipo</label>
            <input readonly type="text" class="form-control" value="{{$reg->tipo}}" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Fecha envio</label>
            <input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($reg->fecha))}}" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-xs-12">
		<div class="form-group">
	        <label>Asunto</label>
            <textarea readonly rows="5" style="width: 100%; color: #000000; background: #F7F7F7;">{{$reg->asunto}}</textarea>
	    </div>
    </div>


</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="colorTitulo">
            <th style="width: 5%">ITEM</th>
            <th style="width: 85%">DESTINO</th>
            <th style="width: 120px;">LEIDO</th>
        </thead>
      
        @foreach ($tabla as $t)
        <tr>
        	@if ($t->leido > 0)
                <td>{{$t->item}}</td>
                <td>{{$t->destino}} {{$t->nombre}}</td>
                <td>{{date('d-m-Y H:i:s', strtotime($t->fechaleido))}}</td>
            @else
            	<td><b>{{$t->item}}</b></td>
                <td><b>{{$t->destino}} {{$t->nombre}}</b></td>
                <td><b>{{date('d-m-Y H:i:s', strtotime($t->fechaleido))}}</b></td>
            @endif
        </tr>
        @endforeach
      
    </table>
</div>

    <div class="form-group">
        <a href="{{url('/seped/notiservidor?tab=1')}}" class="text-muted">
            <button type="button" class="btn-normal">Regresar</button>
        </a>
    </div> 

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection