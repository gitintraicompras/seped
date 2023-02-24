<!-- MENU PRINCIPAL  -->
<?php 
$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
$cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
?> 
 
<?php switch($cfg->styles):
    case ('GreenBlack'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleGreenBlack.css')); ?>"> 
      <?php break; ?>
    <?php case ('Orange'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleOrange.css')); ?>"> 
      <?php break; ?>
    <?php case ('Ground'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleGround.css')); ?>"> 
      <?php break; ?>
    <?php case ('RedGreen'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleRedGreen.css')); ?>"> 
      <?php break; ?>
    <?php case ('BlueGris'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleBlueGris.css')); ?>"> 
      <?php break; ?>
    <?php case ('White'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylewhite.css')); ?>"> 
      <?php break; ?>
    <?php case ('Blue'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleblue.css')); ?>"> 
      <?php break; ?>
    <?php case ('Red'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylered.css')); ?>"> 
      <?php break; ?>
    <?php case ('Pink'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylepink.css')); ?>"> 
      <?php break; ?>
    <?php case ('LightBlue'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylelightblue.css')); ?>"> 
      <?php break; ?>
    <?php case ('BlueGreen'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleblueGreen.css')); ?>"> 
      <?php break; ?>
    <?php case ('BlueYellow'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/styleblueYellow.css')); ?>"> 
      <?php break; ?>
    <?php case ('Green'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylegreen.css')); ?>"> 
      <?php break; ?>
    <?php default: ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/stylewhite.css')); ?>"> 
      <?php break; ?>
<?php endswitch; ?>












<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/styles.blade.php ENDPATH**/ ?>