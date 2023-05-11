<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name'=>['required','string'],
            'author'=>['required','string'],
            'body'=>['nullable','string'],
            'tag'=>['required'],
            'image'=>['image','nullable', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }


    public function createNewBlog(){
        $categoryid = $this->input('category_id');
        try{
            // $slug  = ;
            Blog::create([
                'name'=>$this->name,
                'author'=>$this->author,
                'body'=>$this->body,
                'category_id'=>$categoryid,
                'slug'=>Str::slug($this->name),
                'image'=>upload_single_image('post', 'image')
            ])->tag()->attach($this->tag);
            return true;
        } catch(\Exception $exception){
           Log::error($exception->getMessage());
           return false;
        }
    }
}
