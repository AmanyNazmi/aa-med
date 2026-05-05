<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('admin_id')) return redirect()->route('admin.login');
        $admin = Admin::find($request->session()->get('admin_id'));

        $filter = $request->query('filter', 'all');

        $suggestions = Suggestion::when($filter !== 'all', function ($q) use ($filter) {
                $q->where('status', $filter);
            })
            ->orderByDesc('created_at')
            ->paginate(8)
            ->appends(['filter'=>$filter]);

        return view('admin.suggestions.index', compact('admin','suggestions','filter'));
    }

    public function approve(Request $request, Suggestion $suggestion)
    {
        $suggestion->update(['status'=>'approved']);
        return back()->with('msg','Suggestion approved.');
    }

    public function reject(Request $request, Suggestion $suggestion)
    {
        $suggestion->update(['status'=>'rejected']);
        return back()->with('msg','Suggestion rejected.');
    }
}
