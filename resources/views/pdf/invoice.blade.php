<h1>This is a Order Invoice PDF File</h1>

<h4>Hello, {{ Auth::user()->name }}</h4>

<br>
<ul>
    <li> Customer Name : {{ Auth::user()->name }} </li>
    <li> Order ID : {{ $order_info->id }}</li>
    <li> Sub Total : $ {{ $order_info->sub_total }}</li>
    <li>
        Coupon Name : 
        @if ($order_info->coupon_name == '-')
            No Coupon Added
        @else 
            {{ $order_info->coupon_name }}
        @endif 
    </li>
    <li> Discount Amount : $ {{ $order_info->discount_amount }}</li>
    <li> Total : $ {{ $order_info->total }}</li>

    <li>
        Payment Option : 
        @if ( $order_info->payment_option == 1)
            Cash On Delivery
        @else 
            Credit Cart
        @endif 
    </li>

</ul>
 



    
