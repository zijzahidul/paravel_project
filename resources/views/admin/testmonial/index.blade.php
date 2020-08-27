@extends('layouts.dashboard_app')

@section('page_title')
{{ ('Paravel | Testmonial Add') }}
@endsection

@section('testmonial')
active
@endsection

@section('dashboard_content')
  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <span class="breadcrumb-item active">Testmonial</span>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Testmonial Page</h5>
         <p>This is a Testmonial Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-12">
              <h1 class = "text-center my-3">Testmonial Page</h1>
           </div>
         </div>
           <div class="row">
              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Testmonial View</h2>
                          <hr>
                         <h4>Total Product : {{ $testmonial_total }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('trash_sms'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('trash_sms') }}
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

                             <table class="table table-dark text-center" id = "data_tables">
                               <thead>
                                 <tr>
                                   <th>SL No.</th>
                                   <th>Client Name</th>
                                   <th>Client Position</th>
                                   <th>Client Review Text</th>
                                   <th>Client Photo</th>
                                   <th>Action</th>
                                 </tr>
                               </thead>

                               <tbody>
                                 @forelse($testmonial_all as $testmonial)
                                 <tr>
                                   <td>{{ $loop->index + 1 }}</td>
                                   <td>{{ Str::limit($testmonial->client_name , 10) }}</td>
                                   <td>{{ $testmonial->client_position }}</td>
                                   <td>{{ Str::limit($testmonial->client_review_text , 10) }}</td>
                                   <td>
                                     <img src="{{ asset('uploads/client_photos') }}/{{ $testmonial->client_photo }}" alt="" width="100">
                                   </td>
                                   <td>
                                     <div class="btn-group" role="group" aria-label="Basic example">
                                       <a href = "{{ route('testmonial.edit' , $testmonial->id) }}" type="button" class="btn btn-primary">Edit</a>

                                       <form action="{{ route('testmonial.destroy' , $testmonial->id) }}" method="post">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-warning">Trash</button>
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
                       <h2>Testmonial Add</h2>
                    </div>
                    <div class="card-body">

                      <form method="post" action = "{{ route('testmonial.store') }}" enctype="multipart/form-data">
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
                          <label>Client Name</label>
                          <input type="text" class="form-control" placeholder="Client Name" name = "client_name" value = "{{ old('client_name') }}">
                          @error ('client_name')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Client Position</label>
                          <input type="text" class="form-control" placeholder="Client Position" name = "client_position" value = "{{ old('client_position') }}">
                          @error ('client_position')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Client Review Text</label>
                          <textarea name="client_review_text" rows="2" class="form-control" placeholder="Client Review Text">{{ old('client_review_text') }}</textarea>
                          @error ('client_review_text')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Clint Photo</label>
                          <input type="file" class="form-control" name="client_photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Testmonial</button>
                      </form>
                    </div>
               </div>
              </div>

              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Trash View</h2>
                          <hr>
                         <h4>Delete Testmonial : {{ $testmonial_deleted_total }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('restore_sms'))
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session()->get('restore_sms') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('delete_sms'))
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session()->get('delete_sms') }}
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
                           <table class="table table-dark" id = "data_tables_2">
                             <thead>
                               <tr>
                                 <th>Mark</th>
                                 <th>SL No.</th>
                                 <th>Client Name</th>
                                 <th>Client Name</th>
                                 <th>Client Description</th>
                                 <th>Client Name</th>
                                 <th>Action</th>
                               </tr>
                             </thead>

                             <tbody>
                               @forelse($testmonial_deleted as $testmonial_delete)
                               <tr>
                                 <td>
                                   <input type="checkbox" name="testmonial_id[]" value="{{ $testmonial_delete->id }}">
                                 </td>
                                 <td>{{ $loop->index + 1 }}</td>
                                 <td>{{ Str::limit($testmonial_delete->client_name , 10) }}</td>
                                 <td>{{ $testmonial_delete->client_position }}</td>
                                 <td>{{ Str::limit($testmonial_delete->client_review_text , 10) }}</td>
                                 <td>
                                   <img src="{{ asset('uploads/client_photos') }}/{{ $testmonial_delete->client_photo }}" alt="" width="100">
                                 </td>
                                 <td>
                                   <div class="btn-group" role="group" aria-label="Basic example">
                                     <a href="{{ route('testmonialrestore' , $testmonial_delete->id) }}" class="btn btn-success">Restore</a>
                                     <a href="{{ route('testmonialdelete' , $testmonial_delete->id) }}" class="btn btn-danger">Delete</a>
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
    $('#data_tables').DataTable( {
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
    $('#data_tables_2').DataTable( {
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>
@endsection
