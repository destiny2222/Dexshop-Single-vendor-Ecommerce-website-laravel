<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->id;
        $categories = SubCategory::all();
        $cart_item_count = CartItem::where('user_id', $user)->count();
        $wishlist_item_count = Wishlist::where('user_id', $user)->count();
        return view('dashboard.index', compact('cart_item_count','wishlist_item_count','categories'));
    }


    public function validatepassword(Request  $request){
        $this->validate($request, [
            'current_password'=>['required', 'string'],
            'new_password'=>['required', 'string'],
        ]);
        # check for current password match
        $changepassword = Auth::user()->id;
        if (password_verify($request->current_password, $changepassword->password)) {
            # if true
            if ($request->new_password == $request->Confirm_password) {
                # saving the password in datebase
                session(['new_password'=> $request->new_password]);
                $changepassword->update([
                    'password'=>Hash::make(session('new_password'))
                ]);
                // dd($changepassword);
                return back()->with('success', 'Password Change Successful');
            } else{
                return back()->with('error', 'Error! Password Mismatch');
            }
        }else{
            return back()->with('error',  'Error! The password does not match the current password?');;
        }
    }

    public function update_profile(Request $request, $id){
        $request->validate([
            'image'=>['image', 'mimes:png,jpg', 'max:2048'],
        ]);

        if($request->hasFile('image')) {
            $image_file = time().'.'.$request->image->extension();
            $request->image->move(public_path('profile'),$image_file);
        }
        try{
            $users = User::findOrFail($id);
            $users->update([
                'image'=>$image_file ?? $users->image,
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'gender'=> $request->gender,
            ]);
            return back()->with('info', 'Updated Successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went Wrong');
            return back()->with('error', 'Oops Something went worry');
        }
    }
}
