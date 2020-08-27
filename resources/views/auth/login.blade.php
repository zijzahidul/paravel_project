@extends('layouts.logreg')

@section('logreg_content')

  <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
      <div class="tx-center mg-b-60">Professional Admin Template Design</div>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
           <label for="email" class="col-md-6 col-form-label ml-0">Email Address</label>
           <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email Address">
             @error('email')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
        </div><!-- form-group -->
        <div class="form-group">
           <label for="password" class="col-md-6 col-form-label ml-0">Password</label>
           <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password">
             @error('password')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
        </div><!-- form-group -->

            <div class="form-check ml-2">
              <input class="form-check-input ml-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Remember Me
              </label>
            </div>

            @if (Route::has('password.request'))
              <a class="btn btn-link mb-3" href="{{ route('password.request') }}">
                Forgot Your Password?
              </a>
            @endif

        <button type="submit" class="btn btn-info btn-block">Sign In</button>

        <a href = "{{ url('login/github') }}" class="btn btn-warning btn-block"> <i class = "fa fa-github"></i> Login With Github</a>
        <a href = "{{ url('login/google') }}" class="btn btn-secondary btn-block"> <i class = "fa fa-google"></i> Login With Google</a>

        <a href="{{ url('register') }}" class = "btn btn-info btn-block">Registration</a>
      </form>
    </div><!-- login-wrapper -->
 </div><!-- d-flex -->

@endsection
