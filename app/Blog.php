<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
  use SoftDeletes;
  protected $guarded = [];
  function relation_with_user_table()
  {
    return $this->hasOne('App\User', 'id', 'blog_created_by');
  }
}
