<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::orderBy('id', 'desc')->get();
        $subcategories = Subcategory::orderBy('id', 'desc')->get();


        $categories = [];

        foreach($category as $cate){
            $categor = [
                'date' => $cate->created_at->diffforHumans(),
                'id'=>$cate->id,
                'type' => 'category',
                'name'=>$cate->name,

            ];
            $categories[] = $categor;
        }

        
        usort($categories, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        return view('admin.category.index', compact('categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        if ($request->createCategory()) {
            Alert::success('success', 'Successfully added!');
            return back();
            // return redirect()->route('admin.testimonial.index')->with('success', 'Successfully added!');
        }else {
            Alert::error('error', 'Oops something went worry');
            return back();
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
            $categories = Category::findOrFail($id);
            return view('admin.category.edit',  compact('categories'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back();
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        try{
            $categories = Category::findOrFail($id);
            $categories->update([
                'name'=>$request->input('name'),
                // 'parent_id'=>$request->input('parent_id'),
                'slug'=>Str::slug($request->input('name')),
                // 'image'=>update_image('category', $categories->image , 'image'),
            ]);
            Alert::success('success', 'Successful Updated');
            return back();
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            Alert::error('error', 'Ooop  Something Went Wrong');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            Alert::success('success', 'Deleted Successfully');
            return back();
        }catch(Exception  $exception){
            Log::error($exception->getMessage());
            Alert::error('error', 'Ooop  Something Went Wrong');
            return back();
        }
    }
}
