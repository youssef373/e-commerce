<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripPayment($totalPrice)
    {
        $user_id = Auth::user()->id;
        $userProducts = Cart::where('user_id', $user_id)->get();
        $productsCount = $userProducts->count();
    
        return view('user.strip', compact('totalPrice', 'productsCount'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $userProducts = Cart::where('user_id', $user_id)->get();
                $productsCount = $userProducts->count();

                foreach ($userProducts as $userProduct) {
                    $order = new Order;
                    $order->name = $userProduct->name;
                    $order->email = $userProduct->email;
                    $order->phone = $userProduct->phone;
                    $order->address = $userProduct->address;
                    $order->user_id = $userProduct->user_id;
                    $order->product_title = $userProduct->product_title;
                    $order->price = $userProduct->price;
                    $order->quantity = $userProduct->quantity;
                    $order->image = $userProduct->image;
                    $order->Product_id = $userProduct->Product_id;

                    $order->payment_status = 'paid';
                    $order->delivery_status = 'processing';

                    $order->save();

                    $cart_product_id = $userProduct->id;
                    $cart_product = Cart::find($cart_product_id);
                    $cart_product->delete();
                }
            }
        }

        Session::flash('success', 'Payment successful!');

        return  back();
    }
}
