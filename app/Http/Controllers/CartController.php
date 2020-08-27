<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;

class CartController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
    function cartstore(Request $request)
    {
      if(Cookie::get('g_cart_id')){
        $generator_cart_id = Cookie::get('g_cart_id');
      }
      else {
        $generator_cart_id = Str::random(5).rand(2,1000);
        Cookie::queue('g_cart_id' , $generator_cart_id , 1440);
      }
     if(Cart::where('generator_cart_id' , $generator_cart_id)->where('product_id' , $request->product_id)->exists()){
       Cart::where('generator_cart_id' , $generator_cart_id)->where('product_id' , $request->product_id)->increment('product_quantity' , $request->product_quantity);
     }
     else {
       Cart::insert([
         'generator_cart_id' => $generator_cart_id,
         'product_id' => $request->product_id,
         'product_quantity' => $request->product_quantity,
         'created_at' => Carbon::now(),
       ]);
     }
     return back();
    }

    function cardindex($coupon_name = "")
    {
      $error_message = "";
      $discount_percent = 0;
      if($coupon_name == ''){
        $error_message = "";
      }
      else {
        if(!Coupon::where('coupon_name' , $coupon_name)->exists()){
          $error_message = "This coupon dose not match";
        }
        else {
          if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name' , $coupon_name)->first()->validity_till){
            $error_message = "This coupon Date Over";
          }
          else {
            $sub_total = 0;
            foreach (cart_items() as $single_cart) {
              $sub_total += $single_cart->product->product_price * $single_cart->product_quantity;
            }
            if(Coupon::where('coupon_name' , $coupon_name)->first()->min_purchase_amount > $sub_total){
              $error_message = "You Have to shop more than or equal ".Coupon::where('coupon_name' , $coupon_name)->first()->min_purchase_amount;
            }
            else {
              $discount_percent = Coupon::where('coupon_name' , $coupon_name)->first()->discount_percent;
            }
          }
        }
      }
      $valid_coupon = Coupon::whereDate('validity_till' , '>=' , Carbon::now()->format('Y-m-d'))->get();
      return view('frontend.cardview' , compact('discount_percent' , 'error_message' , 'coupon_name' ,'valid_coupon'));
    }

    function cartupdate(Request $request)
    {
      foreach ($request->product_update as $cart_id => $product_quantity) {
        Cart::findOrFail($cart_id)->update([
          'product_quantity' => $product_quantity
        ]);
      }
      return back()->with('update_status' , 'Your Update Successfully!!');
    }

    function cartdestroy($cart_id)
    {
      Cart::withTrashed()->find($cart_id)->forceDelete();
      return back()->with('delete_status' , 'ID '.$cart_id.' Delete Successfully!');
    }


}
