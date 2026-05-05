<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Medicine;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::find($adminId);

        $totalMedicines     = Medicine::count();
        $pendingSuggestions = Suggestion::where('status', 'pending')->count();
        $newAdditions       = Medicine::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $visitorCount = Cache::get('search_count', 0);

        return view('admin.dashboard', compact(
            'admin',
            'totalMedicines',
            'pendingSuggestions',
            'newAdditions',
            'visitorCount'
        ));
    }
}
