@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Customer Edit') }}
@endsection
@section('customer')
  active
@endsection

@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <a class="breadcrumb-item" href="{{ url('admin/category/add') }}">Customer Info</a>
       <span class="breadcrumb-item active"> {{ $customer_info->customer_name }} </span>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Customer Info Edit Page</h5>
         <p>This is a Customer Info Edit Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-6 m-auto">
             <div class="card">
                 <div class="card-header">
                    <h2>Edit Customer Info</h2>
                 </div>
                 <div class="card-body">

                   <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="{{ route('customerinfo.index') }}">Edit Customer </a></li>
                       <li class="breadcrumb-item active" aria-current="page"> {{ $customer_info->customer_name }} </li>
                     </ol>
                   </nav>

                   <form method="post" action = "{{ route('customerinfo.update' , $customer_info->id) }}">
                     @csrf
                     @method('PATCH')

                     @if(session()->has('edit_success'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session()->get('edit_success') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                     @endif

                     <div class="form-group">
                       <label>Customer Name</label>
                       <input type="hidden" name="category_id" value="{{ $customer_info->id }}">
                       <input type="text" class="form-control" name = "customer_name" value = "{{ $customer_info->customer_name }}">
                     </div>

                     <fieldset disabled>
                       <div class="form-group">
                         <label for="disabledTextInput">Customer Email</label>
                         <input type="text" id="disabledTextInput" class="form-control" value = "{{ $customer_info->customer_email }}">
                       </div>
                     </fieldset>

                     <div class="form-group">
                       <label>Customer Subject</label>
                       <input type="text" class="form-control"  name = "customer_subject" value = "{{ $customer_info->customer_subject }}">
                     </div>

                     <div class="form-group">
                       <label>Customer Message</label>
                       <textarea name="customer_message" rows="4" class="form-control">{{ $customer_info->customer_message }}</textarea>
                     </div>

                     <button type="submit" class="btn btn-primary edit_button">Edit Customer Info</button>
                   </form>

                 </div>
            </div>
           </div>

         </div>
       </div>

     </div><!-- sl-pagebody -->
   </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection
