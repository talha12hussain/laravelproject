<?php

namespace App\Http\Controllers;
use App\Models\User;

use Carbon\Carbon;
use DB;
use Mail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_reset')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.emailPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');

    }

    public function showResetPasswordForm($token)
    {

        $email = DB::table('password_reset')->where('token', $token)->value('email');

        return view('auth.forgetPasswordLink', ['token' => $token, 'email' => $email]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        try {

            $request->validate([
                'email' => 'email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);

            // Check if the token and email exist in the password reset table
            $updatePassword = DB::table('password_reset')->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();


            // if (!$updatePassword) {
            //     return back()->withInput()->with('error', 'Invalid token!');
            // }


            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'User with this email does not exist.');
            }
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the token after the password has been reset
            DB::table('password_reset')->where(['email' => $request->email])->delete();

            // Redirect to login with a success message
            return view('admin.login.login')->with('message', 'Your password has been changed!');
        } catch (\Exception $e) {

            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}