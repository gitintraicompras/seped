<?php $cfg = DB::table('cfg')->first(); ?>
<div class="container">

    <?php if(Session::has('message')): ?>
    <div class="alert alert-info alert-dismissable" 
        role="alert"
        style="border-radius: 10px 10px 10px 10px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong> <?php echo Session::get("message"); ?> </strong>
    </div>
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
    <div class="alert alert-warning alert-dismissable" 
        role="alert"
        style="border-radius: 10px 10px 10px 10px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong> <?php echo Session::get("error"); ?> </strong>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" 
                style="border-radius: 0px 0px 10px 10px;">
                <div class="panel-heading colorTitulo"
                    style="border-radius: 10px 10px 0px 0px;" >
                    <span>
                        <img src="<?php echo e(asset('images/userCliente.png')); ?>" alt="seped" style="width:20px; height: 20px;">
                    </span>
                    Inicio de Sesión
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <center>
                            <a href="https://<?php echo e($cfg->nomdominio); ?>">
                                <span>
                                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="seped" class="tamLogoLogin" >
                                </span>
                            </a>
                        </center>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <h4 align="center">Intranet</h4>
                        
                            <label for="email" class="col-md-4 control-label">Usuario:</label>

                            <div class="col-md-6">
                                <input id="email" 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    value="<?php echo e(old('email')); ?>" 
                                    required autofocus 
                                    style="border-radius: 10px 10px 10px 10px;">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Clave:</label>

                            <div class="col-md-6">
                                <input id="password" 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    required
                                    style="border-radius: 10px 10px 10px 10px;">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <!--
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Recuerdame
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
</div><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/login.blade.php ENDPATH**/ ?>