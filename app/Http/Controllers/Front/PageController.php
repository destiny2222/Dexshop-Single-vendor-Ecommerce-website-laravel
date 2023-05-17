<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Contact as MailContact;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductFeedback;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    //
    public function home()
    {

        $category = Category::with('subcategories')->first()->take(1);

        if ($category) {
            // Categories exist in the database
            $categor = $category->get();
        } else {
            // No categories in the database
            $categor = [];
        }



        // post crud
        $blog = Blog::orderBy('id', 'desc')->paginate(3);
        // search


        // product eloquent
        $discount_products = Product::where('discount', '>', 0)->get();
        $featured_products = Product::where('is_featured', '>', 0)->get();
        $new_products = Product::where('badge', 'new')->get();
        $soldProducts = Product::where('badge', 'sale')->get();


        return view('frontend.index', [
            'categor' => $categor,
            'blog' => $blog,
            'sellingproduct' => $soldProducts,
            'discount_products' => $discount_products,
            'featured_products' => $featured_products,
            'new_products' => $new_products,
        ]);
    }


    public function blog()
    {
        //


        $blog = Blog::orderBy('id', 'desc')->paginate(3);
        $blogtag = Tag::latest('id')->get();
        $category = BlogCategory::latest('id')->get();
        $recentpost = Blog::latest('id')->get();


        return view('frontend.blog', [
            'blog' => $blog,
            'recentpost' => $recentpost,
            'blogtag' => $blogtag,
            'category' => $category,
        ]);
    }

    public function showCategory($slug)
    {
        $categor = Category::latest('id')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Blog::where('category_id', $category->id)->paginate(10);

        return view('frontend.category', compact('category', 'categor', 'posts'));
    }


    public function blogdetails(Blog $blog)
    {
        //
        $blogtag = Tag::latest('id')->get();
        $recentblog = Blog::latest('id')->get();
        return view('frontend.single', compact('blog', 'recentblog', 'blogtag'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        try {
            $query = $request->input('query');
            $posts = Blog::where('name', 'like', "%$query%")->orWhere('body', 'like', "%$query%")->get();
            return view('frontend.search', compact('posts', 'query'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops invaild feed');
        }
    }

    function searchProducts(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        try {
            $query = $request->input('query');
            $product = Product::where('name', 'like', "%$query%")->orWhere('body', 'like', "%$query%")->get();
            return View('frontend.search', compact('product', 'query'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Oops invalid feed');
        }
    }



    public function contact()
    {

        return view('frontend.contact');
    }


    public function ItemDetails($subcategory_id)
    {

        $subcategory = Subcategory::where('slug', $subcategory_id)->firstOrFail();
        $products = Product::where('subcategory_id', $subcategory->id)->get();

        dd($products);
        return view('frontend.product', [
            'products' => $products,
        ]);
    }

    public function shop()
    {


        $products = Product::orderBy('id', 'desc')->get();
        $subcategories = SubCategory::with('products')->get();

        // counting the numbers of times subcategory is used by a product
        $count = 0;
        foreach ($subcategories as $subcategory) {
            $count += $subcategory->products->count();
        }


        return view('frontend.shop', [
            'subcategories' => $subcategories,
            'products' => $products,
            'count' => $count,
        ]);
    }

    public function show(Product  $product)
    {

        return view('frontend.product-detail', [
            'product' => $product,
        ]);
    }

    public function storeRate(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'nullable|integer|between:1,5',
            'message' => 'nullable|string'
        ]);

        if (!Auth::check()) {
            return back()->with(['error' => 'You must be Logged In']);
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

    public function contactform(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);

        try {
            $contact = Contact::create($request->all());
            // dd($contact);
            if ($contact) {
                Mail::to('destinyerieme47@mail.com')->send(new MailContact($contact));
                return back()->with('success', 'Your Message Have Been Sent Successful');
            }
            return back()->with('error', 'Oops something went wrong');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went wrong');
        }
    }
}
