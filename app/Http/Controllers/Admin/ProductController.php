<?php

namespace App\Http\Controllers\Admin;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductStore;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    
    public function __construct() {
        $this->middleware('role:admin');
    }

    public function index() {
        $products = Product::paginate(5);
        $categories = Category::all();
        $element = 'producto';
        return view('admin.productos', compact('products', 'categories', 'element' ));
    }

    public function store(ProductStore $request) {
        try {
        DB::beginTransaction();
            $product = new Product();
            $product->category_id = $request->category;
            $product->name = $request->name;
            $product->reference = $request->reference;
            if($product->save()){
                DB::commit();
            }
            else
                DB::rollback();
            }
        catch(Exception $e) {
            abort(501);
        }
        return redirect()->route('producto.index')->with('success', $request->name);
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        if($product->category()->first() != null)
            $category = $product->category()->first()->name;
        else {
            $category = '';
    }

        return array('product' => $product, 'category' => $category);
    }

    public function update(ProductStore $request, $id) {
        
        try {
            DB::beginTransaction();
            $Product = Product::findOrFail($id);
            $category = Category::findOrFail($request->category);
            $Product->name = $request->name;
            $Product->category()->associate($category);
            $Product->reference = $request->reference;
            if($Product->save())
                DB::commit();
            else
                DB::rollback();

            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"El producto ". $Product->name ." se ha actualizado correctamente"));
        
        } catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>"Un error ocurrió al actualizar el producto"));
        }
    }

    public function destroy($id) {
        
        try{
            DB::beginTransaction();
            if(Product::destroy($id))
                DB::commit();
            else
                DB::rollback();
        }
        catch(Exception $e) {
            abort(501);
        }

        return redirect()->route('producto.index')
                        ->with([
                        'deleted' => $id,
                        'name' => Product::withTrashed()->where('id', $id)
                                                        ->first()
                                                        ->name
                        ]);

    }

    public function restore($id) 
    {
        $Product = Product::withTrashed()
            ->where('id', '=', $id)
            ->first();
        $Product->restore();

        return redirect()->route('producto.index')->with('restored', $Product->name);        
    }

    public function search(Request $request) {
        $query = $request->input('query');
        if($request->option == "category_id") {
            $products = Category::where('name', 'like', "%$query%")
                                ->first()
                                ->products()
                                ->paginate(5);
        }
        elseif ($request->option == 'reference') {
            $products = Product::where('reference', 'like', "%$query%")->paginate(5);
        }
        elseif ($request->option == 'name'){
            $products = Product::where('name', 'like', "%$query%")->paginate(5);
        }
        else {
            abort(500);
        }
        return view('admin.productos', compact('products', 'query'));
    }
}
