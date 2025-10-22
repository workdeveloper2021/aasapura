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
                        <img src="{{ url('') }}/admin/logo/logo.png" alt="" class="img-fluid mb-4">

                        <form action="{{ route('resetpassword') }}" method="post">
                            @csrf
                            <h4 class="mb-3 f-w-400">Recover Account</h4>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" id="Email"
                                    placeholder="Email address">
                                @error('email')
                                <div class="validation-error">{{ $message }}</div>
                                @enderror
                            </div>
                         
                            @if(Session::has('successmailsend'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('successmailsend') }}
                            </div>
                            @endif
                          
                          
                            @if(Session::has('notmatched'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('notmatched') }}
                            </div>
                            @endif
                            <button type="submit" id="submitbutton" class="btn btn-block btn-primary mb-4">Send</button>
                            <hr>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Required Js -->
<script src="{{ url('admin/') }}/assets/js/jquery.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/vendor-all.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/pcoded.min.js"></script>
<script src="{{ url('admin/') }}/assets/js/form.js"></script>

<script>
    $("#submitbutton").click(function (e) {
    $(this).html("Sending Reset Link....");
});

</script>
</body>

</html>