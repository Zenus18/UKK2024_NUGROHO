<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::all();
        return view('Admin.product', compact('Product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.product.form-tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
            ]
        );
        try {
            Product::create($validatedData);
            return redirect()->route('admin.product')->with('success', 'data successfully added');
        } catch (Exception $e) {
            return redirect()->route('admin.product')->with('error', 'there was an error creating the product \n' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function find(Request $request)
    {
        $validatedData = $request->validate(
            [
                'query' => ''
            ]
        );
        $query = $validatedData['query'];
        try {
            $Product = Product::where('name', 'like', '%' . $query . '%')->get();
            return view('Admin.product', compact('Product'));
        } catch (Exception $e) {
            return redirect()->route('admin.product')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('Admin.product.form-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);
            $validateData = $request->validate(
                [
                    "name" => 'required',
                    'stock' => 'required|numeric',
                    'price' => 'required|numeric',
                ]
            );
            $product->name = $validateData['name'];
            $product->stock = $validateData['stock'];
            $product->price = $validateData['price'];
            $product->update();
            return redirect()->route('admin.product')->with('success', 'Product updated successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.product.edit')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            $is_active = $product->is_active;
            if ($is_active == 1) {
                $product->is_active = false;
            } else {
                $product->is_active = true;
            }
            $product->update();
            return redirect()->route('admin.product')->with('success', $is_active == 1 ? 'product deactivated' : 'product activated');
        } catch (Exception $e) {
            return redirect()->route('admin.product')->with('error', $e->getMessage());
        }
    }
}
