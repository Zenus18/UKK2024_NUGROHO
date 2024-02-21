<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('user', 'product')->whereNull('transaction_id')->where('user_id', Auth::user()->id)->get();
        $total = $cart->sum('sub_total');
        return view('Cashier.carts', compact('cart', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id)
    {
        try {
            $product = Product::find($id);
            $cart = Cart::with('user', 'product')->whereNull('transaction_id')->where('user_id', Auth::user()->id)->where('product_id', $id)->get();
            if (count($cart) == 0) {
                if ($product) {
                    if ($product->is_active && $product->stock > 0) {
                        Cart::create(
                            [
                                "user_id" => Auth::user()->id,
                                "product_id" => $product->id,
                                "qty" => 1,
                                "price" => $product->price,
                                "sub_total" => $product->price * 1,
                            ]
                        );
                        return redirect()->route('cashier.product')->with('success', $product->name . " is added to cart successfully");
                    } else {
                        return redirect()->route('cashier.product')->with('error', 'product is not active');
                    }
                } else {
                    return redirect()->route('cashier.product')->with('error', 'product tidak ditemukan');
                }
            } else {
                return redirect()->route('cashier.product')->with('error', 'product sudah ada di keranjang');
            }
        } catch (Exception $e) {
            return redirect()->route('cashier.product')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Cart::with('user', 'product')->findOrFail($id);
        $validateData = $request->validate(
            [
                'qty' => ''
            ]
        );
        $qty = $validateData['qty'];
        if ($qty == 0) {
            $cart->delete();
            return redirect()->route('cashier.cart')->with('success', 'cart has been deleted successfully');
        } else {
            $product = Product::find($cart->product->id);
            if ($product->stock >= $qty && $product->is_active) {
                $cart->qty = $qty;
                $cart->sub_total = $cart->price * $qty;
                $cart->save();
                return redirect()->route('cashier.cart')->with('success', 'cart has been updated successfully');
            } else {
                return redirect()->route('cashier.cart')->with('error', 'product tidak mencukupi');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}