<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class ProductsController extends Controller {

    public function index() {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('product.index');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cartObj = new Cart($oldCart);
        $cart = $cartObj->items;
        return view('/shop.shopping-cart', ['products' => $cart, 'totalPrice' => $cartObj->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cartObj = new Cart($oldCart);
        $cart = $cartObj->items;
        $totalPrice = $cartObj->totalPrice;
        return view('/shop.checkout', ['products' => $cart, 'totalPrice' => $totalPrice]);
    }

    public function checkoutPayment(Request $request) {

//        dd($request->all());
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cartObj = new Cart($oldCart);
        $cart = $cartObj->items;

        $totalPrice = $cartObj->totalPrice;
//        $contents=json_encode($cart);
        $contents = $cartObj->stringifyCart();
        try {
            Stripe::charges()->create([
                'amount' => $totalPrice,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order From Elioluade',
                'receipt_email' => 'tossie79@yahoo.ca',
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => $cartObj->totalQty
                ]
            ]); //SUCCESSFUL
            $request->session()->forget('cart');
            $request->session()->put('success_message', 'payment successful');
            return redirect()->route('thankyou');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function paymentSuccessFul() {
        if (!session()->has('success_message')) {
            return redirect()->route('/');
        }
        return view('shop.thankyou')->with('status', 'Thank you! Your Payment Has Been Successfully Accepted!');
    }

}
