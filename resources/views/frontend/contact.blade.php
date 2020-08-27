@extends('layouts.frontend_app')

@section('frontend_content')
  <!-- .breadcumb-area start -->
  <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcumb-wrap text-center">
            <h2>Contact Us</h2>
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><span>Contact</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .breadcumb-area end -->

  <!-- contact-area start -->
      <div class="contact-area ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 col-12">
                    @if(session()->has('success_status'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                         {{ session()->get('success_status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                      <div class="contact-form form-style">
                          <div class="cf-msg"></div>
                          <form action="{{ route('contactpost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <input type="text" placeholder="Name" name="customer_name" value = "{{ old('customer_name') }}">
                                      @error ('customer_name')
                                        <span class = "text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12  col-sm-6">
                                      <input type="text" placeholder="Email" name="customer_email" value = "{{ old('customer_email') }}">
                                      @error ('customer_email')
                                        <span class = "text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <input type="text" placeholder="Subject" name="customer_subject" value = "{{ old('customer_subject') }}">
                                      @error ('customer_subject')
                                        <span class = "text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <textarea class="contact-textarea" placeholder="Message" name="customer_message">{{ old('customer_message') }}</textarea>
                                      @error ('customer_message')
                                        <span class = "text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                    <input type="file" class = "form-control" name="customer_file">
                                  </div>
                                  <div class="col-12">
                                      <button type = "submit">SEND MESSAGE</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="col-lg-4 col-12">
                      <div class="contact-wrap">
                          <ul>
                              <li>
                                  <i class="fa fa-home"></i> Address:
                                  <p>1234, Contrary to popular Sed ut perspiciatis unde 1234</p>
                              </li>
                              <li>
                                  <i class="fa fa-phone"></i> Email address:
                                  <p>
                                      <span>info@yoursite.com </span>
                                      <span>info@yoursite.com </span>
                                  </p>
                              </li>
                              <li>
                                  <i class="fa fa-envelope"></i> phone number:
                                  <p>
                                      <span>+0123456789</span>
                                      <span>+1234567890</span>
                                  </p>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- contact-area end -->

@endsection
