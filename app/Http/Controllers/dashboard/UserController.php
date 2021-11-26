<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\UpdateUserEdit;

class UserController extends Controller
{

    // Validacion de inicio de session para usuario que no esten registrados no pueda hacer nada mas que registrarse y ver la tabla
    public function __construct()
    {
        $this->middleware('auth')->except("index");
    }
    /**
     * Display a listing of the resource.
     * Paginacion simple y redireccion al index
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('created_at', 'desc')->SimplePaginate(10);
        return view("dashboard/user/index", ['users' => $users]);

      
    }

    /**
     * Show the form for creating a new resource.
     * Redireccion al formulario de registro e ingreso de un usuario a otros mas
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("auth/register", ['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Manejo de la regla de validacion para un usuario asi como su insercion
     * Ademas del uso de una session momentanea
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return back()->with('status', 'Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     * Visualizacion de un registro en especifico de la tabla
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("dashboard/user/showUser", ['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     * Inicio de la carga de datos en un formulacion para su actualizacion
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view("dashboard/user/editUser", ['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     * Validacion y actualizacion de lo datos de un usuario
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserEdit $request, User $user)
    {
        $user->update(
            ['name' => $request['name'],
            'email' => $request['email'] ]);
            return back()->with('status', 'Usuario Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     * Eliminacion de un usuario con validacion para no eliminar el mismo usuario logeado
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        if (auth()->user()->id != $user->id) {
            return back()->with('status', 'Usuario Borrado con exito');
        }
    }
}
