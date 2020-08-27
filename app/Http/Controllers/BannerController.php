<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Image;

class BannerController extends Controller
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
        return view('admin.banner.index' , [
          'banners_all' => Banner::all(),
          'banners_total' => Banner::count(),
          'banner_deleted' => Banner::onlyTrashed()->get(),
          'banner_deleted_total' => Banner::onlyTrashed()->count(),
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
        'banner_heading' => 'required',
        'banner_description' => 'required',
        'banner_button' => 'required',
        'button_link' => 'required',
        'banner_photo' => 'required',
      ]);

      $banner_id = Banner::insertGetId($request->except('_token' , 'banner_photo') + [
        'created_at' => Carbon::now(),
      ]);
      if($request->hasFile('banner_photo')){
        $uploded_photo = $request->file('banner_photo');
        $new_photo_name = $banner_id.'.'.$uploded_photo->getClientOriginalExtension();
        $new_photo_location = 'public/uploads/banner_photos/'.$new_photo_name;
        Image::make($uploded_photo)->resize(1920,1000)->save(base_path($new_photo_location) , 70);
        Banner::find($banner_id)->update([
          'banner_photo' => $new_photo_name
        ]);
      }
      return back()->with('success_status','Banner Insert SuccessFully!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.banner.edit',[
          'banner_info' => Banner::find($id),
        ]);
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
      Banner::find($id)->update($request->except('_token' , '_method' , 'banner_photo'));
      if($request->hasFile('banner_photo')){
        if(Banner::find($id)->banner_photo != 'banner.jpg'){
          // delete photo
          $old_location = 'public/uploads/banner_photos/'.Banner::find($id)->banner_photo;
          unlink(base_path($old_location));
        }
        $uploded_photo = $request->file('banner_photo');
        $new_photo_name = $id.'.'.$uploded_photo->getClientOriginalExtension();
        $new_photo_location = 'public/uploads/banner_photos/'.$new_photo_name;
        Image::make($uploded_photo)->resize(1920,1000)->save(base_path($new_photo_location) , 70);
        Banner::find($id)->update([
          'banner_photo' => $new_photo_name
        ]);
        return back()->with('success_status' , 'Banner Update Successfully!!');
      }
      return back()->with('success_status' , 'Banner Update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('trash_success' , 'Trash Successfully!!');
    }

    public function bannerrestore($banner_id)
    {
        Banner::withTrashed()->find($banner_id)->restore();
        return back()->with('restore_success' , 'Restore Successfully!!');
    }

    public function bannerdelete($banner_id)
    {
        Banner::withTrashed()->find($banner_id)->forceDelete();
        return back()->with('delete_success' , 'Delete Successfully!!');
    }
}
