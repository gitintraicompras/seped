{!! Form::open(array('url'=>'/seped/factura','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="input-group" >
   <span class="input-group-addon hidden-xs">Fecha:</span>
   <span class="input-group-btn">
   	<input type="date" name="desde" class="form-control" value="{{date('Y-m-d', strtotime($desde))}}">
   </span>
   <span class="input-group-addon" style="border:0px; "></span>
   <span class="input-group-btn">
   	<input type="date" name="hasta" class="form-control" value="{{date('Y-m-d', strtotime($hasta))}}">
   </span>
   <span class="input-group-btn">
   	<button type="submit" class="btn btn-default btn-buscar" data-toggle="tooltip" title="Filtrar por fecha">
         <span class="fa fa-search" aria-hidden="true"></span>
      </button>
   </span>
</div>
{{ Form::close() }}