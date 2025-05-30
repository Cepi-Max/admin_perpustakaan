<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class GuestFeedbackController extends Controller
{
    public function form()
    {
        return view('pengunjung.feedback.form');
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
