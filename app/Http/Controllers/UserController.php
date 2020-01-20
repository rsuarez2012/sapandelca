<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Rol;
class UserController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $roles = Rol::where('condition', 1)->get();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->dni          = $request->dni;
        $user->email        = $request->email;
        $user->user         = $request->user;
        $user->password     = bcrypt($request->password);
        $user->address      = $request->address;
        $user->telephone    = $request->telephone;
        $user->cellphone    = $request->cellphone;
        $user->status       = 1;
        $user->rol_id       = $request->rol_id;
        $user->save();
        return redirect()->route('usuarios.index')->with('info', 'Usuario registrado con Exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($request->id);
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->dni          = $request->dni;
        $user->email        = $request->email;
        $user->user         = $request->user;
        $user->password     = bcrypt($request->password);
        $user->address      = $request->address;
        $user->telephone    = $request->telephone;
        $user->cellphone    = $request->cellphone;
        $user->status       = 1;
        $user->rol_id       = $request->rol_id;
        $user->save();
        return redirect()->route('usuarios.index')->with('info', 'Usuario actualizado con Exito.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$user = User::find($request->id);
        //funciona pesta por ajax pero no recarga la pagina
        /*$where = array('id' => $id);
        $user  = User::where($where)->first();
        if($user->status == '1'){
            $user->status = '0';
            $user->save();
            //return redirect()->route('usuarios.index');
            //return response()->json();
            return back();
            
        }else{
            $user->status = '1';
            $user->save();
            //return response()->json();
            return back();
            //return redirect()->route('usuarios.index');
            

        }*/
        //esta con el modal de boostrap
        $user= User::findOrFail($request->id);
         
         if($user->status == "1"){

                $user->status= '0';
                $user->save();
                return Redirect::to("usuarios")->with('info', 'Usuario desactivado con Exito.!');

           }else{

                $user->status = '1';
                $user->save();
                return Redirect::to("usuarios")->with('info', 'Usuario activado con Exito.!');

            }
    }
}
