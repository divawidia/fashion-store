<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> @yield('title') </title>
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/assets-user/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/style.css') }}" type="text/css">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
