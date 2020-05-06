<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name','HRIS')}}</title>
    {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="/asset/css/main_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link rel="stylesheet" href="/asset/css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/asset/css/typicons_icons/typicons.min.css">
    {{-- <link rel="stylesheet" href="../../public/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="/asset/css/datatables.min.css">

    <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="/asset/css/dataTables.bootstrap4.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> --}}
</head>
<body style="background:#f9f9f9">

{{-- {{ session('roleId') }} --}}
@if (session('roleId') == '3')
    @include('Navbar.Navbar')
    @yield('content')
@endif
@if (session('roleId') == '2')
    @include('Navbar.Navbar')
    @yield('content')
@endif
@if (session('roleId') == '1')
    @include('Navbar.Navbar')
    @yield('content')
@endif

</body>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script> --}}
{{-- <script src="../../public/js/jquery-3.2.1.slim.min.js"></script> --}}
<script src="/asset/js/jquery_341.min.js"></script>
<script src="/asset/js/bootsrap4.min.js"></script>
{{-- <script src="../../public/js/jquery-3.2.1.slim.min.js"></script> --}}
{{-- <script src="/asset/js/jquery.js"></script> --}}
<script src="/asset/js/datatables.min.js"></script>
<script src="/asset/js/parsley.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@yield('scriptcontent')
{{-- <script src="/asset/js/bootstrap.min.js"></script> --}}
{{-- <script src="/js/datatable-basic.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> --}}

</html>
