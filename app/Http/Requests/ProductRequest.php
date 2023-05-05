<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
            'name'=>['string', 'required'],
            'price'=>['numeric', 'required'],
            'discount'=>['numeric', 'required'],
            'body'=>['string', 'required'],
            'image'=>['image', 'nullable', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

    public function createProduct()
    {
        try{
            # fetching category ids
            $categoryIds = $this->input('subcategory_id'); 
            // foreach ($categoryIds as $categoryId) {
                Product::create([
                    'name' => $this->name,
                    'body' => $this->body,
                    'discount' => $this->discount,
                    'price' => $this->price,
                    'slug' => Str::slug($this->name),
                    'image' => upload_single_image('product', 'image'),
                    'subcategory_id' => $categoryIds,
                    'status' => $this->status == 'on' ? 1 : 0,
                ]);
            // }
            return true;
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return false;
        }
    }
}
