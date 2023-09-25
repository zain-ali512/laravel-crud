<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getAllEmp()
    {
        try {
            $employees = Employee::all();
            return response()->json([
                'status' => 200,
                'employees' => $employees
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createEmp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required|integer|max:20',
                'f_name' => 'required|string|max:20',
                'l_name' => 'required|string|max:20',
                'designation' => 'required|string|max:50',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Validation failed');
            }
            $employee = Employee::create([
                'emp_id' => $request->emp_id,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'designation' => $request->designation
            ]);
            if (!$employee) {
                throw new \Exception('Employee creation failed');
            }
            return response()->json([
                'status' => 200,
                'message' => 'Employee created successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getOneEmp($emp_id)
    {
        try {
            $employee = Employee::find($emp_id);
            if ($employee) {
                return response()->json([
                    'status' => 200,
                    'employee' => $employee
                ]);
            } else {
                throw new \Exception('Employee not found');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function updateEmp(Request $request, $emp_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required|integer|max:20',
                'f_name' => 'required|string|max:20',
                'l_name' => 'required|string|max:20',
                'designation' => 'required|string|max:50',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Validation failed');
            }
            $employee = Employee::where('emp_id', $emp_id)->first();
            if ($employee) {
                $employee->emp_id = $request->emp_id;
                $employee->f_name = $request->f_name;
                $employee->l_name = $request->l_name;
                $employee->designation = $request->designation;
                $employee->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Employee updated successfully'
                ], 200);
            } else {
                throw new \Exception('No employee found');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function deleteEmp($emp_id)
    {
        try {
            $employee = Employee::where('emp_id', $emp_id)->first();
            if ($employee) {
                $employee->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Employee deleted successfully'
                ], 200);
            } else {
                throw new \Exception('No employee found');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}