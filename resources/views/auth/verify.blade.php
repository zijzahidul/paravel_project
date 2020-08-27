@extends('layouts.dashboard_app')
@section('page_title')
  {{ "Email Verify" }}
@endsection

@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Dashboard </h5>
        <p>This is a Dashboard Page</p>
      </div><!-- sl-page-title -->
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Verify Your Email Address') }}</div>

          <div class="card-body">
            @if (session('resent'))
              <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
              </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
