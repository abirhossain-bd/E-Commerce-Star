<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('admin_panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <!-- NProgress -->

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin_panel/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ env('APP_Name') }}</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('uploads/default/default user.jpg') }}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->


                    @include('admin_panel.layouts.sidebar')

                    <!-- sidebar menu -->


                </div>
            </div>


            @include('admin_panel.layouts.navigation')





            <!-- page content -->
            <div class="right_col" role="main">


                @yield('content')

            </div>
            <!-- /page content -->





            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    {{ env('APP_NAME') }} - Bootstrap Admin Template by <a target="blank" href="https://www.linkedin.com/in/dev-abir/">Abir</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin_panel/js/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('admin_panel/js/bootstrap.bundle.min.js') }}"></script>


    <!-- Custom Theme Scripts -->
    <script src="{{ asset('admin_panel/js/custom.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
