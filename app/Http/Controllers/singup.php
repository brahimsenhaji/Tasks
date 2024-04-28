<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class singup extends Controller
{
    function index(){
      return view('frontend.singup');
    }
    function create(Request $request){

      $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string',
      ]);


      $existingUser = ModelsUser::where('email', $validatedData['email'])->first();

      if ($existingUser) {
        return back()->withInput()->withErrors(['email' => 'Email already exists']);
      }

      $user = new ModelsUser();
      $user->name = $validatedData['name'];
      $user->email = $validatedData['email'];
      $user->password = Hash::make($validatedData['password']);
      $user->save();

      return redirect()->route('home_page')->with('success', 'User created successfully');
  }
  function singin(Request $request){

    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
      ]);

      if (Auth::attempt($credentials)) {
          return redirect()->intended(route('tasks_page'));
      } else {
          return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
      }
  }
  function logout(Request $request)
  {
      Auth::logout();
      return response()->json(['message' => 'Logged out successfully']);
  }
}
