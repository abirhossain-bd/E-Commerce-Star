<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} </title>

    <link href="{{ asset('admin_panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <!-- NProgress -->

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin_panel/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>

        <div class="login_wrapper">


            <div id="register" class="animate form ">
                <section class="login_content">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <h1>Create Account</h1>
                        <div>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}" />
                            @error('name')
                                <span class="invalid-feedback text-danger mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}" />
                            @error('email')
                                <span class="invalid-feedback text-danger mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                            @error('password')
                                <span class="invalid-feedback text-danger mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" style="color:white" class="btn btn-dark">Submit</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="{{ route('login') }}" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> {{ env('APP_NAME') }}</h1>
                                <p>©2016 All Rights Reserved. {{ env('APP_NAME') }} is a Bootstrap 4 template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
