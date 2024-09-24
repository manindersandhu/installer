@extends('layouts.package') 
@section('content')
  <div class="card-body col-7 mx-auto text-center rounded mt-5">
      <h2 >{{ env('APP_NAME', '') }}</h2>
      <h3>{{ __("Welcome to :x installer", ['x' => env('APP_NAME', '')]) }}</h3>
      <p >{{ __("Just 2 setups to install") }}</p>
      <a class="btn  btn-primary" href="{{ url('install/requirements') }}">{{ __("Setup Now") }} </a> 
  </div>
@endsection