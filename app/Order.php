<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes;
  protected $guarded = [];

  // function order_details(){
  //   return $this->hasMany('App\Order_detail');
  // }
  // function product(){
  //   return $this->hasMany('App\Product');
  // }


  function order_detail(){
      return $this->hasMany('App\Order_detail');
  }

  function user(){
      return $this->belongsTo('App\User');
  }


}
