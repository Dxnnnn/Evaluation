<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    // Show the evaluation form
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'user';

        // Get employee selected via query param (for switching employees)
        $selectedEmployeeId = $request->query('employee_id', null);

        // Get all evaluations from session (store multiple evaluations)
        $allEvaluations = Session::get('evaluations', []);

        $evaluationData = null;
        $submittedAt = null;
        $canEdit = false;
        $hoursLeft = 0;

        // If an employee is selected, check if they have an evaluation
        if ($selectedEmployeeId && isset($allEvaluations[$selectedEmployeeId])) {
            $evaluationData = $allEvaluations[$selectedEmployeeId]['data'];
            $submittedAt = $allEvaluations[$selectedEmployeeId]['submitted_at'];

            // Calculate if still editable
            if ($submittedAt) {
                $submittedTime = Carbon::parse($submittedAt);
                $hoursPassed = $submittedTime->diffInHours(Carbon::now());

                if ($hoursPassed < 24) {
                    $canEdit = true;
                    $hoursLeft = 24 - $hoursPassed;
                }
            }
        }

        return view('evaluation', [
            'role' => $role,
            'user' => $user,
            'submittedData' => $evaluationData,
            'submittedAt' => $submittedAt,
            'canEdit' => $canEdit,
            'hoursLeft' => $hoursLeft,
            'selectedEmployeeId' => $selectedEmployeeId,
            'allEvaluations' => $allEvaluations
        ]);
    }

    // Handle form submission (initial or edit)
    public function submit(Request $request)
    {
        $employeeId = $request->employee_id;

        // Get all evaluations from session
        $allEvaluations = Session::get('evaluations', []);

        // Check if this employee already has an evaluation
        $existingEvaluation = isset($allEvaluations[$employeeId]) ? $allEvaluations[$employeeId] : null;
        $submittedAt = $existingEvaluation ? $existingEvaluation['submitted_at'] : null;

        // If already submitted, enforce 24-hour edit rule
        if ($submittedAt) {
            $submittedTime = Carbon::parse($submittedAt);

            if ($submittedTime->diffInHours(now()) >= 24) {
                return back()->withErrors("Editing is only allowed within 24 hours of submission.");
            }
        }

        // Count total statements dynamically (6 categories × 7 statements = 42)
        $statementsCount = 42;

        $ratings = [];
        for ($i = 0; $i < $statementsCount; $i++) {
            $ratings[$i] = $request->input("statement_$i");
            if (!$ratings[$i] || $ratings[$i] < 1 || $ratings[$i] > 5) {
                return back()->withErrors("All statements must be rated from 1 to 5.");
            }
        }

        $evaluationData = [
            'employee_id' => $employeeId,
            'ratings' => $ratings,
            'remarks' => $request->remarks,
        ];

        // set a submitted timestamp (keep original if editing)
        $nowTimestamp = $submittedAt ? $submittedAt : now();
        $evaluationData['submitted_at'] = $nowTimestamp; // inside data for Blade

        // Save evaluation for this specific employee
        $allEvaluations[$employeeId] = [
            'data' => $evaluationData,
            'submitted_at' => $nowTimestamp
        ];

        // Save all evaluations back to session
        Session::put('evaluations', $allEvaluations);

        return redirect()->route('evaluation.form', ['employee_id' => $employeeId])
                         ->with('success', 'Evaluation saved successfully!');
    }
}
