<!-- BUSCAR FACTURA -->
{!! Form::open(array('url'=>'/seped/report/resumen','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group" style="margin-left: 0px; width: 100px;">
 	   	<span class="input-group-addon">Fecha:</span>
	   	<span class="input-group-btn">
   			<input type="date" name="desde" class="form-control" value="{{date('Y-m-d', strtotime($desde))}}">
	   	</span>
	   	<span class="input-group-addon" style="border:0px; "></span>
	   	<span class="input-group-btn">
	   		<input type="date" name="hasta" class="form-control" value="{{date('Y-m-d', strtotime($hasta))}}">
	   	</span>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default btn-buscar">
				<span class="fa fa-search" aria-hidden="true"></span>
			</button>
		</span>
	</div>
</div>
{{ Form::close() }}


