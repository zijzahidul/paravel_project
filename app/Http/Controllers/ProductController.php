<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\NumValidationRule;
use Illuminate\Support\Str;
use App\Category;
use Carbon\Carbon;
use App\Product;
use App\Product_image;
use Image;


class ProductController extends Controller
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
        return view('admin.product.index' , [
          'category_all' => Category::all(),
          'product_all' => Product::with('relation_with_category_table')->get(),
          'product_deleted' => Product::onlyTrashed()->get(),
          'product_deleted_total' => Product::onlyTrashed()->count(),
          'product_total' => Product::all()->count(),
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

      $slug_link = Str::slug($request->product_name.'-'.Str::random(6));
       $request->validate([
         'product_name' => ['required' , 'unique:products,product_name' , new NumValidationRule],
         'category_id' => 'required|numeric',
         'product_price' => 'required|numeric',
         'product_short_description' => 'required',
         'product_long_description' => 'required',
         'product_quantity' => 'required|numeric',
         'alert_quantity' => 'required|numeric',
       ]);
        $product_id = Product::insertGetId($request->except('_token' , 'product_photo' , 'product_multiple_photo') + [
          'created_at' => Carbon::now(),
          'slug' => $slug_link,
        ]);
        if($request->hasFile('product_photo')){
          $uploded_photo = $request->file('product_photo');
          $new_photo_name = $product_id.'.'.$uploded_photo->getClientOriginalExtension();
          $new_photo_location = 'public/uploads/product_photos/'.$new_photo_name;
          Image::make($uploded_photo)->resize(500,385)->save(base_path($new_photo_location) , 70);
          Product::find($product_id)->update([
            'product_photo' => $new_photo_name
          ]);

          if($request->hasFile('product_multiple_photo')){
            $flag = 1;
            foreach ($request->file('product_multiple_photo') as $single_photo) {
              $uploded_photo = $single_photo;
              $new_photo_name = $product_id."-".$flag.'.'.$uploded_photo->getClientOriginalExtension();
              $new_photo_location = 'public/uploads/product_multiple_photos/'.$new_photo_name;
              Image::make($uploded_photo)->resize(500,385)->save(base_path($new_photo_location) , 70);
              $flag++;
              Product_image::insert([
                'product_id' => $product_id,
                'product_multiple_image_name' => $new_photo_name,
                'created_at' => Carbon::now(),
              ]);
            }
          }
        return back()->with('success_status' , $request->product_name." Product Insert SuccessFully!!");
      }
      return back()->with('success_message' , 'Product Insert SuccessFully!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      return view('admin.product.edit' ,[
        'product_info' => $product,
        'category_info' => Category::all(),
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('_token' , '_method' , 'product_photo'));
        if($request->hasFile('product_photo')){
          if($product->product_photo != 'thumbnail.png'){
            // delete photo
            $old_location = 'public/uploads/product_photos/'.$product->product_photo;
            unlink(base_path($old_location));
          }
          $uploded_photo = $request->file('product_photo');
          $new_photo_name = $product->id.'.'.$uploded_photo->getClientOriginalExtension();
          $new_photo_location = 'public/uploads/product_photos/'.$new_photo_name;
          Image::make($uploded_photo)->resize(500,385)->save(base_path($new_photo_location) , 70);
          $product->update([
            'product_photo' => $new_photo_name
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
    public function destroy(Product $product)
    {
      $product->delete();
      return back()->with('trash_status' , 'Delete Successfully!!!');
    }

    public function productrestore($resoter_id)
    {
      Product::withTrashed()->find($resoter_id)->restore();
      return back()->with('restore_status' , 'ID '.$resoter_id.' Restore Successfully!');

    }

    public function productdelete($delete_id)
    {
      Product::withTrashed()->find($delete_id)->forceDelete();
      return back()->with('delete_status' , 'ID '.$delete_id.' Delete Successfully!');

    }

    public function markrestoredelete(Request $request)
    {
      switch ($request->button) {
        case 'Restore':
          if (isset($request->product_id)) {
            foreach ($request->product_id as $single_product) {
              Product::withTrashed()->find($single_product)->restore();
            }
            return back()->with('mark_restore' , 'Mark Restore Successfully!!!');
          }
          break;

          case 'Delete':
            if (isset($request->product_id)) {
              foreach ($request->product_id as $single_product) {
                Product::withTrashed()->find($single_product)->forceDelete();
              }
              return back()->with('force_delete' , 'Mark Delete Successfully!!!');
            }
          break;
      }
    }

}
