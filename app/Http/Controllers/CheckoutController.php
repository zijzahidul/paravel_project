<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Order;
use App\Billing;
use App\Country;
use App\Product;
use App\Shipping;
use Carbon\Carbon;
use App\Order_detail;
use Illuminate\Http\Request;
use App\Mail\PuarchaseConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

   function checkout()
    {
      return view('frontend.checkout' , [
          'user' => User::find(Auth::id()),
          'countries' => Country::all(),
      ]);
    }

    public function ajaxRequest(Request $request)
    {
      $stringToSent = "";
      $cities = City::where('country_id' , $request->country_id)->get();
      foreach($cities as $city){
         $stringToSent .=  "<option value='".$city->id."'>".$city->name."</option>";
      }
      return $stringToSent;
    }



    function checkoutpost(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone_number' => 'required',
        'country_id' => 'required',
        'city_id' => 'required',
        'address' => 'required',
      ]);

      if($request->shipping_address_status){
          $shipping_id = Shipping::insertGetId([
            'name' => $request->shipping_name,
            'email' => $request->shipping_email,
            'phone_number' => $request->shipping_phone_number,
            'country_id' => $request->shipping_country_id,
            'city_id' => $request->shipping_city_id,
            'address' => $request->shipping_address,
            'created_at' => Carbon::now(),
        ]);
      }
      else {
        $shipping_id = Shipping::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);
      }
      $billing_id = Billing::insertGetId([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'country_id' => $request->country_id,
        'city_id' => $request->city_id,
        'address' => $request->address,
        'notes' => $request->notes,
        'created_at' => Carbon::now(),
      ]);

      $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'sub_total' => session('sub_total'),
        'discount_amount' => session('discount_amount'),
        'coupon_name' => session('coupon_name'),
        'total' => session('after_discount_amount_total'),
        'payment_option' => $request->payment_option,
        'billing_id' => $billing_id,
        'shipping_id' => $shipping_id,
        'created_at' => Carbon::now(),
      ]);

      foreach(cart_items() as $cart_item){
        Order_detail::insert([
          'order_id' => $order_id,
          'user_id' => Auth::id(),
          'product_id' => $cart_item->product_id,
          'product_quantity' => $cart_item->product_quantity,
          'product_price' => $cart_item->product->product_price,
          'created_at' => Carbon::now(),
        ]);
        Product::find($cart_item->product_id)->decrement('product_quantity', $cart_item->product_quantity);
        $cart_item->forceDelete();
      }
      
      $order_details = Order_detail::where('order_id' , 1)->get();
      Mail::to($request->email)->send(new PuarchaseConfirm($order_details));
      if($request->payment_option == 2){
        session(['order_id_from_checkout_page' => $order_id]);
        return redirect('stripe');
      }

      else {
        return redirect('/card');
      }
      
    }

    function testsms(){
      //POST Method example

      $url = "http://66.45.237.70/api.php";
      $number="01714895074,01840416216,01758418829,01842371261";
      $text="If you want to win a laptop, please contact this number 01840416216";
      $data= array(
      'username'=>"01840416216",
      'password'=>"CKT4SMZF",
      'number'=>"$number",
      'message'=>"$text"
      );

      $ch = curl_init(); // Initialize cURL
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $smsresult = curl_exec($ch);
      $p = explode("|",$smsresult);
      $sendstatus = $p[0];
    }

}