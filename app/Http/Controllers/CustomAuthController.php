<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use App\Models\{State,City};
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
class CustomAuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }
    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required | max:10',
            'password'=>'required|min:5|max:20',
            'cpassword'=>'required|min:5|max:20',
            'state' => 'required',
            'city' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $state = State::find($request->state);
        if ($state) {
            $user->state = $state->name;
        }
    
        // Get the city name
        $city = City::find($request->city);
        if ($city) {
            $user->city = $city->name;
        }
        $user->password = Hash::make($request->password);
        $user->cpassword = Hash::make($request->cpassword);
        $res = $user->save();
        if ($res) {
            return redirect()->route('login')->with('success', 'You have registered successfully. Please login.');
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:20',
        ]);
        $user = User::where('email','=', $request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail','password not match');
            }
        }else{
            return back()->with('fail','This email is not registered');
        }
    }
    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('dashboard',compact('data'));
    }

    public function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }

    public function getState()
    {
        $data['states'] = State::get(["name","id"]);
        return view('registration',$data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                                    ->get(["name","id"]);
        return response()->json($data);
    }
    
    public function showForm()
{
    $states = State::all(); 

    return view('auth/registration', compact('states'));
}

}
