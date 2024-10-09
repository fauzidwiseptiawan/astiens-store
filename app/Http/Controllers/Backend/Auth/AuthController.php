<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    function index()
    {
        if (!empty(Auth::check())) {
            return redirect('panel/admin/dashboard');
        }
        return view('backend.auth.index');
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required',
            'password'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password,
            ];
            if ($user) {
                if ($user->is_deleted == 0 && $user->is_active == 1) {
                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();
                        return response()->json([
                            'status'   => 200,
                            'message'  => 'Your login was successful!'
                        ]);
                    } else {
                        return response()->json([
                            'status'   => 401,
                            'message'  => 'Incorrect Email or password!'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status'   => 401,
                        'message'  => 'Email is not currently active!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'   => 401,
                    'message'  => 'Email not found!'
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        if ($request->ajax()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json([
                'status'   => 200,
                'message'  => 'You have successfully logged out!'
            ]);
        }
    }
}
