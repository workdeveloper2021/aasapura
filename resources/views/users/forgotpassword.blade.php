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
</style>
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Forgot Password</h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
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
                                <h3 class="font-weight-bold text-primary">Reset Your Password</h3>
                                <p class="text-muted small">Enter your registered email address to receive a password reset link.</p>
                            </div>

                            <form method="POST" action="{{ route('resetpassword') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="text-danger small">{{ $errors->first('email') }}</span>
                                    @endif

                                    @if (session('successmailsend'))
                                        <div class="alert alert-success mt-3" role="alert">
                                            {{ session('successmailsend') }}
                                        </div>
                                    @endif
                                   
                                   
                                    @if (session('notmatched'))
                                        <div class="alert alert-danger mt-3" role="alert">
                                            {{ session('notmatched') }}
                                        </div>
                                    @endif

                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-3">Send Reset Link</button>
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
