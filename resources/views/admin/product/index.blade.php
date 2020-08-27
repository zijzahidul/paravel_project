@extends('layouts.dashboard_app')

@section('page_title')
 {{ ('Paravel | Product Add ') }}
@endsection

@section('product')
 active
@endsection

@section('dashboard_content')
  <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
     <nav class="breadcrumb sl-breadcrumb">
       <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
       <span class="breadcrumb-item active">Product</span>
     </nav>

     <div class="sl-pagebody">
       <div class="sl-page-title">
         <h5>Product Page</h5>
         <p>This is a Product Page</p>
       </div><!-- sl-page-title -->

       <div class="container-fluid">
         <div class="row">
           <div class="col-md-12">
              <h1 class = "text-center my-3">Product Page</h1>
           </div>
         </div>
           <div class="row">
              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Product View</h2>
                          <hr>
                         <h4>Total Product : {{ $product_total }}</h4>
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
                         {{-- @if(session()->has('mark_delete_success'))
                           <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                              {{ session()->get('mark_delete_success') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         @endif --}}

                             <table class="table table-dark" id = "data_tables">
                               <thead>
                                 <tr>
                                   <th>SL No.</th>
                                   <th>Product Name</th>
                                   <th>Category Name</th>
                                   <th>Product Price</th>
                                   <th>P.Q</th>
                                   <th>A.Q</th>
                                   <th>Product Short Description</th>
                                   <th>Product Photo</th>
                                   <th>Action</th>
                                 </tr>
                               </thead>

                               <tbody>
                                 @forelse($product_all as $product)

                                 <tr class = " {{ ($product->product_quantity <= $product->alert_quantity) ? 'table-danger' : '' }}">

                                   <td>{{ $loop->index + 1 }}</td>
                                   <td>{{ Str::limit($product->product_name , 10) }}</td>
                                   <td>
                                     @if (isset($product->relation_with_category_table->id))
                                       {{ $product->relation_with_category_table->category_name }}
                                     @else
                                       {{ "Category Nai" }}
                                     @endif

                                   </td>
                                   <td>{{ $product->product_price }}</td>
                                   <td>{{ $product->product_quantity }}</td>
                                   <td>{{ $product->alert_quantity }}</td>
                                   <td>{{ Str::limit($product->product_short_description , 10) }}</td>
                                   <td>
                                     <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="" width="100">
                                   </td>
                                   <td>
                                     <div class="btn-group" role="group" aria-label="Basic example">
                                       <a href = "{{ route('product.edit' , $product->id) }}" type="button" class="btn btn-primary">Edit</a>

                                       <form action="{{ route('product.destroy' , $product->id) }}" method="post">
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
                       <h2>Product Add</h2>
                    </div>
                    <div class="card-body">

                      <form method="post" action = "{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if(session()->has('success_status'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                             {{ session()->get('success_status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif

                        @if(session()->has('success_message'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                             {{ session()->get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif



                        <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" class="form-control" placeholder="Product Name" name = "product_name" value = "{{ old('product_name') }}">
                          @error ('product_name')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Category Name</label>
                          <select class="form-control" name="category_id">
                            <option value="">--Select One--</option>
                            @foreach ($category_all as $category)
                              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                          </select>
                          @error ('category_id')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Product Price</label>
                          <input type="number" class="form-control" placeholder="Product Price" name = "product_price" value = "{{ old('product_price') }}">
                          @error ('product_price')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Product Short Description</label>
                          <textarea name="product_short_description" rows="2" class="form-control" placeholder="Product Short Description">{{ old('product_short_description') }}</textarea>
                          @error ('product_short_description')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Product Long Description</label>
                          <textarea name="product_long_description" rows="4" class="form-control" placeholder="Product Long Description">{{ old('product_long_description') }}</textarea>
                          @error ('product_long_description')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Product Quantity</label>
                          <input type="number" class="form-control" placeholder="Product Quantity" name = "product_quantity" value = "{{ old('product_quantity') }}">
                          @error ('product_quantity')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Alert Quantity</label>
                          <input type="number" class="form-control" placeholder="Alert Quantity" name = "alert_quantity" value = "{{ old('alert_quantity') }}">
                          @error ('alert_quantity')
                            <span class = "text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label>Product Photo</label>
                          <input type="file" class="form-control" name="product_photo">
                        </div>

                        <div class="form-group">
                          <label>Product Multiple Photo</label>
                          <input type="file" class="form-control" name="product_multiple_photo[]" multiple>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                      </form>

                    </div>
               </div>
              </div>

              <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">
                          <h2>Trash View</h2>
                          <hr>
                         <h4>Delete Category : {{ $product_deleted_total }}</h4>
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
                         @if(session()->has('mark_restore'))
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
                         @endif

                         <form action="{{ route('markrestoredelete') }}" method="post">
                           @csrf
                           <table class="table table-dark" id = "data_tables_2">
                             <thead>
                               <tr>
                                 <th>Mark</th>
                                 <th>SL No.</th>
                                 <th>Product Name</th>
                                 <th>Category Name</th>
                                 <th>Product Price</th>
                                 <th>Product Short Description</th>
                                 <th>Product Photo</th>
                                 <th>Action</th>
                               </tr>
                             </thead>

                             <tbody>
                               @forelse($product_deleted as $product_delete)
                               <tr>
                                 <td>
                                   <input type="checkbox" name="product_id[]" value="{{ $product_delete->id }}">
                                 </td>
                                 <td>{{ $loop->index + 1 }}</td>
                                 <td>{{ Str::limit($product_delete->product_name , 10) }}</td>
                                 <td>
                                   @if (isset($product->relation_with_category_table->id))
                                     {{ $product->relation_with_category_table->category_name }}
                                   @else
                                     {{ "Category Nai" }}
                                   @endif
                                 </td>
                                 <td>{{ $product_delete->product_price }}</td>
                                 <td>{{ Str::limit($product_delete->product_short_description , 10) }}</td>
                                 <td>
                                   <img src="{{ asset('uploads/product_photos') }}/{{ $product_delete->product_photo }}" alt="" width="100">
                                 </td>
                                 <td>
                                   <div class="btn-group" role="group" aria-label="Basic example">
                                     <a href="{{ route('productrestore' , $product_delete->id) }}" class="btn btn-success">Restore</a>
                                     <a href="{{ route('productdelete' , $product_delete->id) }}" class="btn btn-danger">Delete</a>
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
                           @if ($product_deleted->count() > 1)
                             <button type="submit" class="btn btn-success" name = "button" value = "Restore">Mark All Restore</button>
                             <button type="submit" class="btn btn-danger" name = "button" value = "Delete">Mark All Delete</button>
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
