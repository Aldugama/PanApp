<?php

namespace App\Http\Controllers\Shop;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Http\Requests\CartAddItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartUpdateItem;
use PHPUnit\Framework\MockObject\Stub\Exception;

class CartItemsController extends Controller
{

    public function __construct() {
        $this->middleware('role:tienda');
    }

    public function addItem(CartAddItem $request, $id) {

        try {

            if(Auth::user()->has('orders'))
                $user = Auth::user();
            else
                return redirect('tienda');

            $product = Product::findOrFail($id);

            if($product === null) {
                abort(504);
            }

            if ($product->category->name === "Bebida") {
                if(count($user->orders->where('status', 'activo')->where('drinks', true)) > 0) {
                    $order = $user->orders
                                  ->where('status', 'activo')
                                  ->where('drinks', true)
                                  ->last();
                }
                else{
                    DB::beginTransaction();
                    $order = new Order;
                    $order->user_id = $user->id;
                    $order->status = 'activo';
                    $order->drinks = true;
                    
                    if($order->save()) 
                        DB::commit();
                    else
                        DB::rollback();
                }
            }
            else{
                if( !count($user->orders->where('status', 'activo')) <= 0)
                    if($user->orders->whereIn('drinks', [false, null]))
                        $order = $user->orders
                                      ->where('status', 'activo')
                                      ->whereIn('drinks', [false, null])
                                      ->last();
                else
                    return redirect('tienda');
            }


            if($order->products->where('id', $id)->first() !== null) {

                if(isset($request->details)) {
                    $details = $request->details;
                }
                else {
                    $details = null;
                }

                $order->products()->updateExistingPivot($id, [
                    'quantity' => $request->quantity,
                    'details' => $details
                ]);

                return back()->with('success', 'Se ha añadido un producto nuevo al carro');
            }
            else{
                
                if(isset($request->details)){
                    $details = $request->details;
                }
                else {
                    $details = null;
                }

                $order->products()->attach($id, [
                        'quantity' => $request->quantity,
                        'details' => $details
                    ]);
                
            }
            return back()->with('success', 'El producto se añadió a la cesta correctamente');
        } catch(Exception $e) {
            return redirect('tienda');
        }
    }

    public function removeItem($id) {
        try {

            if(Auth::user()->has('orders'))
                $user = Auth::user();
            else
                return redirect('tienda');

            if( !count($user->orders->where('status', 'activo')
                                    ->whereIn('drinks', [false, null])) <= 0)
                $order = $user->orders
                              ->where('status', 'activo')
                              ->whereIn('drinks', [false, null])
                              ->last();
            else
                return redirect('tienda');
                
            if($order->products->where('id', $id)->first() === null) {
                abort(501);
            }
            else{
                if(isset($request->details)){
                    $details = $request->details;
                }
                else {
                    $details = null;
                }
                
                $order->products()->detach($id);
            }

            return response()->json(array(
                'status' => 'ok',
                'code' => 200,
                'message' => 'El producto se ha eliminado de la cesta'
            ));

        } catch(Exception $e) {
            report($e);
            return false;
        }
    }

}
