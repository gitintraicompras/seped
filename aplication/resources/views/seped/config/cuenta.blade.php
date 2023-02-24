@extends ('layouts.menu')
@section ('contenido')
 
<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>CUENTAS</B></a></li>
	          <li class="pull-right">
	          	<a href="{{url('/seped/config')}}" class="text-muted">
	          		<i class="fa fa-window-close-o"></i>
	          	</a>
	          </li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
		          	<div class="row">
		          		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
				        	<div class="table-responsive">
				                <table id="idtablacb" class="table table-striped table-bordered table-condensed table-hover">
				             
					                <thead class="colorTitulo">
					                	<th>CODIGO</th>
					                  	<th>BANCO</th>
					                  	<th>CUENTA BANCARIA</th>
						                <th style="width: 100px;">ACTIVAR</th>
						            </thead>

						            @foreach ($ctabanco as $cb)
						                <tr>
						                  	<td>{{$cb->co_cta}}</td>
						                	<td>{{$cb->co_banco}}</td>
						                	<td>{{$cb->num_cuenta}}</td>
						                  	<td>
						                  		@if($cb->activo==0)
												    <input type="checkbox" class="BtnModcuenta" id="idFilacb_{{$cb->co_cta}}" />
												@else
													<input type="checkbox" class="BtnModcuenta" id="idFilacb_{{$cb->co_cta}}" checked />
												@endif
						                  	</td>
						                </tr>
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
$('.BtnModcuenta').on('click',function(e) {
	var s1 = e.target.id.split('_');
    var id = s1[1];
	$.ajax({
      type:'POST',
      url:'./modcuenta',
      dataType: 'json', 
      encode  : true,
      data: {id : id },
      success:function(data) {
        if (data.msg != "") {
        	alert(data.msg);
        } 
      }
	});
});


</script>
@endpush

@endsection