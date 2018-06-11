<?php

namespace App\Http\Controllers\Central;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class CentralController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:horno');
    }

    public function printAllExceptDrinksCakes(Request $request, $pasteleria = 'Pasteleria', $bebida = 'Bebida')
    {
        $TotalOrdersactivo = Order::where('status', 'activo')->get();

        $result = [];
        foreach ($TotalOrdersactivo as $order) {
            if ($order->user->role->name === "tienda") {

                $products = $order->products()->get();
                foreach ($products as $product) {

                    if ($product->category()->first()->name === $pasteleria || $product->category()->first()->name === $bebida) {
                        continue;
                    } else {
                        $quantity = $product->pivot->quantity;
                        array_push($result, [
                            'usuario_nombre' => $order->user()->first()->name,
                            'nombre_producto' => $product->name,
                            'referencia_producto' => $product->reference,
                            'categoria' => $product->category->name,
                            'cantidad' => $quantity,
                            'detalles' => $product->pivot->details,
                        ]);

                    }
                }
            }
        }

        return view('central.ImprimirTodo', compact('result'));
    }


    public function printOrdersByShop()
    {
        $users = User::all();
        $result = [];
        $i = 0;
        $j = 0;
        foreach ($users as $user) {

            if ($user->role != null && $user->role->name === 'tienda' && count($user->orders()->get()) > 0) {

                array_push($result, [
                    'usuario_nombre' => $user->name,
                    'usuario_id' => $user->id,
                    'pedidos' => [],
                ]);
                $pedidosTienda = $user->orders()->get();
                foreach ($pedidosTienda as $pedido) {
                    if ($pedido->status === 'activo') {
                        array_push($result[$i]['pedidos'], [
                            'pedido_id' => $pedido->id,
                            'pedido_fecha' => $pedido->updated_at,
                            'productos' => [],
                        ]);
                        if ($pedido->products() != null && count($pedido->products()->get()) > 0) {
                            $products = $pedido->products()->get();
                            foreach ($products as $product) {
                                array_push($result[$i]['pedidos'][$j]['productos'], [
                                    'nombre_producto' => $product->name,
                                    'referencia_producto' => $product->reference,
                                    'cantidad_producto' => $product->pivot->quantity,
                                    'detalles_producto' => $product->pivot->details,
                                    'categoria' => $product->category->name,
                                ]);
                            }
                        }
                        $j++;
                    }
                }
                $j = 0;
                $i++;
            }
        }
        return view('central.imprimirPorTienda', compact('result'));
    }

    public function printByCategory($id)
    {
        $users = User::all();
        $result = [];
        $i = 0;
        $j = 0;
        foreach ($users as $user) {
            array_push($result, [
                'usuario_nombre' => $user->name,
                'usuario_id' => $user->id,
                'pedidos' => [],
            ]);

            $orders = $user->orders->where('status', 'activo');
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    if (count($order->products) > 0) {
                        array_push($result[$i]['pedidos'], [
                            'pedido_fecha' => $order->updated_at,
                            'productos' => [],
                        ]);
                    $products = $order->products;
                        foreach ($products as $product) {
                            if ($product->category->id == $id) {
                                array_push($result[$i]['pedidos'][$j]['productos'], [
                                    'categoria' => $product->category->name,
                                    'nombre_producto' => $product->name,
                                    'referencia_producto' => $product->reference,
                                    'cantidad_producto' => $product->pivot->quantity,
                                    'detalles_producto' => $product->pivot->details,
                                ]);
                            }
                        }
                    }
                    $j++;
                }
            }
            $j = 0;
            $i++;
        }

        return view('central.imprimirTartasBebidas', compact('result'));
    }

}
