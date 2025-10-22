<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Resetpassword;
use Illuminate\Support\Str;


class Authcontroller extends Controller
{
    public function signup(){
        return view('users/signup');
    }

    public function adminsignin(){
        return view('users/signinadmin');
    }

    public function forgotpassword(){
        return view('users/forgotpassword');
    }

    public function login_via_email_password(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::check() && Auth::user()->role == "admin") {
                return redirect()->route('dashboard');
            }else{
                return back()->withErrors([
                    'notmatched' => "You don't have perission to log in.",
                ])->onlyInput('notmatched');
            }
        }

        return back()->withErrors([
            'notmatched' => 'Invalid Email & Password.',
        ])->onlyInput('notmatched');

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('adminsignin');
    }

    public function resetpassword(Request $request){
        if ($request->method() == "POST") {
            $validated = $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
            $user = User::GetSingleEmail($request->email);
            if (!empty($user)){
                $user->remember_token = Str::random(40);
                $user->save();
                Mail::to($user->email)->send(new Resetpassword($user))
                ;
                return redirect()->back()->with('successmailsend','Reset link sent on registered email');
            }else {

                return back()->withErrors([
                    'notmatched' => "Email Not Found",
                ])->onlyInput('notmatched');
            }
        }
        return view('users/resetpassword');
    }

    public function tokanchangepassword(Request $request, $token){
        if ($request->method() == "POST") {
            $validated = $request->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);
            if ($request->password ==  $request->confirm_password) {
                $user = User::GetSingleToken($token);
                $user->remember_token = Str::random(40);
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect('/')->with('success','Password Changed Successfully');
            }else {
                return back()->withErrors([
                    'notmatched' => "Password Not Matched",
                ])->onlyInput('notmatched');
            }
        }
        $user = User::GetSingleToken($token);
        if (!empty($user)){
            $data['tittle'] = "Change Password";
            $data['user'] = $user;
            $data['token'] = $token;
            return view('users/changepassword', $data);
        }else {
            abort(404);
        }
    }

}
