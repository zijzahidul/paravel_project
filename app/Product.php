<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    function relation_with_category_table()
    {
      return $this->hasOne('App\Category', 'id', 'category_id')->withTrashed();
    }
    function relation_with_product_image_table()
    {
      return $this->hasMany('App\Product_image', 'product_id', 'id')->withTrashed();
    }
}
