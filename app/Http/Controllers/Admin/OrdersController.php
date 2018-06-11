<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdateAdmin;

class OrdersController extends Controller
{
    
    public function __construct() {
        $this->middleware('role:admin');
    }


    public function index()
    {
        $orders = Order::orderBy('updated_at', 'desc')->paginate(5);
        $states = ['activo', 'pendiente', 'cancelado', 'finalizado'];
        $element = 'pedido';
        return view('admin.pedidos', compact('orders', 'element', 'states'));
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        $status = $order->status;

        return compact('status');
    }

    public function update(Request $request, $id)
    {
        try{
            $order = Order::find($id);
            DB::beginTransaction();

            if($order->user->role->name === "tienda")
            {
                $order = Order::find($id);
                $order->status = $request->status;
                if($order->save())
                    DB::commit();
                else
                    DB::rollback();

                return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"El pedido se ha actualizado correctamente"));
                
            }
            else {
                abort('501');
            }
        }
        catch(Exception $e) {
            return response()->json(array('status' => 'ok', 'code'=>400, 'message'=>"Un error ocurrió al actualizar el pedido"));            
        }
    }


    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            if(Order::destroy($id))
                DB::commit();
            else 
                DB::rollback();

        }catch(Exception $e){
            abort(501);
        }

        return redirect()->route('pedido.index')->with([
            'deleted' => $id,
            'name' => 'Pedido '
            ]);
    }

    public function restore($id) 
    {
        $order = Order::withTrashed()
            ->where('id', '=', $id)
            ->first();
        $order->restore();

        return redirect()->route('pedido.index')->with("restored", $order->name);
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $states = ['activo', 'pendiente', 'cancelado', 'finalizado'];

        if ($request->option == 'status'){
            $orders = Order::where('status', 'like', "%$query%")->paginate(5);
        }
        else {
            abort(501);
        }
        return view('admin.pedidos', compact('orders', 'query', 'states'));
    }
}
