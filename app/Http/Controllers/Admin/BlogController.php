<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Notification;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $adminUser = Auth::user();
        if ($adminUser) {
            $adminUserId = $adminUser->id;
        } else {
            $adminUserId = [];
        }
        $unreadNotifications = Notification::where('user_id', $adminUserId)
            ->unread()
            ->orderBy('created_at', 'desc')
            ->get();

        $readNotifications = Notification::where('user_id', $adminUserId)
            ->read()
            ->orderBy('created_at', 'desc')
            ->get();
        $tag = Tag::select('id', 'name')->get();
        $categories = BlogCategory::select('id', 'name')->get();
        $post = Blog::orderBy("id", "desc")->paginate(3);
        return view('admin.post.index',[
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'post'=>$post,
            'tag'=>$tag,
            'categories'=>$categories,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $tag = Tag::select('id', 'name')->get();
        $categories = BlogCategory::select('id', 'name')->get();
        return view('admin.post.blog', compact('tag', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // if($request->createNewBlog()){
        //     return back()->with('success', 'Successfully add new BLog');
        // }

        $request->validate([
            'title'=>['required','string'],
            'author'=>['required','string'],
            'body'=>['nullable','string'],
            'tag'=>['required'],
            'image'=>['image','nullable', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $fileNameToStore = null;

        if ($request->hasFile('image')){
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(1,10000).time();
            $fileNameToStore = "$fileName.$fileExt";
            $request->file('image')->storeAs('post', $fileNameToStore, 'public');
        }

        $categoryid = $request->input('category_id');


        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->author = $request->input('author');
        $blog->description = $request->input('description');
        $blog->category_id = $categoryid; // Assuming you want to set the category ID property
        $blog->image = $fileNameToStore;
        $blog->slug = Str::slug($request->input('title')); // Assuming you're using the `Str` class for slug generation
        $blog->save();
        $tags = $request->input('tag'); // Assuming you have an input field named 'tags' containing the selected tags
        if ($tags) {
            $blog->tag()->attach($tags);
        }

        return back()->with('success', 'Successfully add new BLog');


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
            $post = Blog::findOrFail($id);
            // Alert::success('success', 'Edited Success');
            return view('admin.post.edit', compact('post'));
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
        try {
            $blog = Blog::findOrFail($id);

            $blog->update([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'description' => $request->input('description'),
                'slug' => Str::slug($request->input('title')),
                'image' => update_image('post', $blog->image, 'image'),
            ]);

            return redirect(route('admin.blog.index'))->with('success', 'Updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops, something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $post = Blog::findOrFail($id);
            $post->delete();
            return redirect()->route('admin.blog.index')->with('success', 'Delete Successfully');
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return back()->with('error', 'Something Went Worry');
        }
    }
}
