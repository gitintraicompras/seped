@extends ('layouts.menu')
@section ('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">PROVEEDOR</a></li>
              <li><a href="#tab_2" data-toggle="tab">{{strtoupper($cfg->nomcorto)}}</a></li>
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
                                <input type="text" class="form-control" readonly="" value="{{$marca->codmarca}}" style="background: #f7f7f7">
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
