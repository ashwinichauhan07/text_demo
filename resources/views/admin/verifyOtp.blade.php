<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title"></h2>
                   <!--  <ol class="breadcrumb">
                        <li><a href="index-2.html">Home /</a></li>
                        <li class="current">Login</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>
</div>


<section class="login section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="login-form login-area">
                    <h3>
                    Login Now
                    </h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form role="form" class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input type="hidden" id="sender-email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="hidden" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="hidden" class="form-control" name="password" placeholder="Password">
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