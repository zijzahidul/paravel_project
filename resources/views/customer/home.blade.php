@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Customer Dashboard ') }}
@endsection
@section('home')
  active
@endsection

@section('dashboard_content')

 <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Customer Dashboard</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Customer Dashboard </h5>
        <p>This is a Customer Dashboard Page</p>

        <h2>
          @if (Auth::user()->role == 1)
            Your Are Admin
          @else
            Your Are Customer
          @endif
        </h2>
      </div><!-- sl-page-title -->

      <div class="container-fluid">
       <div class="row justify-content-center">
         
         <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                Customer Dashboard
              </div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">SL No.</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Created At</th>
                        <th scope="col">Payment Option</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Coupon Name</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>

                    <tbody>
                      @forelse ($order_info as $order)
                      <tr>
                        <td>{{ $loop->index+1}}</td>
                        <td>{{ Auth::user()->name}}</td>
                        <td>{{ $order->created_at}}</td>
                        <td>
                          @if ($order->payment_option == 1)
                          Cash On Delivery 
                     @else
                          Creadit Cart 
                     @endif
                        </td>

                        <td>
                          @if ($order->payment_status == 2)
                           <span class = "badge badge-success">Paid</span>
                           @else
                            
                           <span class = "badge badge-danger">Unpaid</span>
                     @endif
                        </td>
                        <td>$ {{ $order->sub_total}}</td>
                        <td>$ {{ $order->discount_amount}}</td>
                        <td>  {{ $order->coupon_name}}</td>
                        <td>$ {{ $order->total}}</td>
                        <td>
                          <a href="{{ url('download/invoice') }}/{{ $order->id }}"><i class = "fa fa-download fa-2x mr-2"></i>Download Invoice</a>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="50">
                          @foreach($order->order_detail as $detail)
                              <p>{{ $detail->product['product_name'] }}</p>
                          @endforeach
                        </td>
                      </tr>

                      @empty

                      <tr>
                        <td colspan="50" class = "text-danger text-center">
                          <h5>Nothing has been bought yet</h5>
                        </td>
                      </tr>
                          

                     @endforelse

                    </tbody>
                  </table>


                 </div>
             </div>
          </div>
       </div>
      </div>

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
 <!-- ########## END: MAIN PANEL ########## -->
@endsection
