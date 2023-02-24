{!! Form::open(array('url'=>'/seped/pedcrisep','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group" style="float: right;">
	<div class="input-group">
		<input type="text" name="filtro" class="form-control" placeholder="Buscar"  value="{{$filtro}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default btn-buscar" data-toggle="tooltip" title="Buscar criterio">
				<span class="fa fa-search" aria-hidden="true"></span>
			</button>
		</span>
	</div>
</div>
{{ Form::close() }}