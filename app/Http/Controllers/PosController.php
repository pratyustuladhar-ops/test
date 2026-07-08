<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $products = Product::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('barcode', $search);
            })
            ->get();

        $cart = Session::get('cart', []);

        return view('pos.index', [
            'products' => $products,
            'cart'     => $cart,
            'summary'  => $this->cartSummary($cart),
        ]);
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => (float) $product->price,
                'quantity' => 1,
                'discount' => 0,
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'summary' => $this->cartSummary($cart),
        ]);
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->quantity;
            Session::put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'summary' => $this->cartSummary($cart),
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'summary' => $this->cartSummary($cart),
        ]);
    }

    private function cartSummary(array $cart): array
    {
        $subtotal = 0;
        $discountTotal = 0;

        foreach ($cart as $item) {
            $lineTotal   = $item['price'] * $item['quantity'];
            $discountAmt = $lineTotal * ($item['discount']??0 / 100);

            $subtotal      += $lineTotal;
            $discountTotal += $discountAmt;
        }

        $tax   = 0; // plug in your tax rule here
        $total = $subtotal - $discountTotal + $tax;

        return [
            'subtotal' => number_format($subtotal, 2),
            'discount' => number_format($discountTotal, 2),
            'tax'      => number_format($tax, 2),
            'total'    => number_format($total, 2),
        ];
    }
}