@extends('layouts.package')
@section('content')
<div class="card-body col-7 mx-auto text-center rounded mt-5">
  <h3>{{ __("Generate and connecting with database") }}</h3>
  <p>{{ __("This process takes a little bit of time. Please be patient!") }}</p>
  <button class="btn  btn-primary" id="generateBtn" type="button">Generate </button>
</div>
@endsection

@section('page-script')
<script src="{{ asset('js/menu-drop.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#generateBtn').on('click', function() {
      $('#generateBtn').text('Loading ');
      $('#generateBtn').prop('disabled', true);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{url('install/seedmigrate')}}",
        type: "GET",
        success: function(response) {
          window.location.href = "{{url('/')}}";
        },
        error: function(response) {
          alert("Opps something wrong!!");
          $('#generateBtn').text('Generate Tables and data');
          $('#generateBtn').prop('disabled', false);
        },
      });
    });
  });
</script>
@endsection