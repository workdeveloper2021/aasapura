<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">

        <div class="card borderless">
            <div class="row align-items-center ">

                <div class="col-md-12">
                    <div class="card-body">
                        <img src="{{ url('uploads') }}/<?= site_logo() ?>" alt="" class="img-fluid mb-4">
                        <form action="{{ route('login_via_email_password') }}" method="post">
                            @csrf
                            <h4 class="mb-3 f-w-400">Signin</h4>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" id="Email"
                                    placeholder="Email address">
                                @error('email')
                                <div class="validation-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" class="form-control" id="Password"
                                    placeholder="Password">
                                @error('password')
                                <div class="validation-error">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('notmatched')
                            <div class="validation-error text-center">{{ $message }}</div>
                            <br>
                            @enderror
                            @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            <button class="btn btn-block btn-primary mb-4" id="submitbutton">Signin</button>
                            <hr>
                            <p class="mb-2 text-muted">Forgot password? <a href="/reset-password"
                                    class="f-w-400">Reset</a>
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Required Js -->
<!-- Required Js -->
<script src="{{ url('admin/') }}/assets/js/jquery.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/vendor-all.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/pcoded.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/form.js"></script>

<script>
    $("#submitbutton").click(function (e) {
    $(this).html("Verifying....");
});

</script>
</body>

</html>