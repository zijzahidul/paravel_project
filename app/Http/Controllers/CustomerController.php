<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_detail;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customerHome(){
      return view('customer/home', [
          'order_info' => Order::with('order_detail')->where('user_id', Auth::id())->get(),
        ]);
    }
    
    public function downloadinvoice($order_id){
      // return $order_id;
      $order_info = Order::find($order_id);

      $pdf = PDF::loadView('pdf.invoice' , compact('order_info'));
      return $pdf->download('paravel (ID'.$order_id.').pdf');

    }
}
