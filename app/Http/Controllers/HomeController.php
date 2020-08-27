<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Customerinfo;
use App\Mail\NewsLetter;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // $users = User::orderBy('id' , 'desc')->paginate(3);
       $users = User::latest()->paginate(3);
       $total_users = User::count();
       return view('home' , compact('users' , 'total_users'));
    }
    public function sendnewsletter()
    {
      foreach (User::all()->pluck('email') as $single_email) {
        Mail::to($single_email)->queue(new NewsLetter());
      }
      return back()->with('success_status' , 'Newsletter Send SuccessFully!!');
    }
    function filedownload($customer_id)
    {
      return Storage::download(Customerinfo::findOrFail($customer_id)->customer_file);
    }
    
}
