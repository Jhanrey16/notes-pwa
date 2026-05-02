<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = 'Sogod, Southern Leyte';
        $weather = null;
        try {
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);
            if ($response->successful()) {
                $data = $response->json();
                $weather = [
                    'temp' => $data['main']['temp'],
                    'description' => $data['weather'][0]['description'],
                    'city' => $data['name']
                ];
            }
        } catch (\Exception $e) {
            // fail silently (no crash on login page)
            $weather = null;
        }
        return view('auth.login', compact('weather'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'admin_key' => 'nullable|string',
        ]);

        $role = 0;
        if (($data['admin_key'] ?? null) === 'admin123') {
            $role = 1;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $role,
        ]);

        Auth::login($user);

        return redirect()->route('notes.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('notes.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}