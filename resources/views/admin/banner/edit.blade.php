@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Banner Edit') }}
@endsection
@section('banner')
  active
@endsection

@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <a class="breadcrumb-item" href="{{ route('banner.index') }}">Banner</a>
       <a class="breadcrumb-item" href="#">{{ $banner_info->banner_heading }}</a>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Banner Edit Page</h5>
         <p>This is a Banner Edit Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-6 m-auto">
             <div class="card">
                 <div class="card-header">
                    <h2>Edit Banner</h2>
                 </div>
                 <div class="card-body">

                   <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banner</a></li>
                       <li class="breadcrumb-item active" aria-current="page"> {{ $banner_info->banner_heading }} </li>
                     </ol>
                   </nav>

                   <form method="post" action = "{{ route('banner.update' , $banner_info->id) }}" enctype="multipart/form-data">
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
                       <label>Banner Heading</label>
                       <input type="text" class="form-control" placeholder="Product Name" name = "banner_heading" value = "{{ $banner_info->banner_heading }}">
                       @error ('product_name')
                         <span class = "text-danger">{{ $message }}</span>
                       @enderror
                     </div>

                     <div class="form-group">
                       <label>Banner Description</label>
                       <textarea name="banner_description" rows="4" class="form-control">{{ $banner_info->banner_description }}</textarea>
                       @error ('banner_description')
                         <span class = "text-danger">{{ $message }}</span>
                       @enderror
                     </div>

                     <div class="form-group">
                       <label>Banner Button</label>
                       <input type="text" class="form-control" name = "banner_button" value = "{{ $banner_info->banner_button }}">
                       @error ('banner_button')
                         <span class = "text-danger">{{ $message }}</span>
                       @enderror
                     </div>

                     <div class="form-group">
                       <label>Button Link</label>
                       <input type="text" class="form-control" name = "button_link" value = "{{ $banner_info->button_link }}">
                       @error ('button_link')
                         <span class = "text-danger">{{ $message }}</span>
                       @enderror
                     </div>

                     <div class="form-group">
                       <label>Bannaer Photo</label>
                       <input type="file" class="form-control" name ="banner_photo">
                       <img src="{{ asset('uploads/banner_photos') }}/{{ $banner_info->banner_photo }}" alt="" width="200" class = "mt-3">
                     </div>

                     <button type="submit" class="btn btn-primary">Edit Banner</button>
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
