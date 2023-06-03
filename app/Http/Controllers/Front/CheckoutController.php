<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\PaymentNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Paystack;




class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('check.user');
    }

    public function index(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->subtotal();
        }


        // $paystackPublicKey = env('PAYSTACK_PUBLIC_KEY');

        $totalprice = $subtotal;
        $shippingFee = (float) $request->input('shipping_fee');
        $total = $totalprice + $shippingFee;

        return view('frontend.checkout', [
            'productItem' => $cartItems,
            'totalprice' => $totalprice,
            'total' => $total,
            // 'categories' => $categories,
            // 'paystackPublicKey'=>$paystackPublicKey,
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
                'lastname' => $request->input('lastname'),
                'reference' => $request->input('reference'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'billing_address' => $request->input('billing_address'),
                'shipping_fee' => $shippingFee,
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'country_code'=>$request->input('country_code'),
                'zip_code'=>$request->input('zip_code'),
                'subtotal' => $subtotal,
                'total' => $total
            ]);
            $productInfo = [];

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'user_id' => auth()->id(),
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                $product = Product::find($item->product_id);
                $productInfo[] = [
                    'name' => $product->name,
                    'price' => $product->price
                ];

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
            return Paystack::getAuthorizationUrl($paymentData)->redirectNow();;
            // return $payment;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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

            // Retrieve the product information
            $productInfo = [];
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                $productInfo[] = [
                    'name' => $product->name,
                    'price' => $product->price
                ];
            }

            // Retrieve the authenticated user
            $user = auth()->user();

            // Send notification to user with product information
            $user->notify(new PaymentNotification($productInfo));

            // Send notification to administrator with product information
            $administratorEmail = 'admin@example.com';
            Notification::route('mail', $administratorEmail)
                ->notify(new PaymentNotification($productInfo));
            return response()->json(['success' => true]);
            // return back()->view('frontend.order' , ['order' => $order])->with('success', 'Payment successful');
        } else {
            return back()->with('error', 'Payment failed');
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
