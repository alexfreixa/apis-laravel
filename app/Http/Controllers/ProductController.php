<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);    
        return [
            "status" => 1,
            "data" => $products
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        return [
            "status" => 1,
            "data" => $product,
            "msg" => "Product updated successfully",
            "origin" => $request->getSchemeAndHttpHost(),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_image' => 'nullable|image|max:5000000000',
        ]);

        $product->update($request->all());

        return [
            "status" => 1,
            "data" => $product,
            "msg" => "Product updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return [
            "status" => 1,
            "data" => $product,
            "msg" => "Product deleted successfully"
        ];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_image' => 'nullable|image|max:5000000000',
            'product_extra_images' => 'nullable|array',
            'product_extra_images.*' => 'image|max:5000000000',
        ]);

        $product = new Product();

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;

        if ($request->hasFile('product_image')) {
            $imatge = $request->file('product_image');
            $nomArxiu = $imatge->getClientOriginalName();
            $imatge->move(public_path('/public/media/images/'), $nomArxiu);
            $product->product_image = 'public/media/images/' . $nomArxiu;
        }

        if ($request->hasFile('product_extra_images')) {
            $imagePaths = [];
            foreach ($request->file('product_extra_images') as $image) {
                $nomArxiu = $image->getClientOriginalName();
                $image->move(public_path('/public/media/images/'), $nomArxiu);
                $imagePaths[] = 'public/media/images/' . $nomArxiu;
            }
            $product->product_extra_images = json_encode($imagePaths);
        }

        $product->save();

        return [
            "status" => 1,
            "data" => $product,
            "producte_id" => $product->id,
            "hasFile" => $request->hasFile('product_image'),
            "hasFile" => $request->hasFile('product_extra_images'),
            "extres" => $product->product_extra_images
        ];
    }

}
