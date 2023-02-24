<!-- MENU PRINCIPAL  -->
@php 
$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
$cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
@endphp 
 
@switch($cfg->styles)
    @case('GreenBlack')
      <link rel="stylesheet" href="{{asset('css/styleGreenBlack.css')}}"> 
      @break
    @case('Orange')
      <link rel="stylesheet" href="{{asset('css/styleOrange.css')}}"> 
      @break
    @case('Ground')
      <link rel="stylesheet" href="{{asset('css/styleGround.css')}}"> 
      @break
    @case('RedGreen')
      <link rel="stylesheet" href="{{asset('css/styleRedGreen.css')}}"> 
      @break
    @case('BlueGris')
      <link rel="stylesheet" href="{{asset('css/styleBlueGris.css')}}"> 
      @break
    @case('White')
      <link rel="stylesheet" href="{{asset('css/stylewhite.css')}}"> 
      @break
    @case('Blue')
      <link rel="stylesheet" href="{{asset('css/styleblue.css')}}"> 
      @break
    @case('Red')
      <link rel="stylesheet" href="{{asset('css/stylered.css')}}"> 
      @break
    @case('Pink')
      <link rel="stylesheet" href="{{asset('css/stylepink.css')}}"> 
      @break
    @case('LightBlue')
      <link rel="stylesheet" href="{{asset('css/stylelightblue.css')}}"> 
      @break
    @case('BlueGreen')
      <link rel="stylesheet" href="{{asset('css/styleblueGreen.css')}}"> 
      @break
    @case('BlueYellow')
      <link rel="stylesheet" href="{{asset('css/styleblueYellow.css')}}"> 
      @break
    @case('Green')
      <link rel="stylesheet" href="{{asset('css/stylegreen.css')}}"> 
      @break
    @default
      <link rel="stylesheet" href="{{asset('css/stylewhite.css')}}"> 
      @break
@endswitch












