<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentEvaluationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        
        return view('studentEvaluation', compact('role', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string',
            'instructor' => 'required|string',
            'rating_1' => 'sometimes|nullable',
            'rating_2' => 'sometimes|nullable',
            'rating_3' => 'sometimes|nullable',
            'rating_4' => 'sometimes|nullable',
            'rating_5' => 'sometimes|nullable',
            'rating_6' => 'sometimes|nullable',
            'rating_7' => 'sometimes|nullable',
            'rating_8' => 'sometimes|nullable',
            'rating_9' => 'sometimes|nullable',
            'rating_10' => 'sometimes|nullable',
            'rating_11' => 'sometimes|nullable',
            'rating_12' => 'sometimes|nullable',
            'rating_13' => 'sometimes|nullable',
            'rating_14' => 'sometimes|nullable',
            'rating_15' => 'sometimes|nullable',
            'comments' => 'nullable|string',
        ]);

        // TODO: Store the evaluation data in the database
        // For now, we'll just redirect with a success message
        
        return redirect()->route('student.evaluation')->with('success', 'Evaluation submitted successfully!');
    }
}

