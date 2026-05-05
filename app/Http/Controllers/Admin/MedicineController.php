<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        if (!$adminId) return redirect()->route('admin.login');
        $admin = Admin::find($adminId);

        $q = trim((string) $request->query('q', ''));

        $medicines = Medicine::when($q !== '', fn($qr) =>
                $qr->where('med_name', 'LIKE', "%{$q}%")
            )
            ->orderByDesc('med_id')
            ->paginate(10)
            ->appends(['q'=>$q]);

        return view('admin.medicines.index', compact('admin','medicines','q'));
    }

    public function create(Request $request)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');
        $admin = Admin::find($request->session()->get('admin_id'));
        return view('admin.medicines.create', compact('admin'));
    }

    public function store(Request $request)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');

        $data = $request->validate([
            'med_name'     => ['required','string','max:100'],
            'med_use'      => ['nullable','string'],
            'side_eff'     => ['nullable','string'],
            'med_warning'  => ['nullable','string'],
            'preg_warning' => ['nullable','string'],
            'alter_med'    => ['nullable','string','max:100'],
            'pres_required'=> ['nullable','boolean'],
        ]);

        $data['pres_required'] = $request->boolean('pres_required');

        Medicine::create($data);

        return redirect()->route('admin.medicines.index')->with('msg','Medicine created successfully.');
    }

    public function edit(Request $request, Medicine $medicine)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');
        $admin = Admin::find($request->session()->get('admin_id'));
        return view('admin.medicines.edit', compact('admin','medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');

        $data = $request->validate([
            'med_name'     => ['required','string','max:100'],
            'med_use'      => ['nullable','string'],
            'side_eff'     => ['nullable','string'],
            'med_warning'  => ['nullable','string'],
            'preg_warning' => ['nullable','string'],
            'alter_med'    => ['nullable','string','max:100'],
            'pres_required'=> ['nullable','boolean'],
        ]);

        $data['pres_required'] = $request->boolean('pres_required');

        $medicine->update($data);

        return redirect()->route('admin.medicines.index')->with('msg','Medicine updated successfully.');
    }

    public function destroy(Request $request, Medicine $medicine)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');

        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('msg','Medicine deleted.');
    }
}
