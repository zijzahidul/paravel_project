<?php

namespace App\Http\Controllers;

use Image;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFrom;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole');
  }

    function addcategory(){
      $categorys = Category::Latest()->get();
      $total_categorys = Category::count();
      $delete_categorys = Category::onlyTrashed()->get();
      $total_del_categorys = Category::onlyTrashed()->count();
      return view('admin/category/add' , compact('categorys' , 'total_categorys' , 'delete_categorys' , 'total_del_categorys'));
    }
    function post_category(CategoryFrom $request){
      $category_id = Category::insertGetId([
        'category_name' => $request->category_name,
        'category_description' => $request->category_description,
        'user_id' => Auth::id(),
        'created_at' => Carbon::now(),
      ]);
      if($request->hasFile('category_photo')){
        $uploded_photo = $request->file('category_photo');
        $new_photo_name = $category_id.'.'.$uploded_photo->getClientOriginalExtension();
        $new_photo_location = 'public/uploads/category_photos/'.$new_photo_name;
        Image::make($uploded_photo)->resize(200,200)->save(base_path($new_photo_location) , 60);
        Category::find($category_id)->update([
          'category_photo' => $new_photo_name
        ]);
      }
      return back()->with('success_status' , $request->category_name.' Category Insert Successfully!');
    }
    function trashcategory($category_id)
    {
      Category::findOrFail($category_id)->delete();
      return back()->with('trash_status' , 'ID '.$category_id.' Trash Successfully!');
    }
    function editcategory($category_id)
    {
      $category_info = Category::find($category_id);
      return view('admin/category/edit' , compact('category_info'));
    }
    function updatecategory(Request $request)
    {
      $request->validate([
        'category_name' => 'unique:categories,category_name,'.$request->category_id,
      ]);
      Category::find($request->category_id)->update([
        'category_name' => $request->category_name,
        'category_description' => $request->category_description,
      ]);

      if($request->hasFile('category_photo')){
        if(Category::find($request->category_id)->category_photo != 'default.png'){
          // delete photo
          $old_location = 'public/uploads/category_photos/'.Category::find($request->category_id)->category_photo;
          unlink(base_path($old_location));
        }
        $uploded_photo = $request->file('category_photo');
        $new_photo_name = $request->category_id.'.'.$uploded_photo->getClientOriginalExtension();
        $new_photo_location = 'public/uploads/category_photos/'.$new_photo_name;
        Image::make($uploded_photo)->resize(1920,1000)->save(base_path($new_photo_location) , 70);
        Category::find($request->category_id)->update([
          'category_photo' => $new_photo_name
        ]);
        return back()->with('success_status' , 'Category Update Successfully!!');
      }
      return back()->with('success_status' , 'Category Update Successfully!!');
    }

    function restorecategory($category_id)
    {
      Category::withTrashed()->find($category_id)->restore();
      return back()->with('restore_status' , 'ID '.$category_id.' Restore Successfully!');
    }
    function deletecategory($category_id)
    {
      Category::withTrashed()->find($category_id)->forceDelete();
      Product::where('category_id' , $category_id)->forceDelete();
      return back()->with('delete_status' , 'ID '.$category_id.' Delete Successfully!');
    }
    function markdelete(Request $request)
    {
      foreach ($request->category_id as $category_delete) {
        Category::find($category_delete)->delete();
      }
      return back()->with('mark_delete_success' , 'Mark As Delete Successfully!!');
    }

    function markrestore(Request $request)
    {
      switch ($request->button) {
        case 'Restore':
        if(isset($request->category_id)){
          foreach ($request->category_id as $category_restore) {
            Category::withTrashed()->find($category_restore)->restore();
          }
          return back()->with('restore_delete_success' , 'Mark As Restore Successfully!!');
        }
        else {
          return back()->with('check_please' , 'Please Item select!!!');
        }
        break;

        case 'Delete':
        if(isset($request->category_id)){
          foreach ($request->category_id as $category_restore) {
            Category::withTrashed()->find($category_restore)->forceDelete();
          }
          return back()->with('delete_status' , 'Mark As Permanent Delete Successfully!!');
        }
        else {
          return back()->with('delete_status' , 'Please Item select!!!');
        }
        break;
      }
    }
}
