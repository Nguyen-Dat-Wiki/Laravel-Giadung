<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\User;
use Validator,Redirect,Response,File;
use Socialite;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect($provider)
    {   
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->route('home');
        
    }

    function createUser($getInfo,$provider){
 
        $user = User::where('provider_id', $getInfo->id)->first();
        
        if (!$user) {
            $user = User::create([
               'name'     => $getInfo->name,
               'email'    => $getInfo->email,
               'provider' => $provider,
               'provider_id' => $getInfo->id
           ]);
        }
        return $user;
    }


    public function Login(Request $req)
    {
        $this->validate($req,[
            'email'=>'required|email',
            'password'=> 'required'
        ]);
        if(auth()
            ->attempt(array('email'=>$req->input('email'), 'password'=> $req->input('password'))))
            {
                if(auth()->user()->is_admin==1){
                    return redirect()->route('admin_home');
                }else{
                    return redirect()->route('home');
                }
            }
        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }
}
