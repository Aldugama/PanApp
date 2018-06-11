<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderProduct;

class CartController extends Controller
{
    public function index($id) {
        $cart = OrderProduct::where('order_id', $id)->get();
        return view('admin.cart', compact('cart'));
    }
}
