<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testmonial;
use Carbon\Carbon;
use Image;

class TestmonialController extends Controller
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
        return view('admin.testmonial.index' , [
          'testmonial_all' => Testmonial::all(),
          'testmonial_total' => Testmonial::count(),
          'testmonial_deleted' => Testmonial::onlyTrashed()->get(),
          'testmonial_deleted_total' => Testmonial::onlyTrashed()->count(),
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
      $testmonial_id = Testmonial::insertGetId($request->except('_token' , 'client_photo') + [
        'created_at' => Carbon::now(),
      ]);
      if($request->hasFile('client_photo')){
        $uploded_photo = $request->file('client_photo');
        $new_photo_name = $testmonial_id.'.'.$uploded_photo->getClientOriginalExtension();
        $new_photo_location = 'public/uploads/client_photos/'.$new_photo_name;
        Image::make($uploded_photo)->resize(135,105)->save(base_path($new_photo_location) , 70);
        Testmonial::find($testmonial_id)->update([
          'client_photo' => $new_photo_name
        ]);
      }
      return back()->with('success_status','Testmonial Insert SuccessFully!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.testmonial.edit' , [
          'client_info' => Testmonial::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testmonial $testmonial)
    {
        $testmonial->update($request->except('_token' , '_method' , 'client_photo'));

        if($request->hasFile('client_photo')){
          if($testmonial->client_photo != 'client.png'){
            // delete photo
            $old_location = 'public/uploads/client_photos/'.$testmonial->client_photo;
            unlink(base_path($old_location));
          }
          $uploded_photo = $request->file('client_photo');
          $new_photo_name = $testmonial->id.'.'.$uploded_photo->getClientOriginalExtension();
          $new_photo_location = 'public/uploads/client_photos/'.$new_photo_name;
          Image::make($uploded_photo)->resize(135,105)->save(base_path($new_photo_location) , 70);
          $testmonial->update([
            'client_photo' => $new_photo_name
          ]);
          return back()->with('success_sms' , 'Product Update Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testmonial $testmonial)
    {
        $testmonial->delete();
        return back()->with('trash_sms' , 'Product Trash Successfully!!');
    }

    public function testmonialrestore($testmonial_id)
    {
      Testmonial::withTrashed()->find($testmonial_id)->restore();
      return back()->with('restore_sms' , 'Product Restore Successfully!!');
    }

    public function testmonialdelete($testmonial_id)
    {
      Testmonial::withTrashed()->find($testmonial_id)->forceDelete();
      return back()->with('delete_sms' , 'Product Delete Successfully!!');
    }
}
