<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

//nuevas importaciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
      //  $this->middleware('guest')->except('logout');
    //}
    //
    //otra configuracion

    public function showLoginForm()
    {
        # code...
        return view('auth.login');
    }

    //Metodo para validar las credenciales 
    //
    

    public function login(Request $request)
    {
        //dd($request->all());
        # code...
        /*$this->validate($request,[
            //validamos si el input email esta lleno
            //validamos si el input email o campo usuario esta lleno
            //'email' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);*/

        /*if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])){
                return redirect('clientes');
        }
        return back();*/
        $this->validateLogin($request);      
        if (Auth::attempt(['user' => $request->user,'password' => $request->password, 'status' => 1])){
             return redirect('/dashboard');
             //return redirectTo('/login');
         }

         return back()->withErrors(['email' => trans('auth.failed')])
         ->withInput(request(['email']));

    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'user' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
    public function redirectTo()
    {
        $rol = auth()->user()->rol_id;
        switch ($rol) {
            case '1':
                return redirect()->route('departamentos.index');
                # code...
                break;
            case '2':
                return redirect()->route('departamentos.index');
                # code...
                break;
            case '3':
                return redirect()->route('clientes.index');
                # code...
                break;
            case '4':
                return redirect()->route('clientes.index');
                # code...
                break;
            
            default:
                # code...
                break;
        }
        # code...
    }
}