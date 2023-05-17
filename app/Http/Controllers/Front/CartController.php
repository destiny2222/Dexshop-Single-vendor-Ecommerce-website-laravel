<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('check.user');
    }

    public function carthome(){


        $cart = CartItem::all();
        $totalprice = 0;
        foreach($cart as $carted){
            $totalprice += $carted->product->price * $carted->quantity;
        }

        // dd($totalprice);

        return view('frontend.cart', compact( 'cart', 'totalprice'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cartItem = CartItem::where('user_id', auth()->id())->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
            $cartItem->save();

        }

        return redirect(route('cart-home'))->with('success', 'Product added to cart successfully!');
    }


    public function increment($id)
    {
        $product_qty = CartItem::findOrFail($id);
        $product_qty->quantity += 1;
        $product_qty->save();

        return redirect()->back()->with('success', 'Product quantity updated successfully!');
    }

    public function decrement($id)
    {
        $product_qty = CartItem::findOrFail($id);
        $product_qty->quantity -= 1;
        if ($product_qty->quantity == 0) {
            $product_qty->delete();
        } else {
            $product_qty->save();
        }

        return redirect()->back()->with('success', 'Product quantity updated successfully!');
    }





    public function destroy($id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }



    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->total = CartItem::getTotal();
        $order->save();
    }
}
