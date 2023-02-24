@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li @if ($tab=="1") class="active" @endif>
	          	<a href="#tab_1" data-toggle="tab">
	          		BANDEJA ENTRADAS ({{number_format($contEntradas, 0, '.', ',')}})	
	          	</a>
	          </li>
	          <li @if ($tab=="2") class="active" @endif>
	          	<a href="#tab_2" data-toggle="tab">
	          		BANDEJA SALIDA ({{number_format($contSalidas, 0, '.', ',')}})
	          	</a>
	          </li>
	          <li class="pull-right">
	          	<a href="{{url('/home')}}" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        <div class="tab-content">
	          	<div @if ($tab=="1") class="tab-pane active" @else class="tab-pane" @endif id="tab_1">
 			        <div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
			            <div class="btn-group" role="group" style="width: 100%;">
			                <div class="input-group md-form form-sm form-2 pl-0" style="width: 15%; margin-right: 3px;">
			                    <span class="input-group-btn">
			                        <button disabled="" class="btn btn-buscar" data-toggle="tooltip" title="Buscar cliente">
			                            <span class="fa fa-search" aria-hidden="true"></span>
			                        </button>
			                    </span>
			                    <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Buscar" style="height: 34px;">
			                </div>
			                &nbsp;&nbsp;
			                @include('seped.noticliente.confirmar', array('metodo'=>'leido','mensaje'=>'MARCAR TODAS LAS NOTIFICACIONES COMO LEIDAS'))
	        				<a href="" data-target="#modal-confirmar-leido" data-toggle="modal">
								<i class="fa fa-check-square-o" style="margin-top: 15px;">
					            	Marcar todas las notificaciones como leidas
					            </i>
							</a>
						    &nbsp;&nbsp;
					        @include('seped.noticliente.confirmar', array('metodo'=>'borrar','mensaje'=>'BORRAR TODAS LAS NOTIFICACIONES'))
	        				<a href="" data-target="#modal-confirmar-borrar" data-toggle="modal">
								<i class="fa fa-trash-o">
					            	Borrar todas las notificaciones
					            </i>
							</a>
					    </div>
			        </div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="myTable1" class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width:30px;">ID</th>
										<th style="width:50px;" title="Marcar como leido">LEIDO</th>
										<th style="width:100px;">OPCION</th>
										<th style="width:80px;">REMITE</th>
										<th>ASUNTO</th>
										<th style="width:50px;">TIPO</th>
										<th style="width:100px;">ENVIADO</th>
										<th style="width:100px;">LEIDO</th>
									</thead>
									@foreach ($notientradas as $t)
									<tr>
										<td>{{$t->id}}</td>
										<td style="padding-top: 10px;">
											@if ($t->envio > 0)
												<span onclick='tdclick(event);' >
												<center>
											    <input type="checkbox" id="idalerta_{{$t->item}}"  />
						                    	</center>
												</span>
											@endif
										</td>
										<td>
											<a href="{{URL::action('AdnotiClienteController@show',$t->item)}}">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-file-o" title="Consultar notificaciún">
												</button>
											</a>

											<a href="" data-target="#modal-delete-{{$t->item}}" data-toggle="modal">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar notificaciún">
												</button>
											</a>
										</td>
										<td>
											@if ($t->envio > 0)
												<b>{{$t->remite}}</b>
											@else
												{{$t->remite}}
											@endif
										</td>
										<td>
											@if ($t->envio > 0)
												<b>{{$t->asunto}}</b>
											@else
												{{$t->asunto}}
											@endif
										</td>
										<td>
											@if ($t->envio > 0)
												<b>{{$t->tipo}}</b>
											@else
												{{$t->tipo}}
											@endif
										</td>
										<td>
											@if ($t->envio > 0)
												<b>{{date('d-m-Y H:i:s', strtotime($t->fechaenvio))}}</b>
											@else
												{{date('d-m-Y H:i:s', strtotime($t->fechaenvio))}}
											@endif
										</td>
										<td>
											@if ($t->envio > 0)
												<b>{{date('d-m-Y H:i:s', strtotime($t->fechaleido))}}</b>
											@else
												{{date('d-m-Y H:i:s', strtotime($t->fechaleido))}}
											@endif
										</td>
									</tr>
									@include('seped.noticliente.delete')
									@endforeach
								</table><br>
							</div>
						</div>
					</div>
			  	</div>
		        <div @if ($tab=="2") class="tab-pane active" @else class="tab-pane" @endif id="tab_2">
		        	<div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
			            <div class="btn-group" role="group" style="width: 100%;">
			                <div class="input-group md-form form-sm form-2 pl-0" style="width: 15%; margin-right: 3px;">
			                    <span class="input-group-btn">
			                        <button disabled="" class="btn btn-buscar" data-toggle="tooltip" title="Buscar cliente">
			                            <span class="fa fa-search" aria-hidden="true"></span>
			                        </button>
			                    </span>
			                    <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Buscar" style="height: 34px;">
			                </div>
			                &nbsp;&nbsp;
							<a href="{{url('/seped/noticliente/create')}}" title="Crear notificación nueva">
							    <i class="fa fa-file-o" style="margin-top: 15px;">
							    	Notificaciún nueva
								</i> 
							</a>
							&nbsp;&nbsp;
					        @include('seped.noticliente.confirmar', array('metodo'=>'borrar2','mensaje'=>'BORRAR TODAS LAS NOTIFICACIONES'))
	        				<a href="" data-target="#modal-confirmar-borrar2" data-toggle="modal">
								<i class="fa fa-trash-o">
					            	Borrar todas las notificaciones
					            </i>
							</a>
			            </div>
			        </div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="myTable2" class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width:30px;">ID</th>
										<th style="width:100px;">OPCION</th>
										<th style="width:70px;">REMITE</th>
										<th>ASUNTO</th>
										<th style="width:20px;">TIPO</th>
										<th style="width:100px;">ENVIADO</th>
									</thead>
									@foreach ($notisalidas as $t)
									<tr>
										<td>{{$t->id}}</td>
										<td>
											<a href="{{URL::action('AdnotiClienteController@show2',$t->id)}}"><button style="height: 35px;" class="btn btn-default btn-pedido fa fa-file-o" title="Consultar notificaciún">
											</button>
											</a>

											<a href="" data-target="#modal-delete2-{{$t->id}}" data-toggle="modal">
												<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar notificaciún">
												</button>
											</a>
										</td>
										<td>
											{{$t->remite}}
										</td>
										<td>
											{{$t->asunto}}
										</td>
										<td>
											{{$t->tipo}}
										</td>
										<td>
											{{date('d-m-Y H:i:s', strtotime($t->fecha))}}
										</td>
									</tr>
									@include('seped.noticliente.delete2')
									@endforeach
								</table><br>
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

function tdclick(e) {
    var valor = e.target.id.split('_');
    var item = valor[1];
    $.ajax({
	  type:'POST',
	  url:'./noticliente/modleido',
	  dataType: 'json', 
	  encode  : true,
	  data: {item : item },
	  success:function(data) {
	    location.reload(true); 
	  }
  	});
}
function myFunction1() {
  // Declare variables 
  var input, filter, table, tr, td, i, j, visible;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no sólo la primera */
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        visible = true;
      }
    }
    if (visible === true) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
function myFunction2() {
  // Declare variables 
  var input, filter, table, tr, td, i, j, visible;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no sólo la primera */
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        visible = true;
      }
    }
    if (visible === true) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

</script>
@endpush

@endsection