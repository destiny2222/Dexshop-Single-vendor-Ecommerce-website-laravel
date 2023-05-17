<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::with('subcategories')->get();
        $subcategory = SubCategory::get();
        $product = Product::with('subCategory')->get();


        return view('admin.product.index', compact('product', 'categories', 'subcategory'));
    }

    /**
     * Show the form for creating a new resource .
     */
    public function create()
    {
        //
        // Get the subcategory with the specified ID
        $subcategories = SubCategory::get();
        return view('admin.product.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        // dd($request->createProduct());
        if ($request->createProduct()) {
            return redirect(route('admin.product.index'))->with('success', 'Successfully added!');
        } else {
            return back()->with('error', 'Oops something went worry');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        try{
            $product = Product::findOrFail($id);
            return view('admin.product.edit',  compact('product'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $product = Product::findOrFail($id);
            $cate = $request->input('subcategory_id');
            $product->update([
                'name'=>$request->input('name'),
                'body'=>$request->input('body'),
                'price'=>$request->input('price'),
                'keyfeature'=>$request->input('keyfeature'),
                'specification'=>$request->input('specification'),
                'discount'=>$request->input('discount'),
                'slug'=>Str::slug($request->input('name')),
                'cover_image'=>update_image('product',$product->cover_image, 'cover_image'),
                'subcategory_id'=>$cate,
                'status'=> $request->input('status'),
            ]);
            return back()->with('success', 'Successful Updated');
        }catch(\Exception  $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops  Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            Alert::success('success', 'Deleted Successfully');
            return back();
        }catch(\Exception  $exception){
            Log::error($exception->getMessage());
            Alert::error('error', 'Oops  Something Went Wrong');
            return back();
        }
    }
}
