<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventOrganization | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets")}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#" style="color: #0a0e14"><b style="color: #0c84ff;">EventOrganization |</b>LogIn</a>
    </div>

    <!--for validation of form-->
    @if(count($errors) > 0)
        <div id="error" class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            @foreach($errors->all() as $error)
                <div class="msg">{{$error}}</div>
            @endforeach
        </div>
    @endif

    @if(Session::get('error_msg'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{Session::get('error_msg')}}
        </div>
    @elseif(Session::get('success_msg'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success !</h4>
            {{Session::get('success_msg')}}
        </div>
@endif

<!--end of validation-->
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
{{--            <form action="{{url('verify-login')}}"  id="quickForm"method="post">--}}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group has-feedback">
                    <p style="text-align:center;"><i class="fas fa-drumstick-bite fa-3x" style="color: brown;"></i><span style="font-size: 25px;color: #0c84ff;">EventOrganization</span></p>
                </div>
                <div class="form-group has-feedback ">
                    <input type="email" name="email" class="form-control" required="" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" required="" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                        </div>
                    </div>
                </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <a  href="{{route('payment')}}" class="btn btn-primary btn-block">Sign In</a>
                    </div>
                    <!-- /.col -->
{{--            </form>--}}
        </div>
            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("assets")}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets")}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--Validation-->
<script src="{{asset("assets")}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset("assets")}}/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(function () {
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                remember: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                remember: "Please accept our terms"
            },
        });
    });
</script>

</body>
</html>

