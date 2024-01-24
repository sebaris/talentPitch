<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

  public function login(Request $request) {
    $this->validateLogin($request);

    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json([
        'error' => [
          'message' => 'Credentials does not match.',
          'status_code' => 401
        ]
      ], 401);
    }

    $user = User::whereEmail($request->email)->get();

    return response()->json([
      'user' => $user,
      'token' => $request->user()->createToken("API token of " . request()->user()->name)->plainTextToken,
      'message' => 'Success'
    ]);
  }

  public function validateLogin(Request $request) {
    return $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);
  }
}
