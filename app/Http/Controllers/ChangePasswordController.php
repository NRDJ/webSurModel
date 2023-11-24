<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    public function __construct()

    {

        $this->middleware('auth',['except' => ['showForgetPasswordForm','submitForgetPasswordForm','showResetPasswordForm','submitResetPasswordForm']]);

    }

   

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()
    {
        return view('dashboard.settings.changePassword');
    } 

    public function showForgetPasswordForm()
    {
       return view('dashboard.settings.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
        
        $user = User::where('email', $request->email)->first();
        
        Mail::to($user->email)->send(new \App\Mail\ResetPasswordLink($user, $token));

        // Mail::send('emails.forget-password', ['token' => $token,'user'=>$user], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Reset Password');
        // });

        return back()->with('message', 'Hemos enviado a tu correo un link para cambiar la contraseña');
    }

    public function showResetPasswordForm(Request $request,$token) {
        if (! $request->hasValidSignature()) {
            abort(403);
        }
       return view('dashboard.settings.forgetPasswordLink', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/dashboard')->with('message', 'Your password has been changed!');

    }


}
