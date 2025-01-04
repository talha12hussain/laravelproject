<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agent;

use Carbon\Carbon;
use DB;
use Mail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class AgentForgetPasswordController extends Controller
{
    public function showForgetPasswordForm(){
        return view('auth.agentForgetPassword');
    }

    public function submitForgetPasswordForm(Request $request){

        
       $validatedData =  $request->validate([
            'agentEmail' => 'required|email|exists:agents,agentEmail',
        ]);

        if (!$request->agentEmail) {
            return back()->withErrors(['agentEmail' => 'Email is required']);
        }



        $token = Str::random(60);
        
        DB::table('agent_password_reset')->insert([
            'email' => $request->agentEmail,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.agentEmailPassword', ['token' => $token], function($message) use($request){
            $message->to($request->agentEmail);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');

    }

    public function showResetPasswordForm($token){

        $email = DB::table('agent_password_reset')->where('token', $token)->value('email');

        return view('auth.agentForgetPasswordLink', ['token' => $token, 'email' => $email]);
    }

    public function submitResetPasswordForm(Request $request)
{
    // Validate request data

    // dd($request->all());
    $request->validate([
        'email' => 'required|email|exists:agents,agentEmail',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required'
    ]);

    try {
        // Verify token and email in reset table
        $updatePassword = DB::table('agent_password_reset')->where([
            'email' => $request->email,  // Ensure using the correct email field
            'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        // Update password in the agents table
        Agent::where('agentEmail', $request->email)  // Use the correct email field here
            ->update(['password' => Hash::make($request->password)]);

        // Delete the reset record
        DB::table('agent_password_reset')->where(['email' => $request->email])->delete();

        // Redirect with success message
        return view('admin.agent-login.login')->with('message', 'Your password has been changed!');
    } catch (\Exception $e) {
        // Handle any exceptions and return error
        return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}
}
