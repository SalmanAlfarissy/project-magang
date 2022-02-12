<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MAGANG GCI | Magang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"/>
  {{-- css --}}
  @include('layouts.css.table')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    {{-- header --}}
  @include('layouts.header.header')

  {{-- sidebar --}}
  @include('layouts.sidebar.sidebar')

    {{-- content --}}
  @yield('content')

  @include('layouts.footer.footer')

  {{-- sidebar controller --}}
  @include('layouts.sidebar.control')
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
{{-- js --}}

</body>
</html>
