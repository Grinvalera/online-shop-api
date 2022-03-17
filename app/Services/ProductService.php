<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    public function store($data)
    {
        $validate = $this->validator($data->all());
        if ($validate->status() == 422) {
            return $validate;
        }
        $product =  Product::create($data->all());
        if($data->hasFile('images'))
        {
            $images = $data->images;
            $imageName = time() . '.' . $images->getClientOriginalExtension();
            $path = $images->storeAs('public', $imageName);
            $images = Image::create([
               'image_name' => $path
            ]);
        }
        $product->images()->attach($images->id);
        return response('', 200);
    }

    public function update($data, $id)
    {
        $validate = $this->validator($data->all());
        if ($validate->status() == 422) {
            return $validate;
        }
        $product = Product::where('id', $id)->with('images')->first();
        $product->update($data->all());
        $imageId = $product->images[0]->id;
        if($data->hasFile('images'))
        {
            $image = Image::where('id', $imageId)->first();
            $images = $data->images;
            $imageName = time() . '.' . $images->getClientOriginalExtension();
            $path = $images->storeAs('public', $imageName);
            $image->update([
                'image_name' => $path
            ]);
        }
        return response('', 200);
    }

    public function getAllProducts()
    {
        return Product::with('images')->get();
    }

    public function getProductById($id)
    {
        return Product::where('id', $id)->with('images')->first();
    }

    public function destroy($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function validator($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|max:128',
            'description' => 'required|min:32',
            'category' => 'required',
            'count' => 'required|max:16',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return response('', 200);
    }
}
