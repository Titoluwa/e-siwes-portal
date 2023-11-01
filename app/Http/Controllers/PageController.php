<?php

namespace App\Http\Controllers;

use App\User;
use App\VerifyToken;
use App\Mail\Registration;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function verify()
    {
        return view('verify');
    } 
    public function post_verify(Request $request)
    {
        $verification = VerifyToken::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();
       
        if($user == null){
            return back()->with('error', "<b>$request->email</b> not found. User has not registered");
        }
        elseif ($verification == null) {
            return back()->with('error', 'Token Not Found!! Request for a new token.');
        }
        elseif ($verification->token == $request->token) {
            User::where('email', $request->email)->update(['verified_token'=> $request->token]);
            $verification->delete();

            return redirect('login')->with('success', 'Email Verified!!! Proceed to login');
        } else{
            return back()->with('error', "Token Invalid!! Check your inbox. <b>(@$request->email)</b>");
        }
        
    }
    public function resend_verify(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {

            $prev_verification = VerifyToken::where('user_id', $user->id)->get();

            if($prev_verification != null){
                foreach ($prev_verification as $tokened) {
                    $tokened->delete();
                }
            }
            $token = 'ESP-'.(rand(100000, 999999));

            $verification = new VerifyToken();
            $verification->user_id = $user->id;
            $verification->token = $token;
            $verification->email = $request->email;
            $verification->save();
        
            Mail::to($user->email)->send(new Registration($user, $token));

            return back()->with('success', "Token resent to <b>$request->email</b>. Check your inbox");

        } else {
            return back()->with('error', "<b>$request->email</b> not found. User has not registered");
            // return back()->with('error', 'Email not found. User has not registered');
        }
    }
    
    public function password_verify(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {

            // $prev_verification = VerifyToken::where('user_id', $user->id)->get();

            // if($prev_verification != null){
            //     foreach ($prev_verification as $tokened) {
            //         $tokened->delete();
            //     }
            // }
            $token = 'PASS-'.(rand(100000, 999999));

            $verification = new VerifyToken();
            $verification->user_id = $user->id;
            $verification->token = $token;
            $verification->email = $request->email;
            $verification->save();
        
            Mail::to($user->email)->send(new ForgetPassword($user, $token));

            return redirect('/password/change')->with('success', "Token sent to $request->email. Check your inbox");

        } else {
            return back()->with('error', "<b>$request->email</b> not found. User has not registered");
        } 
    }
    public function password_change()
    {
        return view('auth.passwords.reset');
    }  
    public function password_confirm(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = VerifyToken::where('token', $request->token)->first();
        if ($token->email == $request->email) {

            $user->password = Hash::make($request->password);
            $user->update();
            $token->delete();
            
            return redirect('login')->with('success', "Password has been changed!");
        }else{
            return back()->with('error', "Cannot confirm the token inputted");
        }
    }
}
