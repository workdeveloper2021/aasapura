@section('title','Auditor - Dashboard')
@extends('auditor.common')
@section('content')
<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
        object-fit: contain;
    }

    .success_button {
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
    }

    .table thead th {
    color: #554;
    border-bottom-width: 1px;
    width: 50%;
}


.products_images img {
        margin-right: 10px;
        width: 70px;
        border: 1px solid #eee;
        padding: 6px;
        height: 70px;
        object-fit: contain;
    }
    .bouded_12 {
        width: 15px;
        height: 15px;
        display: inline-block;
        border-radius: 100%;
    }
</style>


<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">My Profile</h4>
            @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="/auditor/updateprofile" method="post">
                                        @csrf
                                    <div class="basic-details">
                                        <h6>User Information</h6>

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" placeholder="Name" value="{{ Auth::user()->name }}" name="name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label for="name">Phone</label>
                                            <input type="text" name="phone" placeholder="Phone" value="{{ Auth::user()->phone }}" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <textarea name="address"  rows="3" class="form-control">{{ Auth::user()->address_1 }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-md-6 mt-4 mt-md-0">

                                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                    <form action="/auditor/updatepassword" method="post">
                                        @csrf
                                    <div class="basic-details">
                                        <h6>Change Password</h6>

                                        <div class="form-group">
                                            <label for="name">Currunt Password</label>
                                            <input type="text" placeholder="Password" name="currunt_password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">New Password</label>
                                            <input type="password" placeholder="New Password" name="new_password" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label for="name">Password Confirmation</label>
                                            <input type="password" name="new_password_confirmation" placeholder="Confirm Password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


@endsection
