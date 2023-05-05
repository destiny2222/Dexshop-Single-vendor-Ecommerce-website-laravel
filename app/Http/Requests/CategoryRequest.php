<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
                //
                'name'=>['required','string'],
                // 'image'=>['image', 'nullable', 'mimes:jpeg,png,jpg,gif,svg'],
                // 'parent_id' => 'nullable|exists:categories,id',
            ];
        }
    
        public function createCategory()
        {
    
            try{
                Category::create([
                    'name'=>$this->name,
                    'slug'=>Str::slug($this->name),
                    // 'parent_id'=>$this->parent_id,
                    // 'image'=>upload_single_image('category', 'image')
                ]);
                return true;
            } catch(\Exception $exception){
               Log::error($exception->getMessage());
               return false;
            }
        }
    }
    