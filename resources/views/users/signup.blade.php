<!DOCTYPE html>
<html lang="en">

<head>

    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('admin/') }}/assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ url('admin/') }}/assets/css/style.css">




</head>

<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <div class="card borderless">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <img src="{{ url('') }}/admin/logo/logo.png" alt="" class="img-fluid mb-4">

                        <h4 class="f-w-400">Sign up</h4>
                        <hr>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="Username" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="Email" placeholder="Email address">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control" id="Password" placeholder="Password">
                        </div>
                        <div class="custom-control custom-checkbox  text-left mb-4 mt-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Send me the <a href="#!">
                                    Newsletter</a> weekly.</label>
                        </div>
                        <button class="btn btn-primary btn-block mb-4">Sign up</button>
                        <hr>
                        <p class="mb-2">Already have an account? <a href="auth-signin.html" class="f-w-400">Signin</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="{{ url('admin/') }}/assets/js/vendor-all.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/plugins/bootstrap.min.js"></script>

<script src="{{ url('admin/') }}/assets/js/pcoded.min.js"></script>



</body>

</html>