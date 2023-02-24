@extends ('layouts.menu')
@section ('contenido')

 
{!!Form::model($tabla,['method'=>'PATCH','route'=>['clientes.update',$tabla->codcli]])!!}
{{Form::token()}}

<div class="row">
    <div class="form-group">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->codcli}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" readonly="" value="{{$tabla->nombre}}" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Limite de crédito</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->limite, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Saldo</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->saldo, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Vencido</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->vencido, 2, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Días de crédito</label>
                <input type="text" class="form-control" readonly="" value="{{number_format($tabla->dcredito, 0, '.', ',')}}" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Status</label>
                <select name="estado" class="form-control">
                    @if ($tabla->estado == 'ACTIVO')
                        <option value="ACTIVO" selected>ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    @else
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO" selected>INACTIVO</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group" style="padding-top: 25px;">
                <div class="form-check">
                    <input type="checkbox" name="critSepMoneda" 
                    @if ($tabla->critSepMoneda) checked @endif />
                    <span class="text">Activar separación de pedidos por tipo de moneda del producto</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>
                    Función
                    </small>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group" style="padding-top: 25px;">
                <div class="form-check">
                    <input type="checkbox" name="codisbactivo" 
                    @if ($tabla->codisbactivo) checked @endif />
                    <span class="text">Activar cliente para la Sucursal</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>
                    Función
                    </small>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group" style="margin-top: 20px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>

{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection