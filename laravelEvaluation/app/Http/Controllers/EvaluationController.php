<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    // Show the evaluation form
    public function index()
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'user';
        $evaluationData = Session::get('evaluation_data', null);
        $submittedAt = Session::get('submitted_at', null);

        return view('evaluation', [
            'role' => $role,
            'user' => $user,
            'submittedData' => $evaluationData,
            'submittedAt' => $submittedAt,
        ]);
    }

    // Handle form submission (initial or edit)
    public function submit(Request $request)
    {
        // Count total statements dynamically
        $statementsCount = 42; // 6 categories × 7 statements each

        $ratings = [];
        for ($i = 0; $i < $statementsCount; $i++) {
            $ratings[$i] = $request->input("statement_$i");
            if (!$ratings[$i] || $ratings[$i] < 1 || $ratings[$i] > 5) {
                return back()->withErrors("All statements must be rated from 1 to 5.");
            }
        }

        $evaluationData = [
            'employee_id' => $request->employee_id,
            'ratings' => $ratings,
            'remarks' => $request->remarks,
        ];

        // Save in session
        Session::put('evaluation_data', $evaluationData);
        Session::put('submitted_at', now());

        return redirect()->route('evaluation.form')
                         ->with('success', 'Evaluation submitted successfully!');
    }

    // Check if editing is allowed (optional helper)
    public function canEdit()
    {
        $submittedAt = Session::get('submitted_at', null);
        if (!$submittedAt) {
            return false;
        }

        return Carbon::now()->diffInHours(Carbon::parse($submittedAt)) < 24;
    }
}
