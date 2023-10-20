<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

// THIS IS IN THE "trait AuthenticatesUsers" in the vendor file, under the sendLoginResponse function protected function

        // $this->clearLoginAttempts($request);
        // // ************************************************************************************************
        // if (Auth::user()->logged == 1) {
        //     $this->logout($request);
        //     return back()->with('error','Already Logged In!!');
        // // **************************************************************************************************
        // }
        // elseif (Auth::user()->verified_token == null) {
        //     $this->logout($request);
        //     return back()->with('error','Account not Verified');
        // }
        // // **************************************************************************************************
        // elseif ($response = $this->authenticated($request, $this->guard()->user())) {
        //     return $response;
        // }
        //     return $request->wantsJson()
        //                 ? new JsonResponse([], 204)
        //                 : redirect()->intended($this->redirectPath());
    public function redirectTo(){
        User::where('id', Auth::user()->id)->update(['logged'=> 1]);
        
        switch(Auth::user()->role_id)
        {
            case 0:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;
            case 1:
                $this->redirectTo = '/student';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/school';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/industry';
                return $this->redirectTo;
                break;
            case 4:
                $this->redirectTo = '/itfagent';
                return $this->redirectTo;
                break;        
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
                break;
            // case 0:
            //     $this->redirectTo = '/student';
            //     return $this->redirectTo;
            //     break;
            // case 1:
            //     $this->redirectTo = '/school';
            //     return $this->redirectTo;
            //     break;
            // case 2:
            //     $this->redirectTo = '/industry';
            //     return $this->redirectTo;
            //     break;
            // default:
            //     $this->redirectTo = '/login';
            //     return $this->redirectTo;
            //     break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','loggingOut']);
    }
    public function loggingOut(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['logged'=> 0]);
        User::where('id', Auth::user()->id)->update(['last_login'=> Carbon::now()]);
        return $this->logout($request);
    }
}
