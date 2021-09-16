<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Hash;

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
public function test(Request $request)
{
dd($request->all());
}
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $user = User::where('email',$userSocial->email)->first();
        $valid = 0;
        
        if($user)
        {
            
            
            Auth::login($user);
            
            
            
        }
        else{
            $newUser = new User();
            $newUser->name = $userSocial->getName();
            $newUser->email = $userSocial->getEmail();
            $newUser->password = Hash::make('12345678');
            $newUser->save();

            
            
            Auth::login($newUser);
        }  
        if(Auth::guard('web')->check())
        
            return redirect()->route('competition');
            
        else return 1;
            
        
    }
    
    public function Provider()
    {
        return Socialite::driver('google')->redirect();
    }
    
    
    public function Callback()
    {
        $userSocial = Socialite::driver('google')->user();

        $user = User::where('email', $userSocial->email)->first();
        $valid = 0;

        if ($user) {
            Auth::login($user);
        } else {
            $newUser = new User();
            $newUser->name = $userSocial->getName();
            $newUser->email = $userSocial->getEmail();
            $newUser->password = Hash::make('12345678');
            $newUser->save();



            Auth::login($newUser);
        }
        if (Auth::guard('web')->check())
            return redirect()->route('competition');

        else return 1;
    }

}
