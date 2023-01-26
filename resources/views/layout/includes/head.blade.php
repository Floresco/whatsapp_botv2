<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Fonts -->
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<title>{{$title ?? 'Home Page'}}</title>

<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

<!-- jsvectormap css -->
<link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>

<!--Swiper slider css-->
<link href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css"/>

<!-- Layout config Js -->
<!-- Bootstrap Css -->
<link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Icons Css -->
<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- App Css-->
<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- custom Css-->
<link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>

