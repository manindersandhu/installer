@extends('layouts.package') 
@section('content')
  <div class="card-body col-7 mx-auto text-center rounded mt-5">
       <h3>{{ __("Let's check PHP configuration :x ", ['x' => env('APP_NAME', '')]) }}</h3>
      <div class="col s4 pr-0">
          <h5>{{ __("Current PHP Version :current",['current'=> $phpSupportInfo['current'] ]) }}</h5>  
          <h5> {{ __("Required PHP Version :minimum",['minimum'=>$phpSupportInfo['minimum']]) }}<h5>
      </div>
      @if ($phpSupportInfo['supported'] )
        <a class="btn btn-primary" href="{{ url('install/database') }}">{{ __("Setup Database") }} </a> 
      @else
        <a class="btn btn-default"  href="#">{{ __("Version not matched!") }} </a> 
      @endif
  </div>
@endsection

 