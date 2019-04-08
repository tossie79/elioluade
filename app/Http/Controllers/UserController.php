<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only(['destroy', 'profile']); // authenticated users can only see the profile and destroy
        $this->middleware('guest')->only(['getSignInForm', 'signIn', 'getSignUpForm', 'signUp']); //unauthenticated users / guest can see the sign up and login
    }

    public function index() {
        
    }

    public function getSignUpForm() {
        return view('user.signup');
    }

    public function signUp(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|unique:users', //unique to users table
            'password' => 'required|min:4'
        ]);


        //METHOD 1
        /**     $user = new User;
          $user->email=$request->input('email');
          $user->password = $request->input('password');
          $user->save();
         * */
        //OR METHOD 2 ( if fillable is created in the Model eg User model
        $user = User::create([
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password'))
        ]);
        Auth::login($user); // or auth()->login($user);
        return redirect()->route('product.index');
    }

    public function getSignInForm() {
        return view('user.signin');
    }

    public function signIn(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.profile');
        }

        return redirect()->back();
    }

    public function destroy() {

        Auth::logout();

        return redirect()->route('product.index');
    }

    public function profile() {
        return view('user.profile');
    }

}
