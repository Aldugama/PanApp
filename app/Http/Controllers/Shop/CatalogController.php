<?php

namespace App\Http\Controllers\Shop;

use App\Order;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{

    public function index()
    {
        if(Auth::user() != null)
            $user = Auth::user();
        else{
            abort(403);
        }

        try{
            if($user->orders
                    ->where('status', 'activo')
                    ->whereIn('drinks', [false, null])
                    ->first() === null) {
                

                DB::beginTransaction();

                $order = new Order();
                $order->user_id = $user->id;
                $order->status = 'activo';
                if($order->save())
                    DB::commit();
                else {
                    DB::rollback();
                }
                session(['order_id' => $order->id]);
            } else {
                if($user->orders
                        ->where('status', 'activo')
                        ->whereIn('drinks', [false, null])
                        ->last() !== null)
                {
                    session(['order_id' => $user->orders
                                                ->where('status', 'activo')
                                                ->whereIn('drinks', [false, null])
                                                ->last()->id]);

                }
            }
            
            $products = Product::orderBy('category_id')->paginate(6);
            $categories = Category::all();
            
            return view('shop.catalog.catalog', compact('products', 'categories'));
        }
        catch(Exception $e) {
            report($e);
        }
    }


    public function showByCategory($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $products = $category->products()->paginate(6);

        return view('shop.catalog.catalog', compact('products', 'categories'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('shop.catalog.show', compact('product', 'categories'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")->paginate(5);
        $categories = Category::all();

        return view('shop.catalog.catalog', compact('products', 'categories', 'query'));
    }

}
