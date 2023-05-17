<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('admin.postcategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryRequest $request)
    {
        //
        if($request->createCategory()){
            return redirect(route('admin.categories.index'))->with('success', 'Successfully');
        }
        return back()->with('error', 'An error occurred!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
            $categories = BlogCategory::findOrFail($id);
            // Alert::success('success', 'Edited Success');
            return view('admin.postcategory.edit', compact('categories'));
        }catch(\Exception $exception){
            Log::info($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $categories = BlogCategory::findOrFail($id);
        try{
            $categories->update([
              'name'=>$request->input('name'),
              'slug'=>Str::slug($request->input('name')),
            ]);
            return redirect(route('admin.categories.index'))->with('success', 'Updated Successful');
          }catch(\Exception $exception){
              Log::error($exception->getMessage());
              return back()->with('error', 'Oops something went wrong');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $categories = BlogCategory::findOrFail($id);
            $categories->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Delete Successfully');
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return back()->with('error', 'Something Went Worry');
        }
    }
}
