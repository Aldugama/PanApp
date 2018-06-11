<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function __construct() {

        $this->middleware('role:admin');
    
    }

    public function index()
    {
        $users = User::paginate(5);
        $roles = Role::all();
        $element = 'usuario';
        return view('admin.usuarios', compact('users', 'roles', 'element'));
    }


    public function store(UserStore $request)
    {
        try {
            DB::beginTransaction();
            if(User::withTrashed()->where('email', $request->email)->first() != null) 
                User::withTrashed()->where('email', $request->email)->first()->forceDelete();

            if(User::where('email', $request->email) != null) {
                return back()->with('error', 'El email: '. $request->email .' introducido ya existe. Inténtelo de nuevo con otro.');
            }
    
            if(User::create($request->except('_token')))
                DB::commit();
            else
                DB::rollback();
        }
        catch(Exception $e) {
            abort(501); 
        }

        return redirect()->route('usuario.index')->with('success', 'El usuario '. $request->name .' se ha creado con éxito');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $role = $user->role->name;

        return array('user'=>$user, 'role' => $role);
    }


    public function update(UserUpdate $request, $id)
    {
        $role = Role::findOrFail($request->role);
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role()->associate($role);
            
            if($user->save())
                DB::commit();
            else
                DB::rollback();  

            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>"El usuario ". $user->name ." se ha actualizado correctamente"));
        
        } catch(Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>'Un error ha ocurridos')); 
        }
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuario.index')->with([
            'deleted' => $id,
            'name' => User::withTrashed()->where('id', $id)->first()->name
            ]);
    }

    public function restore($id) {
        $user = User::withTrashed()
                        ->where('id', '=', $id)
                        ->first();
        $user->restore();

        return redirect()->route('usuario.index')->with("restored" , $user->name);

    }

    public function search(Request $request) {
        $query = $request->input('query');
        $roles = Role::all();
        if($request->option == "role") {
            $users = Role::where('name', 'like', "%$query%")
                         ->first()
                         ->users()
                         ->paginate(5);
        }
        elseif ($request->option == 'name'){
            $users = User::where('name', 'like', "%$query%")
                            ->paginate(5);
        }
        else {
            abort(500);
        }
    	return view('admin.usuarios', compact('users', 'roles', 'query'));
    }
}
