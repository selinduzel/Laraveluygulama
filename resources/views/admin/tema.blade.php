<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminn')}}/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="{{ asset('adminn')}}/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
   
    <!-- Custom Stylesheet -->
    <link href="{{ asset('adminn')}}/css/style.css" rel="stylesheet">
    @yield('css')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    @include('admin.data.ust')

    @include('admin.data.menu')

    @include('admin.data.footer')

    @yield('master')




       
        
        
     
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('adminn')}}/plugins/common/common.min.js"></script>
    <script src="{{ asset('adminn')}}/js/custom.min.js"></script>
    <script src="{{ asset('adminn')}}/js/settings.js"></script>
    <script src="{{ asset('adminn')}}/js/gleek.js"></script>
    <script src="{{ asset('adminn')}}/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src=".{{ asset('adminn')}}/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="{{ asset('adminn')}}/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="{{ asset('adminn')}}/plugins/d3v3/index.js"></script>
    <script src="{{ asset('adminn')}}/plugins/topojson/topojson.min.js"></script>
    <script src="{{ asset('adminn')}}/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('adminn')}}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('adminn')}}/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('adminn')}}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('adminn')}}/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    @yield('js')
  

</body>

</html>