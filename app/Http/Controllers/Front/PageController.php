<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Contact as MailContact;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductFeedback;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    //
    public function home()
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }


        $categories = SubCategory::all();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();
        return view('frontend.index', [
            'categories' => $categories,
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count
        ]);
    }


    public function blog()
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }

        $categories = Category::all();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();

        return view('frontend.blog',[
            'categories' => $categories,
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
        ]);
    }

    public function contact()
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }

        $categories = Category::all();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();
        return view('frontend.contact', [
            'categories' => $categories,
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
        ]);
    }


    public function ItemDetails($subcategory_id)
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }

        $categories = Category::all();
        $subcategory = Subcategory::where('slug', $subcategory_id)->firstOrFail();
        $products = Product::where('subcategory_id', $subcategory->id)->get();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();

        return view('frontend.product', [
            'products' => $products,
            'categories' => $categories,
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
        ]);
    }

    public function shop()
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }


        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->get();
        $subcategories = SubCategory::with('products')->get();

        // counting the numbers od times subcategory is used by a product
        $count = 0;
        foreach ($subcategories as $subcategory) {
            $count += $subcategory->products->count();
        }




        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();
        return view('frontend.shop', [
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'count' => $count,
        ]);
    }

    public function show(Product  $product)
    {
        if (!Auth::check()) {
            $user = Auth::user();
        } else {
            $user = Auth::user()->id;
        }



        $categories = Category::all();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();
        return view('frontend.product-detail', [
            'product' => $product,
            'categories' => $categories,
            'cart_item_count' => $cart_item_count,
            'wishlist_item_count' => $wishlist_item_count,
        ]);
    }

    public function storeRate(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'nullable|integer|between:1,5',
            'message'=>'nullable|string'
        ]);

        if (!Auth::check()) {
            return back()->with(['error'=> 'You must be Logged In']);
        } else {
            $user_id = Auth::user()->id;
        }


        $rating = new ProductRating();
        $rating->product_id = $request->product_id;
        $rating->user_id = $user_id;
        $rating->rating = $validatedData['rating'];
        $rating->save();

        $feedback = new ProductFeedback();
        $feedback->product_id = $request->product_id;
        $feedback->user_id = $user_id;
        $feedback->message = $validatedData['message'];
        $feedback->save();


        return redirect()->back()->with('success', 'Rating and feedback submitted successfully!');
    }

    public function contactform(Request $request){
        $request->validate([
            'name'=>['required', 'string'],
            'email'=>['required', 'string', 'email'],
            'subject'=>['required', 'string'],
            'message'=>['required', 'string'],
        ]);

        try{
            $contact = Contact::create($request->all());
            // dd($contact);
            if ($contact) {
              Mail::to('destinyerieme47@mail.com')->send(new MailContact($contact));
             return back()->with('success', 'Your Message Have Been Sent Successful');
            }
            return back()->with('error', 'Oops something went wrong');
        }catch(\Exception $exception){
          Log::error($exception->getMessage());
          return back()->with('error', 'Oops something went wrong');
        }
    }

}
