<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::latest()->paginate(10);
        return view('admin.feedback.index', compact('feedback'));
    }

    public function showDetail($id)
    {
        $item = Feedback::findOrFail($id);
        return view('admin.feedback.detail', compact('item'));
    }

    public function form()
    {
        return view('admin.feedback.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:50',
            'kritik' => 'nullable|string|max:1000',
            'saran' => 'nullable|string|max:1000',
        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda!');
    }

}

