<?php

namespace App\Http\Controllers;

use Auth;
use App\Faq;
use App\Blog;
use App\User;
use App\Banner;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\Testmonial;
use App\Customerinfo;
use App\Order_detail;
use App\CustomerEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    function index(){
      return view('frontend.index' , [
        'banner_all' => Banner::all(),
        'category_all' => Category::all(),
        'product_all' => Product::all(),
        'testmonial_all' => Testmonial::all(),
      ]);
    }
    function contact(){
      return view('frontend.contact');
    }
    function contactpost(Request $request){
      $request->validate([
        'customer_name' => 'required',
        'customer_email' => 'required|email',
        'customer_subject' => 'required',
        'customer_message' => 'required',
      ]);
      $customer_id = Customerinfo::insertGetId($request->except('_token')+[
        'created_at' => Carbon::now(),
      ]);
      if($request->hasFile('customer_file')){
        // $path = $request->file('customer_file')->store('customer_uploads');
        $path = $request->file('customer_file')->storeAs(
          'customer_uploads', $customer_id.".".$request->file('customer_file')->extension(),
        );
        Customerinfo::find($customer_id)->update([
          'customer_file' => $path,
        ]);
      }
      return back()->with('success_status' , 'We Recived SuccessFully!!!');
    }

    function about(){
      return view('about');
    }

    function productdetails($slug){
      $product_info = Product::where('slug' , $slug)->firstOrFail();
      $related_products = Product::where('category_id' , $product_info->category_id)->where('id','!=',$product_info->id)->get();
      $show_review_from = 0; 

      if(Order_detail::where('user_id' , Auth::id())->where('product_id' , $product_info->id)->whereNull('review')->exists()){
        $order_details_id = Order_detail::where('user_id' , Auth::id())->where('product_id' , $product_info->id)->whereNull('review')->first()->id;
        $show_review_from = 1;    
      }
      else {
        $show_review_from = 2;
        $order_details_id = 0;
      }
      $reviews = Order_detail::where('product_id' , $product_info->id)->whereNotNull('review')->get();
      return view('frontend.productdetails' , [
        'actvie_product' => $product_info,
        'related_products' => $related_products,
        'faq_all' => Faq::all(),
        'show_review_from' => $show_review_from,
        'order_details_id' => $order_details_id,
        'reviews' => $reviews,
      ]);
    }

    function coustomeremail(Request $request){
      $request->validate([
        'email' => 'required|email|unique:customer_emails,email'
      ]);

      CustomerEmail::insert($request->except('_token')+[
        'created_at' => Carbon::now(),
      ]);
      return back()->with('success_email' , 'Subscribe Successfully!!');

    }
    public function shoppage()
    {
      return view('frontend.shop' , [
        'categories_info' => Category::all(),
        'product_info' => Product::all(),
      ]);
    }
    public function categoryview($category_id)
    {
      return view('frontend.categorydetails' , [
        'product_info' => Product::where('category_id' , $category_id)->get(),
        'categories_info' => Category::find($category_id),
        'faq_all' => Faq::all(),
      ]);
    }
    public function blogview()
    {
      return view('frontend.blog' , [
          'blog_all' => Blog::all(),
      ]);
    }
    public function blogdetails($slug)
    {
      return view('frontend.blogdetails' , [
         'blog_details_info' => Blog::where('slug' , $slug)->firstOrFail(),
         'blog_all' => Blog::latest()->limit(4)->get(),
      ]);
    }
    function loginregistration()
    {
      return view('frontend.loginregistration');
    }
    function customerregistration(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
      User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 2,
        'created_at' => Carbon::now(),
      ]);
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('customer/home');
      }
      return back()->with('success_status' , $request->name.' Your Account Create Successfully !!!');
    }

    function customerloginpage()
    {
      return view('frontend.customerloginpage');
    }
    function reviewpost(Request $request)
    {
      // return $request->all();
      Order_detail::find($request->order_details_id)->update([
        'stars' => $request->stars,
        'review' => $request->review,
      ]);
      return back();
    }
   
}
