<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tag = Tag::select('id', 'name')->get();
        $category = BlogCategory::select('id', 'name')->get();
        $blog = Blog::orderBy("id", "desc")->paginate(3);
        return view('admin.post.blog', compact('blog', 'tag', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return back()->with('error', 'An error occurred!');
        $tag = Tag::select('id', 'name')->get();
        $category = BlogCategory::select('id', 'name')->get();
        return view('admin.post.blog', compact('tag', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if($request->createNewBlog()){
            // dd($request->all());
            return redirect(route('admin.blog.index'))->with('success', 'Successfully add new BLog');
        }

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
    public function edit(string $id)
    {
        //
        try{
            $blog = Blog::findOrFail($id);
            // Alert::success('success', 'Edited Success');
            return view('admin.post.blog-edit', compact('blog'));
        }catch(\Exception $exception){
            Log::info($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $blog = Blog::findOrFail($id);
        try{
            $blog->update([
              'name'=>$request->input('name'),
              'author'=>$request->input('author'),
              'body'=>$request->input('body'),
              'slug'=>Str::slug($request->input('name')),
              'image'=>update_image('post',$blog->image, 'image'),
            ]);
            // Alert::success('success', 'Updated Successful');
            return redirect(route('admin.blog.index'))->with('success', 'Updated Successful');
          }catch(\Exception $exception){
              Log::error($exception->getMessage());
              return back()->with('error', 'Oops something went wrong');
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return redirect()->route('admin.blog.index')->with('success', 'Delete Successfully');
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return back()->with('error', 'Something Went Worry');
        }
    }
}
