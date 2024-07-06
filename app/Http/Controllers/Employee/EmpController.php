<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmpController extends Controller
{

    /**
     * Method allEmployee
     * To show all Employee Resources  
     *
     * @return
     */
    public function allEmployee()
    {
        try {
            $employees = Employee::paginate(8);
            return view('Employee.home', compact('employees'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Method viewFull
     * To see the full details of each specifi Employee
     *
     * @param string $employeeId [explicite description]
     *
     * @return
     */
    public function viewFull(string $employeeId)
    {
        try {
            $employee = Employee::find($employeeId);
            return view('Employee.fullEmp', compact('employee'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Method show
     * Display the specified resource.
     *
     * @param string $employeeId [explicite description]
     *
     * @return 
     */
    public function show(string $employeeId)
    {
        try {
            $employee = Employee::find($employeeId);
            return view('Employee.fullEmp', compact('employee'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Method getSpecificAssignedEmployee
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getSpecificAssignedEmployee(Request $request)
    {
        try {
            $roleId = $request['roleId'];
            $specificEmployee = Employee::all()->where('roles_id', $roleId);
            return response()->json([$specificEmployee], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}