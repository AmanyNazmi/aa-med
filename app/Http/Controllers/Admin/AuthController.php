<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
            'remember' => ['nullable'],
        ]);

        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
        }

        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_name', $admin->name);

        if ($request->boolean('remember')) {
            cookie()->queue(cookie('admin_remember', $admin->id, 60*24*30));
        }

        return redirect()->route('admin.dashboard');
    }

    public function hello(Request $request) {
        if (!$request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.dashboard', ['name' => $request->session()->get('admin_name')]);
    }

    public function logout(Request $request) {
        $request->session()->forget(['admin_id','admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
