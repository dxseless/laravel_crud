<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('index', ['products' => $products]);
        
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'price' => 'required|decimal:0,2',
            'weight' => 'required|integer|min:0',
        ]);

        $newProduct = Product::create($data);

        return redirect(route('index'));

    }

    public function edit(Product $product){
        return view('edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'price' => 'required|decimal:0,2',
            'weight' => 'required|integer|min:0',
        ]);

        $product->update($data);

        return redirect(route('index'))->with('success', 'Product Updated Succesffully');

    }

    public function destroy(Product $product){
        $product->delete();
        return redirect(route('index'))->with('success', 'Product deleted Succesffully');
    }
}
