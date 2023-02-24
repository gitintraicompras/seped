@extends ('layouts.menu')
@section ('contenido')
  
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.caracteristica.search')
		<a href="{{url('/seped/caracteristica?activa=1')}}">
			<i class="fa fa-check">
            	Mostrar solo productos con caracteristicas extendidas
            </i>
		</a>
	</div>
</div>
 
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					<th>PRODUCTO</th>
					<th style="width:120px;">CODIGO</th>
					<th title="Existencia real">EXISTENCIA</th>
					<th style="width:140px;" title="Unidad minima de facturación">UND. MINIMA</th>
					<th style="width:140px;" title="Unidad maxima de facturación">UND. MAXIMA</th>
					<th style="width:140px;" title="Unidad multiplos de facturación">UND.MULTIPLO</th>
					<th style="width:140px;" title="Existencia a publicar">EXIT.PUBLICAR</th>
					<th style="width:150px;" title="Clases de Producto">CLASE</th>
					<th style="width:180px;" title="Forzar fecha ultimas entradas">ENTRADAS RECIENTES</th>
					<th style="width:100px;" title="Producto no tiene devoculución">INDEVOLUTIVO</th>
					<th style="width:100px;" title="Producto en cuarentena">CUARENTENA</th>
					<th style="width:100px;" title="Producto psicotropico">PSICOTROPICO</th>
					<th style="width:100px;" title="Producto psicotropico">REFRIGERADO</th>
				</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<b>{{$t->desprod}}</b>
					</td>
					<td>{{$t->codprod}}</td>
					<td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmin_{{$t->codprod}}" style="text-align: center; color: #000000; width: 90px;" value="{{$t->undmin}}" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_{{$t->codprod}}_{{'undmin'}}" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad minima" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_{{$t->codprod}}_{{'undmin'}}">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmax_{{$t->codprod}}" style="text-align: center; color: #000000; width: 90px;" value="{{$t->undmax}}" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_{{$t->codprod}}_{{'undmax'}}" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad maxima" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_{{$t->codprod}}_{{'undmax'}}">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idundmultiplo_{{$t->codprod}}" style="text-align: center; color: #000000; width: 90px;" value="{{$t->undmultiplo}}" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_{{$t->codprod}}_{{'undmultiplo'}}" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad multiplos" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_{{$t->codprod}}_{{'undmultiplo'}}">
						            </span>
						        </button>
						    </span>

						</div>
					</td>
					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idcantpub_{{$t->codprod}}" style="text-align: center; color: #000000; width: 120px;" value="{{$t->cantpub}}" class="form-control" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_{{$t->codprod}}_{{'cantpub'}}" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar cantidad a publicar" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_{{$t->codprod}}_{{'cantpub'}}">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

	   				<td>
						<div class="col-xs-12 input-group" >
						    <select id="idclase_{{$t->codprod}}" style="width: 120px;" class="form-control">
					    		<option value="NORMAL" 
					    		@if ($t->clase == 'NORMAL') selected @endif >NORMAL
					    		</option>
					    		
					    		<option value="DESTACADO"  
					    		@if ($t->clase == 'DESTACADO') selected @endif >DESTACADO
					    		</option>
					    		
					    		<option value="NUEVO" 
					    		@if ($t->clase == 'NUEVO') selected @endif>NUEVO
					    		</option>

					    		<option value="INTERNO"
					    		@if ($t->clase == 'INTERNO') selected @endif>INTERNO
					    		</option>
					    	</select>

						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idclase1_{{$t->codprod}}_clase" type="button" class="btn btn-pedido" data-toggle="tooltip"  >
						            <span id="idclase2_{{$t->codprod}}_clase" class="fa fa-check" aria-hidden="true">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

					<td>
						<div class="col-xs-12 input-group" >
						    
						    <input id="idfechafalla_{{$t->codprod}}" style="text-align: center; color: #000000; width: 160px;" value="{{date('Y-m-d', strtotime($t->fechafalla))}}" class="form-control" type="date" >
						    <span class="input-group-btn" onclick='tdclick(event);'>
						        <button id="idBtn1_{{$t->codprod}}_{{'fechafalla'}}" type="button" class="btn btn-pedido" data-toggle="tooltip" title="Modificar ultima fecha de entrada" >
						            <span class="fa fa-check" aria-hidden="true" id="idBtn2_{{$t->codprod}}_{{'fechafalla'}}">
						            </span>
						        </button>
						    </span>

						</div>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						@if($t->indevolutivo==0)
						    <input type="checkbox" id="idindevolutivo_{{$t->codprod}}_indevolutivo"  />
						@else
							<input type="checkbox" id="idindevolutivo_{{$t->codprod}}_indevolutivo" checked />
						@endif
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						@if($t->cuarentena==0)
						    <input type="checkbox" id="idcuarentena_{{$t->codprod}}_cuarentena"  />
						@else
							<input type="checkbox" id="idcuarentena_{{$t->codprod}}_cuarentena" checked />
						@endif
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						@if($t->psicotropico==0)
						    <input type="checkbox" id="idpsicotropico_{{$t->codprod}}_psicotropico"  />
						@else
							<input type="checkbox" id="idpsicotropico_{{$t->codprod}}_psicotropico" checked />
						@endif
						</center>
						</span>
					</td>

					<td style="padding-top: 10px;">
						<span onclick='tdclick(event);' >
						<center>
						@if($t->refrigerado==0)
						    <input type="checkbox" id="idrefrigerado_{{$t->codprod}}_refrigerado"  />
						@else
							<input type="checkbox" id="idrefrigerado_{{$t->codprod}}_refrigerado" checked />
						@endif
						</center>
						</span>
					</td>

				</tr>
				@endforeach
			</table>
			<div align='right'>
				{{$tabla->render()}}
			</div><br>
		</div>
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');

function tdclick(e) {
    var id = e.target.id.split('_');
    var codprod = id[1];
    var campo = id[2];

    var unidades = $('#idundmin_'+codprod).val();
    if (campo == 'undmin') {
    	unidades = $('#idundmin_'+codprod).val();
    	unidades = (unidades <= 0) ? 1 : unidades;
    }
    if (campo == 'undmax') {
    	unidades = $('#idundmax_'+codprod).val();
    	unidades = (unidades == 0) ? 99999999 : unidades;
    }
    if (campo == 'undmultiplo') {
    	unidades = $('#idundmultiplo_'+codprod).val();
    	unidades = (unidades <= 1 ) ? 0 : unidades;
    }
  	if (campo == 'cantpub') {
    	unidades = $('#idcantpub_'+codprod).val();
    	unidades = (unidades < 0 ) ? 0 : unidades;
  	}
    if (campo == 'clase') {
    	unidades = $('#idclase_'+codprod).val();
    }
    if (campo == 'fechafalla') {
    	unidades = $('#idfechafalla_'+codprod).val();
    }

    //alert('campo: ' + campo + ' valor: ' + unidades);

    $.ajax({
	  type:'POST',
	  url:'./caracteristica/modcaract',
	  dataType: 'json', 
	  encode  : true,
	  data: {codprod : codprod, unidades : unidades, campo : campo },
	  success:function(data) {
	    if (data.msg != "") {
	        alert(data.msg);
	    } 
	  }
  	});
}

</script>
@endpush

@endsection