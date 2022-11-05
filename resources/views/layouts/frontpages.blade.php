<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel Laratrust AdminPanel">
    <meta name="author" content="A. S. Md. Ferdousul Haque">
    <meta name="keyword" content="Laravel, Admin, Adminpanel, Laratrust, Bootstrap">
    <link rel="icon" href="#">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} || AdminPanel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    <div id="app">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <!-- <h3 class="masthead-brand">FrontPage</h3> 
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link active" href="#">Home</a>
                        <a class="nav-link" href="#">About</a>
                        <a class="nav-link" href="#">Contact</a>
                    </nav>-->
                </div>
            </header>

            @yield('content')

            <footer class="mastfoot mt-auto">
                <div class="inner">
                    <p>Larevel Laratrust Admin Panel</p>
                </div>
            </footer>
        </div>


        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

    </div>
</body>

</html>