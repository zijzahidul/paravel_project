@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Product Edit') }}
@endsection
@section('product')
  active
@endsection

@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <a class="breadcrumb-item" href="{{ route('product.index') }}">Product</a>
       <a class="breadcrumb-item" href="#">{{ $product_info->product_name }}</a>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Product Edit Page</h5>
         <p>This is a Product Edit Page</p>
       </div><!-- sl-page-title -->

       <div class="container">
         <div class="row">
           
         </div>
       </div>

     </div><!-- sl-pagebody -->
   </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection
