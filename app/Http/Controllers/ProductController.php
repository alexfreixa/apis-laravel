<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
{
    $products = Product::with('images')->get();

    $productData = $products->map(function ($product) {
        return [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'product_description' => $product->product_description,
            'product_price' => $product->product_price,
            'product_main_image' => $product->mainImage ? [
                'id' => $product->mainImage->id,
                'name' => $product->mainImage->image_name,
                'file' => $product->mainImage->image_file,
            ] : null
        ];
    });
    
    return response()->json([
        'status' => 1,
        'product_data' => $productData,
        'msg' => 'Productes consultats correctament',
        'origin' => $request->getSchemeAndHttpHost(),
    ]);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {

    $product = Product::where('id', $product->id)->with('images')->first();

    $productData = [
        'id' => $product->id,
        'product_name' => $product->product_name,
        'product_description' => $product->product_description,
        'product_price' => $product->product_price,
        'product_main_image' => $product->mainImage ? [
            'id' => $product->mainImage->id,
            'name' => $product->mainImage->image_name,
            'file' => $product->mainImage->image_file,
        ] : null,
        'product_image_1' => $product->image1 ? [
            'id' => $product->image1->id,
            'name' => $product->image1->image_name,
            'file' => $product->image1->image_file,
        ] : null,
        'product_image_2' => $product->image2 ? [
            'id' => $product->image2->id,
            'name' => $product->image2->image_name,
            'file' => $product->image2->image_file,
        ] : null,
        'product_image_3' => $product->image3 ? [
            'id' => $product->image3->id,
            'name' => $product->image3->image_name,
            'file' => $product->image3->image_file,
        ] : null,
    ];
    
        return response()->json([
            'status' => 1,
            'product_data' => $productData,
            'msg' => 'Productes consultats correctament',
            'origin' => $request->getSchemeAndHttpHost(),
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $producte_validat = $request->validate([
            'product_id' => 'required|numeric',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_main_image' => 'numeric|nullable',
            'product_image_1' => 'numeric|nullable',
            'product_image_2' => 'numeric|nullable',
            'product_image_3' => 'numeric|nullable',
        ]);

        $product->product_name = $producte_validat['product_name'];
        $product->product_description = $producte_validat['product_description'];
        $product->product_price = $producte_validat['product_price'];
        $product->product_main_image = $producte_validat['product_main_image'];
        $product->product_image_1 = $producte_validat['product_image_1'];
        $product->product_image_2 = $producte_validat['product_image_2'];
        $product->product_image_3 = $producte_validat['product_image_3'];

        $product->save();

        return [
            "status" => 1,
            "missatge" => $request->all()
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
            'product_main_image' => 'numeric|nullable',
            'product_image_1' => 'numeric|nullable',
            'product_image_2' => 'numeric|nullable',
            'product_image_3' => 'numeric|nullable',
        ]);

        $product = new Product();

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_main_image = $request->product_main_image;
        $product->product_image_1 = $request->product_image_1;
        $product->product_image_2 = $request->product_image_2;
        $product->product_image_3 = $request->product_image_3;

        $product->save();

        return [
            "status" => 1,
            "data" => $product,
            "producte_id" => $product->id,
            "extres" => $product->product_extra_images
        ];
    }

    public function buscarPerNom(Request $request)
    {

    $cerca = $request->input('cerca');

    $results = Product::with('images')
                ->where('product_name', 'LIKE', $cerca . '%')
                ->orWhere('product_name', 'LIKE', '%' . $cerca . '%')
                ->get();

    $productData = $results->map(function ($product) {
        return [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'product_description' => $product->product_description,
            'product_price' => $product->product_price,
            'product_main_image' => $product->mainImage ? [
                'id' => $product->mainImage->id,
                'name' => $product->mainImage->image_name,
                'file' => $product->mainImage->image_file,
            ] : null
        ];
    });

    return [
        "status" => 1,
        'product_data' => $productData,
        "cerca" => $cerca,
        'origin' => $request->getSchemeAndHttpHost(),
    ];

    }

}
