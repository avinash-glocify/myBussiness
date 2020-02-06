<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <link href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <style>
  .invalid-feedback {
    display: block;
  }
  </style>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
</head>
<body>
  <div id="app">
    <div class="container-scroller">
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
          @yield('content')
          @include('layouts.footer')
          @yield('extra_script')
        </div>
      </div>
    </div>
    @if(Session::has('error'))
      <script>
      const text = "{{ Session::get('error') }}";
      swal({
        title: "Something Went Wrong",
        text: text,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      });
      </script>
    @endif
    @if(Session::has('success'))
      <script>
      const text = "{{ Session::get('success') }}";
      swal({
        title: "Good job!",
        text: text,
        icon: "success",
      });
      </script>
    @endif
  </div>
</body>
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/SimpleTableCellEditor.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script src="{{ asset('js/theme/template.js') }}"></script>

<script src="{{ asset('js/custom.js') }}" defer></script>
<script src="{{ asset('js/common.js') }}" defer></script>
</html>
