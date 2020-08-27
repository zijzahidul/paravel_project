@extends('layouts.dashboard_app')

@section('page_title')
{{ ('Paravel | Banner Add') }}
@endsection

@section('banner')
active
@endsection

@section('dashboard_content')


  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <span class="breadcrumb-item active">Banner</span>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Banner Page</h5>
         <p>This is a Banner Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-12">
              <h1 class = "text-center my-3">Banner Page</h1>
           </div>
         </div>
           <div class="row">
              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Banner View</h2>
                          <hr>
                         <h4>Total Product : {{ $banners_total }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('trash_success'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('trash_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         {{-- @if(session()->has('mark_delete_success'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('mark_delete_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif --}}

                             <table class="table table-dark text-center" id = "data_tables_3">
                               <thead>
                                 <tr>
                                   <th>SL No.</th>
                                   <th>Banner Heading</th>
                                   <th>Banner Description</th>
                                   <th>Banner Button</th>
                                   <th>Button Link</th>
                                   <th>Banner Photo</th>
                                   <th>Action</th>
                                 </tr>
                               </thead>

                               <tbody>
                                 @forelse($banners_all as $banner)
                                 <tr>
                                   <td>{{ $loop->index + 1 }}</td>
                                   <td>{{ Str::limit($banner->banner_heading , 10) }}</td>
                                   <td>{{ Str::limit($banner->banner_description , 10) }}</td>
                                   <td>{{ $banner->banner_button }}</td>
                                   <td>{{ $banner->button_link }}</td>
                                   <td>
                                     <img src="{{ asset('uploads/banner_photos') }}/{{ $banner->banner_photo }}" alt="" width="100">
                                   </td>
                                   <td>
                                     <div class="btn-group" role="group" aria-label="Basic example">
                                       <a href = "{{ route('banner.edit' , $banner->id) }}" type="button" class="btn btn-primary">Edit</a>

                                       <form action="{{ route('banner.destroy' , $banner->id) }}" method="post">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-danger">Delete</button>
                                       </form>
                                     </div>
                                   </td>
                                 </tr>
                                 @empty
                                   <tr>
                                     <td class = "text-danger text-center" colspan="50">No Data Available</td>
                                   </tr>
                               @endforelse

                               </tbody>
                             </table>

                       </div>
                   </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                       <h2>Banner Add</h2>
                    </div>
                    <div class="card-body">

                      <form method="post" action = "{{ route('banner.store') }}" enctype="multipart/form-data">
                        @csrf

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
                          <input type="text" class="form-control" placeholder="Banner Heading" name = "banner_heading" value = "{{ old('banner_heading') }}">
                          @error ('product_name')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Banner Description</label>
                          <input type="text" class="form-control" placeholder="Banner Description" name = "banner_description" value = "{{ old('banner_description') }}">
                          @error ('product_name')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Banner Button</label>
                          <input type="text" class="form-control" placeholder="Banner Button" name = "banner_button" value = "{{ old('banner_button') }}">
                          @error ('banner_button')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Button Link</label>
                          <input type="text" class="form-control" placeholder="Button Link" name = "button_link" value = "{{ old('button_link') }}">
                          @error ('button_link')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Banner Photo</label>
                          <input type="file" class="form-control" name="banner_photo">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Banner</button>
                      </form>

                    </div>
               </div>
              </div>

              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Trash View</h2>
                          <hr>
                         <h4>Delete Banner : {{ $banner_deleted_total }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('restore_success'))
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session()->get('restore_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('delete_success'))
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session()->get('delete_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         {{-- @if(session()->has('mark_restore'))
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                             {{ session()->get('mark_restore') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('force_delete'))
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                             {{ session()->get('force_delete') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif --}}

                         <form action="{{ route('markrestoredelete') }}" method="post">
                           @csrf
                           <table class="table table-dark" id = "data_tables_4">
                             <thead>
                               <tr>
                                 <th>Mark</th>
                                 <th>SL No.</th>
                                 <th>Banner Heading</th>
                                 <th>Banner Description</th>
                                 <th>Banner Button</th>
                                 <th>Button link</th>
                                 <th>Action</th>
                               </tr>
                             </thead>

                             <tbody>
                               @forelse($banner_deleted as $banner_delete)
                               <tr>
                                 <td>
                                   <input type="checkbox" name="banner_id[]" value="{{ $banner_delete->id }}">
                                 </td>
                                 <td>{{ $loop->index + 1 }}</td>
                                 <td>{{ Str::limit($banner_delete->banner_heading , 10) }}</td>
                                 <td>{{ Str::limit($banner_delete->banner_description , 10) }}</td>
                                 <td>{{ $banner_delete->banner_button }}</td>
                                 <td>{{ $banner_delete->button_link }}</td>
                                 <td>
                                   <img src="{{ asset('uploads/banner_photos') }}/{{ $banner_delete->banner_photo }}" alt="" width="100">
                                 </td>
                                 <td>
                                   <div class="btn-group" role="group" aria-label="Basic example">
                                     <a href="{{ route('bannerrestore' , $banner_delete->id) }}" class="btn btn-success">Restore</a>
                                     <a href="{{ route('bannerdelete' , $banner_delete->id) }}" class="btn btn-danger">Delete</a>
                                   </div>
                                 </td>
                               </tr>
                               @empty
                                 <tr>
                                   <td class = "text-danger text-center" colspan="50">No Data Available</td>
                                 </tr>
                             @endforelse
                             </tbody>
                           </table>
                           {{-- @if ($product_deleted->count() > 1)
                             <button type="submit" class="btn btn-success" name = "button" value = "Restore">Mark All Restore</button>
                             <button type="submit" class="btn btn-danger" name = "button" value = "Delete">Mark All Delete</button>
                           @endif --}}
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


@section('footer_scripts')

<script>
// $(document).ready(function() {
//     $('#data_tables').DataTable();
// } );
$(document).ready(function() {
    $('#data_tables_3').DataTable( {
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>

<script>
// $(document).ready(function() {
//     $('#data_tables').DataTable();
// } );
$(document).ready(function() {
    $('#data_tables_4').DataTable( {
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>

@endsection
