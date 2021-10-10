<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\PasswordLenght;
use App\Rules\PasswordLower;
use App\Rules\PasswordUpper;
use App\Rules\PasswordSpec;

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
            
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec],
              ]);
              if($validator->fails()){
                // fail si requête ne correspond pas à validation
                return back()->with($validator);
              }
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

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec],
              ]);
            if($validator->fails()){
                // fail si requête ne correspond pas à validation
            return back()->with($validator);
            Auth::login($user);
            
              }


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