<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_name' , 'category_description' , 'category_photo'];
    function relation_with_user_table()
    {
      return $this->hasOne('App\User', 'id', 'user_id');
    }
    function relation_with_product_table()
    {
      return $this->hasMany('App\Product', 'category_id', 'id');
    }
}
