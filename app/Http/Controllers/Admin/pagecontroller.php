<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class pagecontroller extends Controller
{
    public function index(){
        $category = Category::orderBy('id', 'desc')->get();
        $subcategories = SubCategory::orderBy('id', 'desc')->get();


        $categories = [];

        foreach ($subcategories as $subcategory){
            $categor = [
                'date' => $subcategory->created_at->diffforHumans(),
                'type' => 'Subcategory',
                'image'=> $subcategory->image,
                'id'=>$subcategory->id,
                'category_id'=>$subcategory->category_id,
                'name'=>$subcategory->name,
            ];
            $categories[] = $categor;
        }
        usort($categories, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        return view('admin.category.subcategories.index', compact('category', 'categories'));
    }
     

    public function storeSubcategory(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => ['required',],
            'image'=>['image', 'nullable', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        // Create a new subcategory under the category
        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->image = upload_single_image('category', 'image');
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect()->route('admin.home-subcategory')->with('success', 'Subcategory created successfully!');
    }

    

    public function Updatesubcategory(Request $request, $id)
    {
        $subcategories = SubCategory::find($id);
        $subcategories->update([
            $subcategories->name = $request->input('name'),      
            $subcategories->slug  =  Str::slug($request->name),  
            $subcategories->image =  update_image('category',$subcategories->image, 'image'),     
            $subcategories->category_id = $request->input('category_id'),      
        ]);
        $subcategories->save();
        return back()->with('info', 'Updated Successfully!');
    }

    public function Deletesubcategory($id)
    {
        $subcategories = SubCategory::find($id);
        $subcategories->delete();
        return back()->with('info', 'Deleted Successfully!!');
    }
}
