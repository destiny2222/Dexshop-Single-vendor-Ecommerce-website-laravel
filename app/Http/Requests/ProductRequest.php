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
            'name' => ['string', 'required'],
            'price' => ['numeric', 'required'],
            'discount' => ['numeric', 'required'],
            'body' => ['string', 'required'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'status' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'string'],
            'sold' => ['nullable', 'string'],
            'badge' => ['nullable', 'string'],
            'keyfeature'=>['nullable','required','string'],
            'specification'=>['nullable','required','string'],
        ];
    }

    public function createProduct()
    {
        $fileNameToStore = null;

        if ($this->hasFile('cover_image')){
            $fileExt = $this->file('cover_image')->getClientOriginalExtension();
            $fileName = rand(1,10000).time();
            $fileNameToStore = "$fileName.$fileExt";
            $this->file('cover_image')->storeAs('product', $fileNameToStore, 'public');
        }

        $images = [];

        if ($this->hasFile('images')) {
            $uploadedImages = $this->file('images');

            foreach ($uploadedImages as $uploadedImage) {
                $ext = $uploadedImage->getClientOriginalExtension();
                $fileName = substr(rand(1,9000000000000).time(), 2);
                $imageName = $fileName . '.' . $ext;
                $uploadedImage->storeAs('products/images', $imageName, 'public');
                $images[] = $imageName;
            }
        }

        try {
            # fetching category ids
            $categoryIds = $this->input('subcategory_id');
            Product::create([
                'name' => $this->name,
                'body' => $this->body,
                'discount'=>$this->discount,
                'status'=>$this->status,
                'is_featured'=>$this->is_featured,
                'badge'=>$this->badge,
                'sold'=>$this->sold,
                'specification'=>$this->input('specification'),
                'keyfeature'=>$this->input('keyfeature'),
                'price' =>$this->price,
                'slug' =>Str::slug($this->name),
                'cover_image'=> $fileNameToStore,
                'images'=>$images,
                'SKU'=>Str::random(10),
                'subcategory_id' => $categoryIds,
            ]);

            return true;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }
    }
}
