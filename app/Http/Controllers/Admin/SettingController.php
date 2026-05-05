<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail($adminId);

        $photoFile = $admin->email === 'Ahmed@gmail.com' ? 'Ahmed.jpeg' : 'Amany.jpeg';

        return view('Admin.settings.settings', compact('admin', 'photoFile'));
    }

    public function update(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::find($adminId);
        if (!$admin) {
            return back()->withErrors(['admin' => 'Admin not found.']);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        $admin->name = $request->name;
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()
                    ->withErrors(['current_password' => 'Current password is incorrect'])
                    ->withInput();
            }

            $admin->password = Hash::make($request->new_password);
        }
        $admin->save();
        $request->session()->put('admin_name', $admin->name);

        if ($request->hasFile('photo')) {
            $photoFile = $admin->email === 'Ahmed@gmail.com' ? 'Ahmed.jpeg' : 'Amany.jpeg';

            $destination = public_path('images/admins');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $request->file('photo')->move($destination, $photoFile);
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
