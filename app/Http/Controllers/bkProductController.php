<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function afegirproducte(Request $request) {
        $producte = new Product();

        $producte->product_name = $request->input('product_name');
        $producte->product_description = $request->input('product_description');
        $producte->product_price = $request->input('product_price');
        $producte->save();
        return response()->json($producte);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productes_pag = 10;
        //$productes = Product::paginate($productes_pag);
        $productes = Product::latest()->paginate(10);
        /*return [
            "status" => 1,
            "data" => $products
        ];*/

        //return response()->json($producte);

        return [
            "status" => 1,
            "data" => $productes
        ];
          
        //return view('dashboard.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
        ]);

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return view('dashboard.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('dashboard.product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
