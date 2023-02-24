@php $cfg = DB::table('cfg')->first(); @endphp
<div class="container">

    @if (Session::has('message'))
    <div class="alert alert-info alert-dismissable" 
        role="alert"
        style="border-radius: 10px 10px 10px 10px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong> {!! Session::get("message") !!} </strong>
    </div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-warning alert-dismissable" 
        role="alert"
        style="border-radius: 10px 10px 10px 10px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong> {!! Session::get("error") !!} </strong>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" 
                style="border-radius: 0px 0px 10px 10px;">
                <div class="panel-heading colorTitulo"
                    style="border-radius: 10px 10px 0px 0px;" >
                    <span>
                        <img src="{{asset('images/userCliente.png')}}" alt="seped" style="width:20px; height: 20px;">
                    </span>
                    Inicio de Sesión
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <center>
                            <a href="https://{{ $cfg->nomdominio }}">
                                <span>
                                    <img src="{{asset('images/logo.png')}}" alt="seped" class="tamLogoLogin" >
                                </span>
                            </a>
                        </center>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <h4 align="center">Intranet</h4>
                        
                            <label for="email" class="col-md-4 control-label">Usuario:</label>

                            <div class="col-md-6">
                                <input id="email" 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required autofocus 
                                    style="border-radius: 10px 10px 10px 10px;">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Clave:</label>

                            <div class="col-md-6">
                                <input id="password" 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    required
                                    style="border-radius: 10px 10px 10px 10px;">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <!--
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                    </label>
                                </div>
                                -->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn-normal">
                                    Ingresar
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>