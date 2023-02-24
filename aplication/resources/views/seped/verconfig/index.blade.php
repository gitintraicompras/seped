@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">CLIENTE1</a></li>
              <li>
                <a href="#tab_2" data-toggle="tab">
                    {{strtoupper($cfg->nomcorto)}} - ({{strtoupper($cfg->SedeSucursal)}})
                </a>
              </li>
              <li><a href="#tab_3" data-toggle="tab">CUENTAS BANCARIAS</a></li>
              <li class="pull-right">
                <a href="{{url('/home')}}" class="text-muted">
                    <i class="fa fa-window-close-o"></i>
                </a>
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->codcli}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->direccion}}" style="background: #f7f7f7" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Rif</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->rif}}" style="background: #f7f7f7" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->telefono}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Contacto</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->contacto}}" style="background: #f7f7f7" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Vendedor</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->zona}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->estado}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Agenda</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->agenda}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Días crédito</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->dcredito}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>{{$cfg->msgLitDc}}</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->dcomercial}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Limite crédito</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->limite,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Saldo</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->saldo,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Vencido</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->vencido,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Saldo Disponible</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->limite - $cli->saldo,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>{{$cfg->msgLitPp}}</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->ppago,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>{{$cfg->msgLitDi}}</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($cli->dinternet,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;" >
                            </div>
                        </div>
                        @php
                        $dvp = 0.00;
                        if (!empty($cli->DctoPreferencial)) {
                            $data = MesActivoPreferencial($cli->DctoPreferencial);
                            $dvp = $data['dcto'];
                        }
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Descuento preferencial VIP</label>
                                <input type="text" class="form-control" readonly="" value="{{number_format($dvp,2, '.', ',')}}" style="text-align: right; background: #f7f7f7;" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Tipo de precio</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->usaprecio}}" style="text-align: right; background: #f7f7f7;" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" class="form-control" readonly="" value="{{$cli->email}}"  style="background: #f7f7f7">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">

                         <!-- NOMBRE -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->nombre}}"  style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- RIF -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Rif.</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->rif}}" style="background: #f7f7f7" >
                            </div>
                        </div>

                        <!-- DIRECCION -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->direccion}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- LOCALIDAD -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Localidad</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->localidad}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- CONTACTO -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Contacto</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->contacto}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- TELEFONO -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->telefono}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- CORREO -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Correo contacto</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->correo}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- CORREO DE PAGOS -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Correo crédito y cobranza</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->correoPago}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- CORREO DE RECLAMOS -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Correo reclamos y devoluciones</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->correoReclamo}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- FACEBOOK -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->facebook}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- INSTAGRAM -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->instagram}}" style="background: #f7f7f7">
                            </div>
                        </div>

                        <!-- TWITTER -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" class="form-control" readonly value="{{$cfg->twitter}}" style="background: #f7f7f7">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead class="colorTitulo">
                                    <th>BANCO</th>
                                    <th>NUMERO DE CUENTA</th>
                                </thead>
                                @foreach ($ctabanco as $cb)
                                <tr>
                                    <td>{{$cb->co_banco}}</td>
                                    <td>{{$cb->num_cuenta}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="form-group" style="margin-top: 20px; margin-left: 15px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection
