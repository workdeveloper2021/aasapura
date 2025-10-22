@extends('front.common.layout')
@section('title','Forgot Password | Aashapura')
@section('content')



<style>
.forgot-card {
    border-radius: 12px;
    background: #ffffff;
    transition: all 0.3s ease;
}
.forgot-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}
.btn-primary {
    border-radius: 25px;
    padding: 10px;
    font-weight: 600;
}
input.form-control {
    height: 45px;
    border-radius: 8px;
}
.page-title {
    font-weight: 700;
    color: #333;
}
.validation-error{
    color:red;
}
</style>
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Change Password</h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </div>
    </nav>

    <div class="page-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card forgot-card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h3 class="font-weight-bold text-primary">Change Password</h3>
                                <p class="text-muted small">Enter your new password below.</p>
                            </div>
                        <form method="post">
                            @csrf
                            <hr>

                            <div class="form-group mb-3">
                                <input type="text" name="password" class="form-control" id="Email"
                                    placeholder="New Password">
                                @error('password')
                                <div class="validation-error">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <input type="text" name="confirm_password" class="form-control" id="Email"
                                    placeholder="Confirm Password">
                                @error('confirm_password')
                                <div class="validation-error">{{ $message }}</div>
                                @enderror
                            </div>


                            @error('notmatched')
                            <div class="validation-error text-center">{{ $message }}</div>
                            <br>
                            @enderror
                            @if(Session::has('successmailsend'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('successmailsend') }}
                            </div>
                            @endif
                            <button type="submit" id="submitbutton" class="btn btn-block btn-primary mb-4">Send</button>
                            <hr>
                        </form>
                            <div class="text-center mt-4">
                                <a href="/" class="text-decoration-none">Back to Login</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <small class="text-muted">Having trouble? <a href="/contact" class="text-primary">Contact Support</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
