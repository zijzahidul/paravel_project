@extends('layouts.dashboard_app')

@section('page_title')

@endsection

@section('dashboard_content')

    <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
       <nav class="breadcrumb sl-breadcrumb">
         <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
         <a class="breadcrumb-item" href="{{ url('admin/category/add') }}">Testmonial</a>
         <span class="breadcrumb-item active"> {{ $client_info->client_name }} </span>
       </nav>

       <div class="sl-pagebody">
         <div class="sl-page-title">
           <h5>Testmonial Edit Page</h5>
           <p>This is a Testmonial Edit Page</p>
         </div><!-- sl-page-title -->

         <div class="container-fluid">
           <div class="row">
             <div class="col-md-6 m-auto">
               <div class="card">
                   <div class="card-header">
                      <h2>Edit Testmonial</h2>
                   </div>
                   <div class="card-body">

                     <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{ url('admin/category/add') }}">Edit Testmonial </a></li>
                         <li class="breadcrumb-item active" aria-current="page"> {{ $client_info->client_name }} </li>
                       </ol>
                     </nav>

                     <form method="post" action = "{{ route('testmonial.update' , $client_info->id) }}" enctype="multipart/form-data">
                       @csrf
                       @method('PATCH')

                       @if(session()->has('success_status'))
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success_status') }}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                       @endif

                       <div class="form-group">
                         <label>Client Name</label>
                         <input type="text" class="form-control" name = "client_name" value = "{{ $client_info->client_name }}">
                       </div>

                       <div class="form-group">
                         <label>Client Name</label>
                         <input type="text" class="form-control" name = "client_position" value = "{{ $client_info->client_position }}">
                       </div>

                       <div class="form-group">
                         <label>Client Description</label>
                         <textarea name="client_review_text" rows="4" class="form-control">{{ $client_info->client_review_text }}</textarea>
                       </div>

                       <div class="form-group">
                         <label>Client Photo</label>
                         <input type="file" class="form-control" name = "client_photo">
                         <img src="{{ asset('uploads/client_photos') }}/{{ $client_info->client_photo }}" alt="" width="100" class = "mt-3">
                       </div>

                       <button type="submit" class="btn btn-primary edit_button">Edit Testmonial</button>
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
