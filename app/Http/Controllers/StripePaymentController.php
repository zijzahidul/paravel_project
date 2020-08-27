<?php
namespace App\Http\Controllers;   
use Stripe;
use Session;
use App\Order;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        if(session('order_id_from_checkout_page')){
            return view('stripe.index');
        }
        else {
            abort(404);
        }
    }
    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)
    {
        $amount = session('after_discount_amount_total');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => $amount * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com." 

        ]);
        Session::flash('success', 'Payment successful!');
        Order::find(session('order_id_from_checkout_page'))->update([
            'payment_status' => 2
        ]);

        session([
          'sub_total' => '',
          'coupon_name' => '',
          'discount_amount' => '',
          'after_discount_amount_total' => '',
          'order_id_from_checkout_page' => '',
        ]);
        return redirect('/card');
    }
}
