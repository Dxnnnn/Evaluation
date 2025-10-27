<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $employees = Employee::orderBy('lastName')->get();
        
        return view('employee', compact('role', 'user', 'employees'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'gender' => 'required|in:Male,Female,Other',
                'status' => 'required|in:Active,Inactive,On Leave',
                'department' => 'required|string',
                'birthday' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check for duplicate email before trying to create
            if (Employee::where('email', $request->email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An employee with this email already exists',
                    'errors' => ['email' => ['This email address is already in use']]
                ], 422);
            }

            $employee = Employee::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'gender' => $request->gender,
                'status' => $request->status,
                'department' => $request->department,
                'birthday' => $request->birthday,
                'dateHired' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employee added successfully',
                'employee' => $employee
            ]);

        } catch (\Exception $e) {
            // Log the error for debugging but show a user-friendly message
            \Log::error('Error adding employee: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unable to add employee. Please try again or contact support if the problem persists.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,'.$employee->id,
                'gender' => 'required|in:Male,Female,Other',
                'status' => 'required|in:Active,Inactive,On Leave',
                'department' => 'required|string',
                'birthday' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $employee->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'gender' => $request->gender,
                'status' => $request->status,
                'department' => $request->department,
                'birthday' => $request->birthday,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully',
                'employee' => $employee
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating employee: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting employee: ' . $e->getMessage()
            ], 500);
        }
    }
}