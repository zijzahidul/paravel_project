<?php
  function total_count_product(){
    return App\Product::count();
  }

  function total_count_cart(){
    return App\Cart::where('generator_cart_id' , Cookie::get('g_cart_id'))->count();
  }

  function cart_items(){
    return App\Cart::where('generator_cart_id' , Cookie::get('g_cart_id'))->get();
  }

  function review_customer_count($product_id){
    return App\Order_detail::where('product_id' , $product_id)->whereNotNull('review')->count();
  }

  function average_stars($product_id){
    $total_count = App\Order_detail::where('product_id' , $product_id)->whereNotNull('review')->count();
    $total_sum = App\Order_detail::where('product_id' , $product_id)->whereNotNull('review')->sum('stars');
    
    if($total_sum == 0){
      return 0;
    }
    else {
      return round($total_sum/$total_count);
    }
  }

  function total_alert_products(){
    return DB::table('products')->whereRaw('alert_quantity >= product_quantity')->count();
  }

