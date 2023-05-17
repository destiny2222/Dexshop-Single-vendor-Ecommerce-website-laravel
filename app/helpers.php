<?php

use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

    if (!function_exists('update_image')){
        function update_image($folder,$currentImagePath,$key) : String{
            if (request()->hasFile($key)){
                $imagePath = public_path("storage/$folder/$currentImagePath");
                if (file_exists($imagePath)){
                    unset($imagePath);
                }
                //upload the new image
                $image = request()->file($key);
                //Get the image extension
                $ext = $image->getClientOriginalExtension();
                //Build the filename
                $filename = substr(rand(1,9000000000000).time(),2);
                $currentImagePath = "$filename.$ext";
                //Store the image
                $image->storeAs($folder,$currentImagePath,'public');
            }
            return $currentImagePath;
        }
    }
    

    if (!function_exists('upload_single_image')){
        function upload_single_image($folder,$key): string
        {
            $fileNameToStore = 'no-image.png';
            if (request()->hasFile($key )){
                $image = request()->file($key);
                //Get the image extension
                $ext = $image->getClientOriginalExtension();
                //Build the filename
                $fileName = substr(rand(1,9000000000000).time(),2);
                $fileNameToStore = $fileName.'.'.$ext;
                //Store the image
                $image->storeAs($folder,$fileNameToStore,'public');
            }
            return $fileNameToStore;
        }
    }

    if (!function_exists('upload_multiple_images')){
        function upload_multiple_images($folder)
        {
            $urls = [];
            if (request()->hasFile('images')){
                foreach (request()->file('images') as $image) {
                    //Get the image extension
                    $ext = $image->getClientOriginalExtension();
                    //Build the filename
                    $fileName = substr(rand(1,9000000000000).time(),2);
                    $fileNameToStore = $fileName.'.'.$ext;
                    //Store the image
                    $image->storeAs($folder,$fileNameToStore,'public');
                    //array_push($urls,$fileNameToStore)
                    $urls[] = $fileNameToStore;
            }
                return $urls;
            }
        }
    }


// CartHelper.php

function calculateTotalPrice()
{
    $cart = CartItem::all();
    $totalPrice = 0;
    foreach ($cart as $carted) {
        $totalPrice += $carted->product->price * $carted->quantity;
    }

    return [
        'cart' => $cart,
        'totalPrice' => $totalPrice
    ];
}

// app/Helpers/UserHelper.php



function getCartItemCount()
{
    $user = Auth::user();
    return $user ? $user->cartitem()->count() : 0;
}

function getWishlistItemCount()
{
    $user = Auth::user();
    return $user ? $user->wishlist()->count() : 0;
}

function getOrderItemCount()
{
    $user = Auth::user();
    return $user ? $user->orders()->count() : 0;
}


// product categories

function getCategoryTree()
{
    return Category::with('subcategories')->get();
}

