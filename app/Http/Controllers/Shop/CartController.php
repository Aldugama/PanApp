<?php

namespace App\Http\Controllers\Shop;

use App\Order;
use App\Category;

use App\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:tienda');
    }

    public function index() {

        if(Auth::user() != null)
            $user = Auth::user();
        else{
            abort(403);
        }

        try{
            if($user->orders->whereIn('status', ['activo', 'pendiente'])->first() === null) {
                abort(501);
            }
                $orders = $user->orders->whereIn('status', ['activo', 'pendiente'])->sortByDesc('updated_at');
                $categories = Category::all();

            if(session()->has('order_id')) {
                if(session()->get('order_id') === null)
                {   
                    if($user->orders->where('status', 'activo')
                                    ->whereIn('drinks', [false, null])
                                    ->last() !== null) 
                    {
                        
                        $order_id = $user->orders
                                        ->where('status', 'activo')
                                        ->whereIn('drinks', [false, null])
                                        ->last()
                                        ->id;
                        session(['order_id' => $order_id]);
                    } 
                }
                else {
                    $order_id = session()->get('order_id');
                    $order = Order::findOrFail($order_id);
                    if($order === null) {
                        abort(300);
                    }
                    if($order->status !== "activo") {
                        if($order->drinks === false || $order->drinks === null) {
                            session([
                                'order_id' => $user->orders
                                                    ->where('status', 'activo')
                                                    ->whereIn('drinks', [false, null])
                                                    ->last()
                                                    ->id]);
                        }
                    }
                    else {
                        session([
                              'order_id', 
                               $user->orders
                                    ->where('status', 'activo')
                                    ->whereIn('drinks', [false, null])
                                    ->last()
                                    ->id]);
                    }
                }
            }else {
                if($user->orders->where('status', 'activo')
                                ->whereIn('drinks', [false, null])
                                ->last() !== null) 
                {
                    
                    $order_id = $user->orders
                                    ->where('status', 'activo')
                                    ->whereIn('drinks', [false, null])
                                    ->last()
                                    ->id;
                    session(['order_id' => $order_id]);
                }
                else {
                    return redirect('tienda');
                }
            }
            
            return view('shop.cart.cart', compact('orders', 'categories'));
        }
        catch(Exception $e) {
            report($e);
        }
        
    }


    public function update(UpdateCart $request, $id){
        
        try {

            $order = Order::findOrFail($id);
        
            if($order->status !== "activo" || $order->status !== "pendiente") {
                redirect('tienda');
            }
            if($order->status === "pendiente") {
                $order->status = "activo";
                session(['order_id' => $order_id]);
            }


            return response()->json([
                'status' => 'ok',
                'code' => 200,
                'message' => 'Fallo al actualizar pedido'
            ]);
        
        }
        catch(Exception $e) {
            report($e);
        }


    }

    
    public function cancelled($id) {
        try{
            $order = Order::findOrFail($id);
            if($order === null)
                abort(400);
            $order->status = 'cancelado';
            $order->save();

            if(session()->has('order_id')) {
                if(session()->get('order_id') === $order->id) {
                    session(['order_id' => null]);
                }
            }
            return redirect()->route('catalogo.index')->with('cancelled', 'El pedido se ha cancelado');
        }
        catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>"Fallo al desactivar el pedido"));            
        }
    }

    public function activated($id) {
        try{
            $order = Order::findOrFail($id)->status = 'activo';
            if($order === null)
                abort(400);

            if(session()->has('order_id')) {
                if(session()->get('order_id') === $order->id) {
                    session(['order_id' => null]);
                }
            }
            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"El pedido se ha activado correctamente"));
        }
        catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>"Fallo al activar el pedido"));

        }
    }
    
}
