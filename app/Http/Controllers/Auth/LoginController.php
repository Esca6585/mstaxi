<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;

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

    /**
     * Redirect the user to the GitHub authentication page.
     * 
     * @return Response
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    
    /**
     * Obtain the user information from GitHub.
     * 
     * @return Response
     */
    public function handleGithubCallback()
    {
        $github_user = Socialite::driver('github')->user();
        
        $user = $this->userFindOrCreate($github_user, 'github');
        
        Auth::login($user, true);
        
        return redirect($this->redirectTo);
    }

    /**
     * Redirect the user to the Google authentication page.
     * 
     * @return Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    /**
     * Obtain the user information from Google.
     * 
     * @return Response
     */
    public function handleGoogleCallback()
    {
        $google_user = Socialite::driver('google')->user();
        
        $user = $this->userFindOrCreate($google_user, 'google');
        
        Auth::login($user, true);
        
        return redirect($this->redirectTo);
    }

    public function userFindOrCreate($provider_user, $provider_name){
        $user = User::where('provider_id', $provider_user->id)->OrWhere('email', $provider_user->getEmail())->first();
        $name = explode(' ', $provider_user->getName());

        if(!$user){
            $user = new User;

            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $user->email = $provider_user->getEmail();
            $user->provider_id = $provider_user->getid();
            $user->provider_name = $provider_name;
            $user->save();
        } else {
            $user = User::where('email', $provider_user->getEmail())->first();
            
            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $user->provider_id = $provider_user->getid();
            $user->provider_name = $provider_name;
            $user->update();
        }

        return $user;
    }
}