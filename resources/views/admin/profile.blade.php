@section('title','Dashboard - Profile')

@extends('admin.layout.layout')
@section('content')

<style>
    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .user-card {
        display: flex;
        flex-direction: column;
        align-items: center !important;
        justify-content: start;
        background-color: #fff;
        border-radius: 10px;
        padding: 40px;
        width: 100%;
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 20px -5px rgba(0, 0, 0, 0.5);
    }

    .user-card:before {
        content: '';
        position: absolute;
        height: 300%;
        width: 173px;
        background: #262626;
        top: -60px;
        left: -125px;
        z-index: 0;
        transform: rotate(17deg);
    }

    .user-card-img {
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 3;
    }

    .user-card-img img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
    }

    .user-card-info {
        text-align: center;
    }

    .user-card-info h2 {
        font-size: 24px;
        margin: 0;
        margin-bottom: 10px;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 3px;
    }

    .user-card-info p {
        font-size: 14px;
        margin-bottom: 2px;
    }

    .user-card-info p span {
        font-weight: 700;
        margin-right: 10px;
    }

    @media only screen and (min-width: 768px) {
        .user-card {
            flex-direction: row;
            align-items: flex-start;
        }

        .user-card-img {
            margin-right: 20px;
            margin-bottom: 0;
        }

        .user-card-info {
            text-align: left;
        }
    }

    @media (max-width: 767px) {
        .wrapper {
            padding-top: 3%;
        }

        .user-card:before {
            width: 300%;
            height: 200px;
            transform: rotate(0);
        }

        .user-card-info h2 {
            margin-top: 25px;
            font-size: 35px;
        }

        .user-card-info p span {
            display: block;
            margin-bottom: 15px;
            font-size: 18px;
        }
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-12">
                <div class="wrapper">
                    <div class="user-card mb-3">
                        <div class="user-card-img">
                            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjxivAs4UknzmDfLBXGMxQkayiZDhR2ftB4jcIV7LEnIEStiUyMygioZnbLXCAND-I_xWQpVp0jv-dv9NVNbuKn4sNpXYtLIJk2-IOdWQNpC2Ldapnljifu0pnQqAWU848Ja4lT9ugQex-nwECEh3a96GXwiRXlnGEE6FFF_tKm66IGe3fzmLaVIoNL/s1600/img_avatar.png"
                                alt="">
                        </div>
                        <div class="user-card-info">
                            <h2>{{ Auth::user()->name }}</h2>
                            <p><span>Email:</span> {{ Auth::user()->email }}</p>
                            <p><span>Phone:</span> {{ Auth::user()->phone }}</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-7 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('updateprofileadmin') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            id="exampleInputEmail1" placeholder="Enter Name" name="name">
                                        @error('name')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="emailtest">Email address</label>
                                        <input type="text" class="form-control" id="emailtest" placeholder="Enter email"
                                            value="{{ Auth::user()->email }}" name="email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                        @error('email')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phonetext">Phone</label>
                                        <input type="text" value="{{ Auth::user()->phone }}" class="form-control"
                                            id="phonetext" placeholder="Enter Phone" name="phone">
                                        @error('phone')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn  btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-5 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('updatepassword') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password_currunt">Currunt Password</label>
                                        <input type="password" class="form-control" id="password_currunt"
                                            placeholder="Currunt Password" name="currunt_password">
                                        @error('currunt_password')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_new">New Password</label>
                                        <input type="password" class="form-control" id="password_new"
                                            placeholder="New Password" name="new_password">
                                        @error('new_password')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" name="new_password_confirmation">
                                        @error('new_password_confirmation')
                                        <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <button type="submit" class="btn  btn-primary">Save</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- [ card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

@endsection