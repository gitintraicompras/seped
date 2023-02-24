@extends ('layouts.menu')
@section ('contenido')

{!! Form::open(array('action'=>array('AdpromdiasController@grabar','method'=>'POST','autocomplete'=>'off'))) !!}
{{ Form::token() }}
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label>Id</label>
            <input readonly 
                type="text" 
                class="form-control" 
                name="id" 
                value="{{$promdias->id}}" 
                style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

	<div class="col-xs-8">
		<div class="form-group">
	        <label>Nombre</label>
            <input type="text" 
                class="form-control" 
                name="descrip" 
                value="{{ $promdias->descrip}}" >
 	    </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Dias</label>
            <input type="text" 
                class="form-control" 
                name="dias" 
                value="{{$promdias->dias}}" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Desde</label>
            <input type="date" 
                class="form-control" 
                name="desde" 
                value="{{$promdias->desde}}" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Hasta</label>
            <input type="date" 
                class="form-control" 
                name="hasta" 
                value="{{ $promdias->hasta}}" >
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            <label>Status</label>
            <select name="estado" class="form-control">
                <option value="ACTIVO" 
                    @if ($promdias->estado == 'ACTIVO') selected @endif >
                    ACTIVO
                </option>
                <option value="INACTIVO" 
                    @if ($promdias->estado == 'INACTIVO') selected @endif>
                    INACTIVO
                </option>
            </select>
        </div>
    </div>

    <div class="modal-footer" style="margin-right: 20px;">
        <a href="{{url('/home')}}" class="text-muted">
            <button type="button" class="btn-normal">Regresar</button>
        </a>
        <button type="submit" class="btn-confirmar">Confirmar</button>
    </div>
</div>
{{Form::Close()}}

<div class="row" style="margin-bottom: 10px;"> 
    <div class="col-xs-12">
    

        <!-- AGREGAR PRODUCTO NUEVO -->
        <a href="" 
            data-target="#modal-agregar-{{$id}}" 
            data-toggle="modal">
            <button style="width: 90px; height: 34px; border-radius: 5px;" 
                type="button" 
                data-toggle="tooltip" 
                title="Agregar producto a la promoción" 
                class="btn-catalogo">
                Agregar
            </button>
        </a>

        <div class="modal fade modal-slide-in-right" 
            aria-hidden="true" 
            role="dialog" 
            tabindex="-1" 
            id="modal-promren-{{$promdias->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header colorTitulo">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        <h4 class="modal-title">NUEVO PRODUCTO</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" name="id" readonly value="{{$promdias->id}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Promoción</label>
                                <input type="text" readonly value="{{$promdias->descrip}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12" >
                            <div class="form-group">
                                <label>Productos</label>
                                <select name="codprod" class="form-control selectpicker" data-live-search="true">
                                    @foreach($producto as $p)
                                    <option style="width: 520px;" 
                                        value="{{$p->codprod}} | {{$p->desprod}} | {{$p->marcamodelo}} |">
                                        {{$p->codprod}} | {{$p->desprod}} | {{$p->marcamodelo}} |
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-right: 20px;">
                        <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
                        <button type="submit" class="btn-confirmar">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@include('seped.promdias.agregar')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th style="width: 50px;">#</th>
                    <th style="width: 50px;"></th>
                    <th style="width: 50px;">CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>MARCA</th>
                    <th>SUCURSAL</th>
                </thead>
                @foreach ($promren as $pr)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a href="" 
                            data-target="#modal-delete-{{$pr->id}}-{{$pr->codprod}}-{{$pr->codisb}}" 
                            data-toggle="modal">
                            <button 
                                class="btn btn-default btn-pedido fa fa-trash-o" 
                                title="Eliminar producto">
                            </button>
                        </a>
                    </td>
                    <td>{{$pr->codprod}}</td>
                    <td>{{$pr->desprod}}</td>
                    <td>{{$pr->marca}}</td>
                    <td>{{sLeercfg($pr->codisb, "SedeSucursal")}}</td>
                </tr>
                @include('seped.promdias.delprod')
                @endforeach
            </table>
        </div>
    </div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');

function cargarProd() {
    var resp;
    var filtro = $('#idfiltro').val();
    if (filtro == "") {
        alert("FALTAN PARAMETROS PARA REALIZAR LAS BUSQUEDA");
    } else {
        var jqxhr = $.ajax({
            type:'POST',
            url: '../cargarprod',
            dataType: 'json', 
            encode  : true,
            data: { filtro:filtro },

            success:function(data) {
                $("#tbodyProducto").empty();
                $.each(data.resp, function(index, item){
                   var valor = 
                    '<tr>' +
                      "<td style='padding-top: 10px;'>" +
                      "<span onclick='tdclick(event);'>" +
                      "<center>" +
                      "<input name='tdcheck[" + item.codprod + "]' type='checkbox' id='idcheck_" + item.codprod + "' />" +
                      "</center>" +
                      "</span>" +
                      "</td>" +
                      "<td>" + item.desprod + "</td>" +
                      "<td>" + item.codprod + "</td>" +
                      "<td>" + item.barra + "</td>" +
                      "<td>" + item.marcamodelo + "</td>" +
                    "</tr>";
                    $(valor).appendTo("#tbodyProducto");
                });
            }
        });
    }
}

function ejecutarAgregarbORRAR() {

    //$codprod = trim($s1[0]);
    //$desprod = trim($s1[1]);
    //$marca = trim($s1[2]);  

    var id = '{{$id}}';
    var tdcheck = $('#tdcheck').val();

    alert(tdcheck);

    var barra = $('#idcodprod').val();
    var ctipo = id + "_"+ codprod +"_"+ barra;
    alert(ctipo);
    if (codprod == '') {
        alert("FALTAN PARAMETROS PARA AGREGAR UN PRODUCTO");
    } else {
        var url = "{{url('/seped/promdias/agregarprod/X')}}";
        url = url.replace('X', ctipo);
        window.location.href=url;
    }
}


</script>
@endpush

@endsection