<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password']
        ], [
            'required' => 'Kolom :attribute wajib diisi',
            'unique' => 'Email telah digunakan',
            'email' => 'Kolom :attribute wajib berupa email',
            'min' => 'Jumlah karakter :attribute minimal 6 karakter',
            'same' => 'Konfirmasi password tidak cocok',
        ]);

        if($validator->fails()) {
            $errors = [];
            foreach($validator->errors()->messages() as $error) {
                foreach($error as $err) {
                    array_push($errors, $err);
                }
            }
            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        $credentials = $request->only('email', 'password');

        return $this->auth_process($credentials, 'register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ], [
            'required' => ':attribute wajib diisi',
            'email' => ':attribute wajib berupa email',
            'exists' => ':attribute tidak ditemukan' ,
        ]);

        if($validator->fails()) {
            $errors = [];
            foreach($validator->errors()->messages() as $error) {
                foreach($error as $err) {
                    array_push($errors, $err);
                }
            }
            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        return $this->auth_process($credentials, 'login');
    }

    public function resetPassword(Request $request)
    {
        // if(!$request->has('reset')) {
        //     return view()
        // }
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email']
        ], [
            'request' => 'Kolom :attribute wajib diisi',
            'email' => 'Kolom :attribute wajib email'
        ]);
        if($validator->fails()) {
            $errors = [];
            foreach($validator->errors()->messages() as $error) {
                foreach($error as $err) {
                    array_push($errors, $err);
                }
            }
            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        }


        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil update password'
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');

    }

    public function auth_process($credentials, $type)
    {
        if(Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Login'
            ]);
        }

        if($type == 'register') {
            $message = 'Registrasi gagal, silakan coba lagi nanti';
        } elseif($type == 'login') {
            $message = 'Login gagal, email atau password tidak sesuai';
        } else {
            $message = 'Autentikasi gagal';
        }

        return response()->json([
            'success' => false,
            'message' => [$message]
        ], 422);
    }
}
