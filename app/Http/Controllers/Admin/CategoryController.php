<?php

namespace App\Http\Controllers\Admin;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryUpdate;

class CategoryController extends Controller
{
    
    public function __construct() {
        $this->middleware('role:admin');
    }

    public function index() {
        $categories = Category::paginate(5);
        $element = 'categorias';
        return view('admin.categorias', compact('categories', 'element'));
    }

    public function show($id) {
        return Category::findOrFail($id);
    }

    public function store(CategoryUpdate $request) {
        try{
            DB::beginTransaction();
            if(Category::create($request->except('_token')))
                DB::commit();
            else
                DB::rollBack();
        }catch(Exception $e) {
            abort(500);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoria creada correctamente');
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            
            if($category->save())
                DB::commit();
            else 
                DB::rollback();
            

            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"La categoría ". $request->name ." se ha actualizado correctamente"));
        
        } catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>'Un error ocurrió al actualizar la categoría '. $request->name .'.')); //$e->getMessage() sólo para versión en desarrollo, puede cambiarse después por algo como 'Un error ha ocurrido'
        }        
    }

    public function destroy($id) {
        try{
            DB::beginTransaction();
            if(Category::destroy($id))
                DB::commit();
            else
                DB::rollBack();
        }catch(Exception $e) {
            abort(500);
        }
        return redirect()->route('categorias.index')->with('deleted', $id);
    }

    public function restore($id) 
    {
        $category = Category::withTrashed()
            ->where('id', '=', $id)
            ->first();
        $category->restore();

        return redirect()->route('categorias.index')->with("restored", $id);

    }

    public function search(Request $request) {
        $query = $request->input('query');
        $categories = Category::where('name', 'like', "%$query%")->paginate(5);
    	return view('admin.categorias', compact('categories', 'query'));
    }
}
