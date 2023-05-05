<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\SubCategory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Paystack;




class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('check.user');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        $categories = SubCategory::all();
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->subtotal();
        }


        $paystackPublicKey = env('PAYSTACK_PUBLIC_KEY');

        $cart_item_count = CartItem::where('user_id', auth()->user()->id)->count();
        $wishlist_item_count = Wishlist::where('user_id', auth()->user()->id)->count();
        $totalprice = $subtotal;
        // $shippingFee = (float) $request->input('shipping_fee');
        $total = $totalprice;

        return view('frontend.checkout', [
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
            'productItem' => $cartItems,
            'totalprice' => $totalprice,
            'total' => $total,
            'categories' => $categories,
            'paystackPublicKey'=>$paystackPublicKey,
        ]);
    }







    public function checkout(Request $request)
    {
        try {
            $cartItems = CartItem::where('user_id', auth()->id())->get();
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->subtotal();
            }

            $shippingFee = (float) $request->input('shipping_fee');
            $total = $subtotal + $shippingFee;
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $request->input('name'),
                'lastname'=>$request->input('lastname'),
                'reference'=>$request->input('reference'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'shipping_fee' => $shippingFee,
                'subtotal' => $subtotal,
                'total' => $total
            ]);
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'user_id' => auth()->id(),
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
                $item->delete();
            }
            $paymentData = [
                'email' => $request->input('email'),
                'amount' => $total * 100,
                "reference" => $request->input('reference'),
                "currency" => "NGN",
                'metadata' => [
                    'order_id' => $order->id
                ],
            ];
            $payment = Paystack::getAuthorizationUrl($paymentData)->redirectNow();

            return $payment;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'The paystack token has expired. Please refresh the page and try again');
        }
    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentReference = $request->input('reference');
        // Call Paystack API to verify payment
        $paymentStatus = Paystack::getPaymentData($paymentReference);

        if ($paymentStatus['data']['status'] === 'success') {
            $order = Order::find($paymentStatus['data']['metadata']['order_id']);
            $order->payment_date = Carbon::now();
            $order->status = 'paid';
            $order->save();

            return redirect()->route('orders.show', ['order' => $order])
                ->with('success', 'Payment successful');
        } else {
            return redirect()->route('orders.index')
                ->with('error', 'Payment failed');
        }
    }



    // public function handlePaystackWebhook(Request $request)
    // {
    //     try {
    //         $event = $request->input('event');
    //         if ($event === 'charge.success') {
    //             $reference = $request->input('data.reference');
    //             $order = Order::where('reference', $reference)->first();
    //             if ($order) {
    //                 $order->status = 'paid';
    //                 $order->save();
    //             }
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $exception) {
    //         Log::error($exception->getMessage());
    //         return back()->with('error', 'Ooop  Something Went Wrong');
    //     }
    // }





}
