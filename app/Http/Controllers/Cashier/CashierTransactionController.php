<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with('user', 'cart')->get();
        return view('Cashier.transaction',  compact('transaction'));
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
    public function checkout(Request $request)
    {
        $transaction = Transaction::all()->sortByDesc('serial_number')->first();
        $cart = Cart::with('user', 'product')->whereNull('transaction_id')->where('user_id', Auth::user()->id)->get();
        $validatedData = $request->validate(
            [
                'paid' => 'integer|required'
            ]
        );
        $paid = $validatedData['paid'];
        $total = $cart->sum('sub_total');
        if ($paid < $total) {
            return redirect()->route('cashier.cart')->with('error', 'your money is not enough');
        }
        $change = $paid - $total;
        $serial_number = $transaction->serial_number ?? 1;
        $newTransaction = Transaction::create(
            [
                "user_id" => Auth::user()->id,
                "serial_number" => $serial_number,
                "total" => $total,
                "paid" => $paid,
                "change"  => $change
            ]
        );
        if ($newTransaction) {
            foreach ($cart as $c) {
                $product = Product::find($c->product_id);
                if ($product->is_active && $product->stock >= $c->qty) {
                    if ($product->stock == $c->qty) {
                        $product->is_active = false;
                        $product->save();
                    }
                    $product->stock = $product->stock - $c->qty;
                    $product->save();
                    $updateCart = Cart::find($c->id);
                    $updateCart->transaction_id = $newTransaction->id;
                    $updateCart->save();
                } else {
                    $deleteCart = Cart::find($c->id);
                    $deleteCart->delete();
                    return redirect()->route('cashier.cart')->with('error', $c->product->name . " is not active and has been deleted from cart");
                }
            }
            return view('common.detail-page', ['transaction' => $newTransaction]);
        } else {
            return redirect()->route('cashier.cart')->with('error', 'transaction cannot be completed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $transaction = Transaction::with('user', 'cart')->findOrFail($id);
            return view('common.detail-page', compact('transaction'));
        } catch (Exception $e) {
            return  redirect()->route('admin.dashboard')->with('error', $e->getMessage());
        }
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