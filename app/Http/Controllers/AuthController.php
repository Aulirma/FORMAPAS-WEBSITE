<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'USER_EMAIL' => 'required|email',
            'USER_PASSWORD' => 'required',
        ]);

        $user = FormUser::where('USER_EMAIL', $request->USER_EMAIL)->first();

        if ($user && Hash::check($request->USER_PASSWORD, $user->USER_PASSWORD)) {
            // Login sukses, simpan session
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'USER_EMAIL' => 'Email atau password salah',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'USER_NAME' => 'required|string|max:255',
            'USER_EMAIL' => 'required|email|unique:formuser,USER_EMAIL',
            'USER_PASSWORD' => 'required|string|min:6',
            'NIK' => 'required|string|unique:formuser,NIK',
        ]);

        $user = FormUser::create([
            'USER_NAME' => $request->USER_NAME,
            'USER_EMAIL' => $request->USER_EMAIL,
            'USER_PASSWORD' => Hash::make($request->USER_PASSWORD),
            'NIK' => $request->NIK,
            'ADMIN_ID' => 1, // default Admin
        ]);

        Auth::login($user);

        return redirect()->route('home'); 
    }

    public function saveMbti(Request $request)
    {
        $request->validate([
            'mbti' => 'required|string|size:4'
        ]);

        $user = Auth::user();

        if ($user->MBTI_RESULT !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Hasil MBTI sudah tersimpan dan tidak dapat diubah'
            ], 403);
        }

        $user->MBTI_RESULT = $request->mbti;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'MBTI berhasil disimpan'
        ]);
    }

}
