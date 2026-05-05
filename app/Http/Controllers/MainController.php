<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search()
    {
        return view('search');
    }

    public function suggestion()
    {
        return view('suggestion');
    }

    public function view(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if ($q === '') {
            return redirect()->route('search')->with('msg', 'اكتب اسم الدواء أولاً');
        }

        Cache::increment('search_count');

        $medicine = Medicine::where('med_name', 'LIKE', "%{$q}%")->first();

        if (!$medicine) {
            return redirect()->route('search')->with('msg', 'لا توجد نتائج مطابقة لاسم الدواء: ' . $q);
        }

        return view('view', [
            'q'        => $q,
            'medicine' => $medicine,
        ]);
    }

    public function suggestionStore(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:100',
            'role'      => 'required|in:patient,doctor,pharmacist',
            'email' => 'required|email|max:100',
            'sugg_text' => 'required|string|min:5',
        ]);

        try {
            Suggestion::create($data);
        } catch (QueryException $e) {
            if ((int)($e->errorInfo[1] ?? 0) === 1062) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'This email already submitted a suggestion.']);
            }
        return back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong, please try again.']);
        }

        return redirect()->route('suggestion')->with('msg', 'Suggestion submitted successfully');
    }
}