@extends('layouts.frontend_app')

@section('frontend_content')

  <!-- .breadcumb-area start -->
  <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcumb-wrap text-center">
            <h2>Cart Page</h2>
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><span>Cart Details</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .breadcumb-area end -->

  <!-- cart-area start -->
  <div class="cart-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{ print_r( session()->all()) }}
          <form action="{{ route('cart.update') }}" method="post">
            @csrf

            @if(session()->has('update_status'))
              <div class="alert alert-success alert-dismissible fade show text-success" role="alert">
                 {{ session()->get('update_status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if(session()->has('delete_status'))
              <div class="alert alert-danger alert-dismissible fade show text-danger" role="alert">
                 {{ session()->get('delete_status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if ($error_message !== "")
              <div class="alert alert-danger alert-dismissible fade show text-danger" role="alert">
                 {{ $error_message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <table class="table-responsive cart-wrap">
              <thead>
                <tr>
                  <th class="images">Image</th>
                  <th class="product">Product</th>
                  <th class="ptice">Price</th>
                  <th class="quantity">Quantity</th>
                  <th class="total">Total</th>
                  <th class="remove">Remove</th>
                </tr>
              </thead>
              <tbody>

                @php
                $sub_total = 0;
                $flag = 0;
                @endphp

                @forelse (cart_items() as $cart_item)
                  <tr class = "{{ ($cart_item->product->product_quantity < $cart_item->product_quantity) ? 'bg-danger' : ''}}">
                    <td class="images"><img src="{{ asset('uploads/product_photos') }}/{{ $cart_item->product->product_photo }}" alt=""></td>
                    <td class="product">
                      <a href="single-product.html">{{ $cart_item->product->product_name }}</a>
                      @if ($cart_item->product->product_quantity < $cart_item->product_quantity)
                          <p>Available Quantity is: {{ ($cart_item->product->product_quantity) }} </p>
                          @php
                            $flag = 1;
                          @endphp
                      @endif
                    </td>
                    <td class="ptice">${{ $cart_item->product->product_price }}</td>
                    <td class="quantity cart-plus-minus">
                      <input type="text" value="{{ $cart_item->product_quantity }}"  name = "product_update[{{ $cart_item->id }}]">

                    </td>
                    <td class="total">${{ $cart_item->product->product_price * $cart_item->product_quantity }}</td>


                    @php
                      $sub_total += $cart_item->product->product_price * $cart_item->product_quantity;
                    @endphp
                    <td class="remove">
                      <a href="{{ route('cart.destroy',$cart_item->id) }}"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>

                @empty
                  <tr>
                    <td colspan="50">No Data</td>
                  </tr>
                @endforelse

              </tbody>
            </table>
            <div class="row mt-60">
              <div class="col-xl-4 col-lg-5 col-md-6 ">
                <div class="cartcupon-wrap">
                  <ul class="d-flex">
                    <li>
                      <button type = "submit">Update Cart</button>
                    </li>
                  </form>

                  <li><a href="{{ url('/') }}">Continue Shopping</a></li>
                </ul>
                <h3>Cupon</h3>
                <p>Enter Your Cupon Code if You Have One</p>
                <div class="cupon-wrap">
                  <input type="text" placeholder="Cupon Code" id = "apply_coupon_name" value="{{ $coupon_name }}">
                  <button type="button" id = "cupon_button">Apply Cupon</button>
                </div>

                  @foreach ($valid_coupon as $single_coupon)
                        <button type="button" class="valid_coupon_name btn-success btn-sm mt-2 mb-1" value = "{{ $single_coupon->coupon_name }}">{{ $single_coupon->coupon_name }} Shop More than or equal : {{ $single_coupon->min_purchase_amount }}</button>
                  @endforeach

              </div>
            </div>
            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
              <div class="cart-total text-right">
                <h3>Cart Totals</h3>
                <ul>
                  <li><span class="pull-left">Subtotal </span>$ {{ $sub_total }}.00</li>
                  @php
                       session(['sub_total' => $sub_total ]);
                  @endphp
                  <li><span class="pull-left">Discount (%) </span>{{ $discount_percent }}%</li>
                  <li><span class="pull-left"> Discount ({{ ($coupon_name) ? $coupon_name : '-' }}) </span> $ {{ ($sub_total*$discount_percent/100) }}</li>
                  @php
                      session(['coupon_name' => (($coupon_name) ? $coupon_name : '-') ]);
                      session(['discount_amount' => ($sub_total*$discount_percent/100) ]);
                  @endphp
                  <li><span class="pull-left"> Total </span> $ {{ $sub_total - ($sub_total*$discount_percent/100) }}</li>
                  @php
                       session(['after_discount_amount_total' => ($sub_total - ($sub_total*$discount_percent/100)) ]);
                  @endphp
                </ul>
                @if ($flag == 1)
                  <a href="#">Please Solve Your Issu</a>
                @else
                <a href="{{ route('checkout')}}">Proceed to Checkout</a>
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- cart-area end -->
@endsection
@section('footer_scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('#cupon_button').click(function(){
      let coupon_input = $('#apply_coupon_name').val();
      let go_to_link = "{{ url('card') }}/"+coupon_input;
      window.location.href = go_to_link;
    });

    $('.valid_coupon_name').click(function(){
      $('#apply_coupon_name').val($(this).val());
    });
  });
</script>
@endsection
