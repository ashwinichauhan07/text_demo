@extends('layouts.main')

@section('title', 'Home')

@section('sidebar')
    @parent

    

    
@endsection

@section('content')




<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title"></h2>
                    <ol class="breadcrumb">
                        <li><a href="index-2.html"> </a></li>
                        <li class="current"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>




<section class="register section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="register-form login-area">
                    <h3>
                    Register Now
                    </h3>
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" id="Name" class="form-control" name="name" placeholder="Username" required>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input type="email" id="sender-email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" class="form-control" placeholder="Password" name="password" min="8" required>
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password" required min="8">
                            </div>
                            @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkedall"required>
                                <label class="custom-control-label" for="checkedall">By registering, you accept our Terms & Conditions</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-dark">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection


@once
    @push('scripts')
       
    @endpush
@endonce