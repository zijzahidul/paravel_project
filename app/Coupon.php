<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
  use SoftDeletes;
  protected $guarded = [];
  function relation_with_user_table()
  {
    return $this->hasOne('App\User', 'id', 'create_by');
  }
}
