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

    
}

