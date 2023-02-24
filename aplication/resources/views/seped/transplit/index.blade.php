@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>LITERALES DE TRANSPORTE</B></a></li>
	          <li class="pull-right">
	          	<a href="{{url('/seped/config')}}" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
					<div class="row">
						
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<a href="transplit/create">
								<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear nuevo literal">
									Nuevo literal
								</button>
							</a>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							@include('seped.transplit.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width: 50px;">#</th>
										<th style="width: 50px;">OPCION</th>
										<th style="width: 50px;">ID</th>
										<th>DESCRIPCION</th>
									</thead>
									@foreach ($transplit as $tl)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>
											<a href="" data-target="#modal-delete-{{$tl->id}}" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar literal"></button></a>
										</td>
										<td>{{$tl->id}}</td>
										<td>{{$tl->literal}}</td>
									</tr>
									@include('seped.transplit.delete')
									@endforeach
								</table>
							</div>
						</div>
					</div>
		        </div>
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