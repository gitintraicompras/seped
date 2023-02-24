@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="blogs/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear blog nuevo">
				Nuevo
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.blogs.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					<td style="width: 170px;">OPCION</td>
					<th>ID</th>
					<td>NOMBRE</td>
					<td>FECHA</td>
					<td>STATUS</td>
				</thead>
				@foreach ($blogs as $blog)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{URL::action('AdblogsController@show',$blog->id)}}"><button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar Blog"></button></a>

						<a href="{{URL::action('AdblogsController@edit',$blog->id)}}"><button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar Blog"></button></a>

						<a href="" data-target="#modal-delete-{{$blog->id}}" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar Blog"></button></a>

					</td>
					<td>{{$blog->id}}</td>
					<td>{{$blog->nombre}}</td>
					<td>{{date('d-m-Y', strtotime($blog->fecha))}}</td>
					<td>{{$blog->status}}</td>
				</tr>
				@include('seped.blogs.delete')
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