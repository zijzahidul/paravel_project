@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Category Add') }}
@endsection
@section('category')
  active
@endsection

@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <span class="breadcrumb-item active">Category</span>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Category Page</h5>
         <p>This is a Category Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-12">
              <h1 class = "text-center my-3">Category Page</h1>
           </div>
         </div>
           <div class="row">
              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Category View</h2>
                          <hr>
                         <h4>Total Category : {{ $total_categorys }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('trash_status'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('trash_status') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('mark_delete_success'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('mark_delete_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif

                           <form  action="{{ url('mark/delete') }}" method="post">
                             @csrf
                             <table class="table table-dark" id = "data_tables">
                               <thead>
                                 <tr>
                                   <th>Mark All <input type="checkbox" id="checkAll" ></th>
                                   <th>SL No.</th>
                                   <th>Category Name</th>
                                   <th>Category Created By</th>
                                   <th>Category Photo</th>
                                   <th>Action</th>
                                 </tr>
                               </thead>

                               <tbody>
                                 @forelse($categorys as $category)
                                 <tr>
                                   <th>
                                     <input type="checkbox" name="category_id[]" value="{{ $category->id }}" id = "checkItem">
                                   </th>
                                   <th>{{ $loop->index + 1 }}</th>
                                   <td>{{ Str::title($category->category_name) }}</td>
                                   <td>{{ $category->relation_with_user_table->name }}</td>
                                   <td>
                                     <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="" width="100">
                                   </td>
                                   <td>
                                     <div class="btn-group" role="group" aria-label="Basic example">
                                       <a href = "{{ url('category/edit') }}/{{ $category->id }}" type="button" class="btn btn-primary">Edit</a>
                                       
                                       <button value = "{{ url('category/trash') }}/{{ $category->id }}" type="button" class="btn btn-warning trash_button">Trash</button>
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
                             @if ($categorys->count() > 1)
                              <button type="submit" class ="btn btn-primary">Trash All</button>
                             @endif
                           </form>

                       </div>
                   </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                       <h2>Category Add</h2>
                    </div>
                    <div class="card-body">

                      <form method="post" action = "{{ url('category/post') }}" enctype="multipart/form-data">
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
                          <label>Category Name</label>
                          <input type="text" class="form-control" placeholder="Category Name" name = "category_name" value = "{{ old('category_name') }}">
                          @error ('category_name')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Category Description</label>
                          <textarea name="category_description" rows="4" class="form-control" placeholder="Category Description">{{ old('category_description') }}</textarea>
                          @error ('category_description')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Category Photo</label>
                          <input type="file" class="form-control" name="category_photo">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Category</button>
                      </form>

                    </div>
               </div>
              </div>

              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Trash View</h2>
                          <hr>
                         <h4>Delete Category : {{ $total_del_categorys }}</h4>
                       </div>
                       <div class="card-body">
                         @if(session()->has('restore_status'))
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session()->get('restore_status') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('delete_status'))
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session()->get('delete_status') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif
                         @if(session()->has('restore_delete_success'))
                           <div class="alert alert-succes alert-dismissible fade show" role="alert">
                              {{ session()->get('restore_delete_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif

                         <form action="{{ url('mark/restore') }}" method="post">
                           @csrf
                           <table class="table table-dark" id = "data_tables_2">
                             <thead>
                               <tr>
                                 <th>Mark <input type="checkbox" id="checkall"> </th>
                                 <th>SL No.</th>
                                 <th>Category Name</th>
                                 <th>Created By</th>
                                 <th>Category Photo</th>
                                 <th>Action</th>
                               </tr>
                             </thead>

                             <tbody>
                               @forelse($delete_categorys as $del_category)
                               <tr>
                                 <th>
                                   <input type="checkbox" name="category_id[]" value="{{ $del_category->id }}" id="checkitem">
                                 </th>
                                 <th>{{ $loop->index + 1 }}</th>
                                 <td>{{ Str::title($del_category->category_name) }}</td>
                                 <td>{{ $del_category->relation_with_user_table->name }}</td>
                                 <td>
                                   <img src="{{ asset('uploads/category_photos') }}/{{ $del_category->category_photo }}" alt="" width="100">
                                 </td>
                                 <td>
                                   <div class="btn-group" role="group" aria-label="Basic example">
                                     <button value = "{{ url('restore/category') }}/{{ $del_category->id }}" type="button" class="btn btn-success restore_button">Restore</button>
                                     <button value = "{{ url('delete/category') }}/{{ $del_category->id }}" type="button" class="btn btn-danger delete_button">Delete</button>
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
                           @if ($delete_categorys->count() > 1)
                             <button type="submit" name = "button" value = "Restore" class = "btn btn-primary">Restore All</button>
                             <button type="submit" name = "button" value = "Delete" class = "btn btn-primary">Delete All</button>
                           @endif
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
   $(document).ready(function(){
     $('.trash_button').click(function(){
       Swal.fire({
       title: 'Are you sure?',
       text: "You won't be able to revert this!",
       icon: 'question',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, Trash it!'
      }).then((result) => {
       if (result.value) {
         window.location.href = $(this).val();
       }
      })
      });
     });
 </script>
 <script>
  $(document).ready(function(){
    $('.restore_button').click(function(){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Restore it!'
     }).then((result) => {
      if (result.value) {
        window.location.href = $(this).val();
      }
     })
     });
    });
</script>
<script>
 $(document).ready(function(){
   $('.delete_button').click(function(){
     Swal.fire({
     title: 'Are you sure?',
     text: "You won't be able to revert this!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     if (result.value) {
       window.location.href = $(this).val();
     }
    })
    });
   });
</script>


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

<script>
$("#checkAll").click(function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

<script>
$("#checkall").click(function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>


@endsection
