<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'CPP BANGLADESH') }}</title>




    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer="defer"></script> --}}

    <!-- Favicon-->
    <link rel="icon" href="{{ URL::asset('assets/dashboard/images/eerna-faviconu.ico') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('assets/dashboard/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('assets/dashboard/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('assets/dashboard/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/DataTables-1.10.21/css/dataTables.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/css/buttons.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/FixedHeader-3.1.7/css/fixedHeader.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/KeyTable-2.5.2/css/keyTable.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/Scroller-2.0.2/css/scroller.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/plugins/datatable/SearchPanes-1.1.1/css/searchPanes.bootstrap.min.css')}}" />
    <!-- Custom Css -->
    <link href="{{asset('assets/dashboard/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('assets/dashboard/css/themes/all-themes.css')}}" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/dashboard/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <!-- Dropzone Css -->
    <link href="{{asset('assets/dashboard/plugins/dropzone/dropzone.css')}}" rel="stylesheet">

    <!-- Bootstrap DatePicker Css -->
    <link href="{{asset('assets/dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />

    @stack('css')

</head>

@section('name')

<body class="theme-blue">
    @section('title','Dashboard')
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('layouts.dashboard.partial.topbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('layouts.dashboard.partial.sidebar')
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('assets/dashboard/js/admin.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/pages/index.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('assets/dashboard/js/demo.js')}}"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/JSZip-2.5.0/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/DataTables-1.10.21/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/js/buttons.flash.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Buttons-1.6.2/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/FixedHeader-3.1.7/js/dataTables.fixedHeader.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/KeyTable-2.5.2/js/dataTables.keyTable.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/Scroller-2.0.2/js/dataTables.scroller.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/SearchPanes-1.1.1/js/dataTables.searchPanes.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/plugins/datatable/SearchPanes-1.1.1/js/searchPanes.bootstrap.min.js')}}"></script>
    <!-- Select Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('assets/dashboard/js/pages/ui/dialogs.js')}}"></script>

    <!-- Dropzone Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/dropzone/dropzone.js')}}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{asset('assets/dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

    <script>
        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        //BS-DatePicker
        $('#datepicker-container input').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            container: '#datepicker-container'
        });

        $('#bs_datepicker_container input').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            container: '#bs_datepicker_container',
            endDate: '+0d'
        });

        $('#device_purchase_datepicker_container input').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
            container: '#device_purchase_datepicker_container',
            startDate: '-300d',
            endDate: '+0d'
        });
    </script>

    @stack('js')

</body>

</html>