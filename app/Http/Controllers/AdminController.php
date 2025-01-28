<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Floor;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\PropertyNewForm;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function home(){
       $home_detail =  PropertyNewForm::count();
       $floor_detail =  Floor::count();
       $agent_request = Agent::where('status', '=', 1)->count();
       $agent_approved = Agent::where('status', '=', 2)->count();
 
        
       return view('admin.dashboard.home',compact('home_detail', 'floor_detail', 'agent_approved', 'agent_request'));
     }

     public function agenthome(){
        $home_detail =  Property::all()->where('email',Auth::user()->email);
 
         
        return view('admin.dashboard.agentHome',compact('home_detail'));
      }



     public function logout(Request $request){

        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('home');
     }
     public function register(Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email' => 'required|email',
            'password' =>'required|confirmed',
        ]);

        $user = User::create($data);

        if($user){
            return redirect()->route('admin.login.login')->with('status','success');
        }
     }

     public function createProperty(Request $request){
        return route('admin.dashboard.createProperty');
     }

    public function index()
    {

    }





    public function login( Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' =>'required',
        ]);

        if(Auth::attempt($credential)){
            return redirect()->route('admin.dashboard.home');
        }else{
            return redirect()->back()->with('status','error');
        }
       

        // return view('admin.login.login');
    }


   
    public function dashboardCheck(Request $request){

        
        // Log::info('Request method: ' . $request->method());
        
        if(Auth::check()){

            

            return view('admin.dashboard.home');

            
        }
        else{
            return redirect()->back()->with('status','error');
        };
    }

    // public function signUp()
    // {
    //     return view('admin.login.sign-up');
    // }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
