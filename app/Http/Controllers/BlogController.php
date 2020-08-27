<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Blog;
use Carbon\Carbon;
use Auth;
use Image;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole');
  }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index' , [
          'blog_all' => Blog::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'blog_title' => 'required',
        'blog_short_description' => 'required',
        'blog_long_description' => 'required',
        'blog_photo' => 'required',
      ]);
        $slug_link = Str::slug($request->blog_title.'-'.Str::random(6));
        $model_id = Blog::insertGetId($request->except('_token' , 'blog_photo') + [
          'blog_created_by' => Auth::id(),
          'created_at' => Carbon::now(),
          'slug' => $slug_link,
        ]);
        if($request->hasFile('blog_photo')){
          $uploded_photo = $request->file('blog_photo');
          $new_photo_name = $model_id.'.'.$uploded_photo->getClientOriginalExtension();
          $new_photo_location = 'public/uploads/blog_photos/'.$new_photo_name;
          Image::make($uploded_photo)->resize(870,500)->save(base_path($new_photo_location) , 70);
          Blog::find($model_id)->update([
            'blog_photo' => $new_photo_name
          ]);
        }
        return back()->with('success_status','Blog Insert SuccessFully!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
