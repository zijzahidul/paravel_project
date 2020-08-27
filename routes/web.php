<?php

use Illuminate\Support\Facades\Route;

//Frontend Router
Route::get('/' , 'FrontendController@index');
Route::get('contact' , 'FrontendController@contact');
Route::get('about' , 'FrontendController@about');
Route::get('product/details/{slug}' , 'FrontendController@productdetails')->name('productdetails');
Route::post('contact/post' , 'FrontendController@contactpost')->name('contactpost');
Route::post('coustomer/email' , 'FrontendController@coustomeremail')->name('coustomeremail');
Route::get('shop/page' , 'FrontendController@shoppage')->name('shoppage');
Route::get('category/view/{category_id}' , 'FrontendController@categoryview')->name('categoryview');
Route::get('blog/view' , 'FrontendController@blogview')->name('blogview');
Route::get('blog/details/{slug}' , 'FrontendController@blogdetails')->name('blogdetails');
Route::get('login/registration' , 'FrontendController@loginregistration')->name('loginregistration');
Route::post('customer/registration' , 'FrontendController@customerregistration')->name('customer.registration');
Route::get('customer/loginpage' , 'FrontendController@customerloginpage')->name('customer.loginpage');
Route::post('review/post' , 'FrontendController@reviewpost');

Auth::routes(['verify' => true]);

//HomeController Router
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('send/newsletter', 'HomeController@sendnewsletter');
Route::get('file/download/{customer_id}', 'HomeController@filedownload')->name('filedownload');

//OrderController Router
Route::resource('order' , 'OrderController');
Route::get('order/cancel/{order_id}', 'OrderController@ordercancel')->name('order.cancel');

//BannerController Router
Route::resource('banner' , 'BannerController');
Route::get('banner/restore/{banner_id}' , 'BannerController@bannerrestore')->name('bannerrestore');
Route::get('banner/delete/{banner_id}' , 'BannerController@bannerdelete')->name('bannerdelete');

//FaqController Router
Route::resource('faq' , 'FaqController');
Route::get('faq/restore/{faq_id}' , 'FaqController@faqrestore')->name('faqrestore');
Route::get('faq/delete/{faq_id}' , 'FaqController@faqdelete')->name('faqdelete');

//TestmonialController Router
Route::resource('testmonial' , 'TestmonialController');
Route::get('testmonial/restore/{testmonial_id}' , 'TestmonialController@testmonialrestore')->name('testmonialrestore');
Route::get('testmonial/delete/{testmonial_id}' , 'TestmonialController@testmonialdelete')->name('testmonialdelete');

//CustomerinfoController Router
Route::resource('customerinfo' , 'CustomerinfoController');

//CustomeEmailController Router
Route::resource('customerEmail' , 'CustomerEmailController');

//BlogController Router
Route::resource('blog' , 'BlogController');

//CouponController Router
Route::resource('coupon' , 'CouponController');

//CartController Router
Route::post('cart/store' , 'CartController@cartstore')->name('cart.store');
Route::get('card' , 'CartController@cardindex')->name('card.index');
Route::get('card/{coupon_name}' , 'CartController@cardindex');
Route::post('cart/update' , 'CartController@cartupdate')->name('cart.update');
Route::get('cart/destroy/{cart_id}' , 'CartController@cartdestroy')->name('cart.destroy');

//Category Router
Route::get('admin/category/add' , 'CategoryController@addcategory');
Route::post('category/post' , 'CategoryController@post_category');
Route::get('category/trash/{category_id}' , 'CategoryController@trashcategory');
Route::get('category/edit/{category_id}' , 'CategoryController@editcategory');
Route::post('category/update' , 'CategoryController@updatecategory');
Route::get('restore/category/{category_id}' , 'CategoryController@restorecategory');
Route::get('delete/category/{category_id}' , 'CategoryController@deletecategory');
Route::post('mark/delete' , 'CategoryController@markdelete');
Route::post('mark/restore' , 'CategoryController@markrestore');

//Profile Router
Route::get('profile/index' , 'ProfileController@profilename');
Route::post('profile/insert' , 'ProfileController@profileinsert');
Route::post('edit/password/post' , 'ProfileController@profileeditpassword');
Route::post('profile/image/upload' , 'ProfileController@profileimageupload');

//ProductController Router
Route::resource('product' , 'ProductController');
Route::get('product/resotre/{resoter_id}' , 'ProductController@productrestore')->name('productrestore');
Route::get('product/delete/{delete_id}' , 'ProductController@productdelete')->name('productdelete');
Route::post('mark' , 'ProductController@markrestoredelete')->name('markrestoredelete');

//CustomerController Router
Route::get('customer/home' , 'CustomerController@customerhome');
Route::get('download/invoice/{order_id}' , 'CustomerController@downloadinvoice');

//CustomerController Router
Route::get('checkout' , 'CheckoutController@checkout')->name('checkout');
Route::post('checkout/post' , 'CheckoutController@checkoutpost');
Route::post('ajaxRequest' , 'CheckoutController@ajaxRequest');

Route::get('test/sms' , 'CheckoutController@testsms');

// GithubController
Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');

// // GoogleController
// Route::get('login/google', 'GoogleController@redirectToProvider');
// Route::get('login/google/callback', 'GoogleController@handleProviderCallback');


//StripePaymentController 
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

