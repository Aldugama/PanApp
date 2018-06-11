<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct() {

        $this->middleware('role:admin');
    
    }

    public function index()
    {
        $roles = Role::paginate(5);
        $element = 'rol';
        return view('admin.roles', compact('roles', 'element'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if(count(Role::withTrashed()->where('name', $request->name)->get())>0) 
                Role::withTrashed()->where('name', $request->name)->first()->forceDelete();                
            
            if(Role::create($request->except('_token')))
                DB::commit();
            else
                DB::rollback();
                
        }catch(Exception $e) {
            abort(501);
        }
        
        
        return redirect()->route('rol.index')->with('success', 'Rol creado correctamente');       
    }


    public function show(Request $request, $id)
    {
        return Role::find($id);
         
    }


    public function update(Request $request, $id)
    {
        
        try {
            DB::beginTransaction();
            $Role = Role::find($id);
            $Role->name = $request->name;
            $Role->description = $request->description;
            if($Role->save())
                DB::commit();
            else
                DB::rollback();

            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"La categoría se ha actualizado correctamente"));
        
        } catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>$e->getMessage())); //$e->getMessage() sólo para versión en desarrollo, puede cambiarse después por algo como 'Un error ha ocurrido'
        }
    }


    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            if(Role::destroy($id))
                DB::commit();
            else
                DB::rollback();
        }
        catch(Exception $e) {
            abort(501);
        }
        return redirect()->route('rol.index')
                        ->with([
                            'deleted' => $id,
                            'name' => Role::withTrashed()->where('id', $id)
                                                        ->first()
                                                        ->name
                        ]);
    }

    public function restore($id) {
        $Role = Role::withTrashed()
                        ->where('id', '=', $id)
                        ->first();
        $Role->restore();

        return redirect()->route('rol.index')->with("restored" , 'El usuario ha sido restaurado');

    }

    public function search(Request $request) {
        $query = $request->input('query');
        $roles = Role::where('name', 'like', "%$query%")->paginate(5);
    	return view('admin.roles', compact('roles', 'query'));
    }
}
