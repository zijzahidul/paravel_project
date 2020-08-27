@extends('layouts.frontend_app')

@section('frontend_content')

    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>

                        <form action="{{ url('checkout/post') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <p> Name *</p>
                                <input type="text" value = "{{ $user->name }}" name = "name">
                                @error ('name')
                                   <span class = "text-danger">{{ $message }}</span>
                                @enderror

                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value = "{{ $user->email }}" name = "email">
                                    @error ('email')
                                        <span class = "text-danger">{{ $message }}</span>
                                        @enderror
                                </div> 

                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name = "phone_number">
                                    @error ('phone_number')
                                        <span class = "text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Country</p>
                                    <select id="select_id_one" name = "country_id">
                                        <option value="1">Select a country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                    @error ('country_id')
                                        <span class = "text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select id="select_id_two" name = "city_id">
                                        <option value="1">Select Country</option>
                                    </select>
                                    @error ('city_id')
                                        <span class = "text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name = "address">
                                    @error ('address')
                                        <span class = "text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                               
                                <div class="col-12">
                                    <input id="toggle2" type="checkbox" name  = "shipping_address_status" value = "1">
                                    <label class="fontsize" for="toggle2">Ship to a different address?</label>


                                        <div class = "row">
                                            <div class="col-12">
                                                <p> Name *</p>
                                            <input type="text" name = "shipping_name">
    
                                            </div>
            
                                            <div class="col-12">
                                                <p>Email Address *</p>
                                                <input type="email" name = "shipping_email">
                                           
                                            </div> 
            
                                            <div class="col-12">
                                                <p>Phone No. *</p>
                                                <input type="text" name = "shipping_phone_number">
                                                        
                                            </div>
            
                                            <div class="col-12">
                                                <p>Country</p>
                                                <select id="select_id_three" name = "shipping_country_id">
                                                    <option value="1">Select a country</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach   
                                                </select>
                                           
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <p>Town/City *</p>
                                                <select id="select_id_four" name = "shipping_city_id">
                                                    <option value="1">Select a country</option>
                                                </select>
                                           
                                            </div>
            
                                            <div class="col-12">
                                                <p>Your Address *</p>
                                                <input type="text" name = "shipping_address">
                                          
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                   
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @foreach (cart_items() as $cart_item)
                            <li> {{ $cart_item->product->product_name }} X {{ $cart_item->product_quantity }} <span class="pull-right">$ {{ $cart_item->product->product_price * $cart_item->product_quantity }}.00</span></li>
                            @endforeach

                            <li>Subtotal <span class="pull-right"><strong>$ {{ session('sub_total') }}</strong></span></li>
                            <li>Discount Amount ({{ session('coupon_name') }}) <span class="pull-right">$ {{ session('discount_amount') }}</span></li>
                            <li>Total<span class="pull-right">$ {{ session('after_discount_amount_total') }}</span></li>
                        </ul>
                        <ul class="payment-method">

                            <li>
                                <input value = "1" name = "payment_option" id="delivery" type="radio" checked>
                                <label for="delivery">Cash on Delivery</label>
                            </li>

                           
                            <li>
                                <input value = "2" name = "payment_option" id="card" type="radio">
                                <label for="card">Credit Card</label>
                            </li>
                           
                        </ul>
                        <button type="submit">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection

@section('footer_scripts')
 <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#select_id_one').select2();
        $('#select_id_two').select2();
        $('#select_id_three').select2();
        $('#select_id_four').select2();

        $('#select_id_one').change(function(){
            var country_id = $(this).val();

        // Ajax Start
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        type:'POST',
        url:'/ajaxRequest',
        data:{country_id:country_id},
        success:function(data){
            $('#select_id_two').html(data)
        }
        });
        // Ajax End
        });


        $('#select_id_three').change(function(){
            var country_id = $(this).val();

        // Ajax Start
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        type:'POST',
        url:'/ajaxRequest',
        data:{country_id:country_id},
        success:function(data){
            $('#select_id_four').html(data)
        }
        });
        // Ajax End
        });


    });
 </script>




@endsection