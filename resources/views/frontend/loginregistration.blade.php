@extends('layouts.frontend_app')

@section('frontend_content')
  <!-- .breadcumb-area start -->
  <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcumb-wrap text-center">
            <h2>Login Page</h2>
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><span>Login</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .breadcumb-area end -->

  <!-- checkout-area start -->
  <div class="account-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">

          @if(session()->has('success_status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session()->get('success_status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('customer.registration') }}" method="post">
            @csrf

            <div class="account-form form-style">
              <p>Customer Name</p>
              <input type="text" name="name">
              @error ('name')
                <span class = "text-danger">{{ $message }}</span>
              @enderror

              <p>Customer Email</p>
              <input type="email" name="email">
              @error ('email')
                <span class = "text-danger">{{ $message }}</span>
              @enderror

              <p>Password </p>
              <input type="password" name="password">
              @error ('password')
                <span class = "text-danger">{{ $message }}</span>
              @enderror

              <p>Confirm Password *</p>
              <input type="password" name="password_confirmation">
              @error ('password_confirmation')
                <span class = "text-danger">{{ $message }}</span>
              @enderror

              <button type = "submit" >Register</button>

              <div class="text-center">
                <a href="{{ url('login') }}">Or Login</a>
              </div>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
  <!-- checkout-area end -->
@endsection
