<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http\Requests;
use Validator;
use App\Product;
use App\Cart;
use Auth;
use DB;

class CartController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $cart = Cart::findOrFail(Auth::id());
    return view('cart.show', compact('cart'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    Flash('Item was added to your cart!', 'success');
    return redirect('cart/' . Auth::id());
  }

  /**
  * Add the specified product to cart.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function add($id, Request $request)
  {
    $product = Product::findOrFail($id);
    $cart = Cart::findOrFail(Auth::id());

    if ($cart->product->contains($product))
    {
      Flash('Item in now inside the Cart!', 'danger');
      return redirect('product/' . $product->id);
    }
    $cart->product()->save($product);
    Flash('Item has been Added!', 'success');
    return redirect('cart/' . Auth::id());
  }

  /**
  * Remove the specified resource from cart.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function remove($id)
  {
    $cart = Cart::findOrFail(Auth::id());
    $cart->product()->detach($id);
    Flash('Item has been Removed!', 'success');
    return redirect('cart/' . Auth::id());
  }

  /**
  * Clean all products of the cart.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $cart = Cart::findOrFail(Auth::id());
    $cart->product()->detach();
    Flash('Cart has been Clear!', 'success');
    return redirect('cart/' . Auth::id());
  }

  public function rules()
  {
    return [
    ];
  }

}
