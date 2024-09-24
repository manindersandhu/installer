@extends('layouts.package')
@section('content')

<div class="card-body col-6 mx-auto text-center rounded mt-5">
    <h2>{{ __("Databse Settings") }}</h2>
    <form method="post" action="{{ url('install/database') }}">
        {{ csrf_field() }}
        <div class="col-12 float-left text-left mb-2">
            <label for="dbname">{{ __("Databse Name") }}</label>
            <input class="form-control" type="text" id="dbname" name="dbname" value="{{ $database }}" required>
        </div>
        <div class="col-12 float-left text-left mb-2">
            <label for="username">{{ __("Database User") }}</label>
            <input class="form-control" type="text" id="username" name="username" value="{{ $username }}" required>
        </div>
        <div class="col-12 float-left text-left mb-2">
            <label for="password">{{ __("Database Password") }}</label>
            <input class="form-control" type="text" id="password" name="password" value="{{ $password }}">
        </div>
        <div class="col-12 float-left text-left mb-2">
            <label for="port">{{ __("Databse Port") }}</label>
            <input class="form-control" type="text" id="port" name="port" value="{{ $port }}" required>
        </div>
        <div class="col-12 float-left text-left mb-2">
            <label for="host">{{ __("Host Name") }}</label>
            <input class="form-control" type="text" id="host" name="host" value="{{ $host }}" required>
        </div>

        <button class="btn  btn-primary" type="submit" >{{ __("Save Changes") }} </button>

    </form>
</div>
@endsection