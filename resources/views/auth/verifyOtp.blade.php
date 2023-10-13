@extends('layouts.main')

@section('title', 'Home')

@section('sidebar')
    @parent

    

    
@endsection

@section('content')

<section class="login section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="login-form login-area">
                    <h3  style="text-align: center;">
                    OTP send
                    </h3>

           @if (session('status'))
              <div class="alert alert-danger">
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
                    
                    <form role="form" class="login-form" method="POST" action="{{ route('login.otpvarify') }}">
                        @csrf
                        
                        <div class="form-group"  style="text-align: center;">
                            <div class="input-icon">
                                <i class="otp"></i>
                                <input type="otp" id="sender-otp" class="form-control" name="otp" placeholder="OTP">
                            </div>

                                  <input type="text" value="{{ auth()->user()->email }}" name="email" hidden>

                        </div>
                        <div class="text-center" style="text-align: center;">
                            <button class="btn btn-dark">Login</button>
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