@extends('layouts.main')

@section('title', 'Home')

@section('sidebar')
    @parent




@endsection

@section('content')




<div class="container" style="margin-top: 5%;">
                <h1 style="text-align: center; ">ESWIFT TYPING ERA</h1>
            <div class="post-btn" style="text-align: center; ">

<section class="login section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="login-form login-area">
                    <h3>
                    Exam Module Login Now
                    </h3>

          @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                      @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif



                    <form role="form" class="login-form" method="POST" action="{{ route('demoexam.auth.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input type="email" id="sender-email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                <label class="custom-control-label" for="checkedall">{{ __('Remember me') }}</label>
                            </div>
                            <a class="forgetpassword" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-dark">Log In</button>
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
