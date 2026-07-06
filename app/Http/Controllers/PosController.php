<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $products = [];

        if ($request->filled('search')) {

            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('barcode', 'like', '%' . $request->search . '%')
                ->get();

        }

        $cart = session()->get('cart', []);

        return view('pos.index', compact('products', 'cart'));
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            $cart[$product->id]['quantity']++;

        } else {

            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];

        }

        session()->put('cart', $cart);

        return redirect()->route('pos.index');
    }
}