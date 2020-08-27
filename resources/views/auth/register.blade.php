@extends('layouts.logreg')

@section('logreg_content')

  <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">
     <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
       <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
       <div class="tx-center mg-b-60">Professional Admin Template Design</div>

       <form method="POST" action="{{ route('register') }}">
         @csrf
         
         <div class="form-group">
           <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your Name" name="name" value="{{ old('name') }}">
           @error('name')
               <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
               </span>
           @enderror
         </div><!-- form-group -->
         <div class="form-group">
           <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
             @enderror
         </div><!-- form-group -->
         <div class="form-group">
           <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div><!-- form-group -->
         <div class="form-group">
           <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
         </div><!-- form-group -->
         <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
         <button type="submit" class="btn btn-info btn-block">Sign Up</button>
       </form>

       <div class="mg-t-40 tx-center">Already have an account? <a href="{{ url('login') }}" class="tx-info">Sign In</a></div>
     </div><!-- login-wrapper -->
   </div><!-- d-flex -->



@endsection
