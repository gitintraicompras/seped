@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label>Id</label>
            <input readonly type="text" class="form-control" name="id" value="{{$grupo->id}}" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

	<div class="col-xs-8">
		<div class="form-group">
	        <label>Nombre</label>
            <input readonly type="text" class="form-control" name="nomgrupo" value="{{ $grupo->nomgrupo }}" >
 	    </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th style="width: 50px;">#</th>
                    <th style="width: 50px;">CODIGO</th>
                    <th>CLIENTE</th>
                    <th>SUCURSAL</th>
                </thead>
                @foreach ($gruporen as $gr)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$gr->codcli}}</td>
                    <td>{{$gr->nomcli}}</td>
                    <td>{{sLeercfg($gr->codisb, "SedeSucursal")}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection