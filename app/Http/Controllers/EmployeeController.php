<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDetails;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
            return view('home', compact('employees'));
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
            return view('fullEmp', compact('employee'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method index
     * Display a listing of the resource.
     *
     * @return 
     */
    public function index()
    {
        try {
            $roles = Role::all();
            $employees = Employee::all();
            return view('employee', compact('employees', 'roles'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method create
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        try {
            // Show the form to create new employee resources
            return view('employee');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method store
     * Store a newly created resource in storage.
     *
     * @param Request $request [explicite description]
     *
     * @return
     */
    public function store(EmployeeDetails $request)
    {
        try {
            $imagePath = $request->file('profile_pic')->store('images', 'public');

            $employee = new Employee();
            $employee->name = $request['name'];
            $employee->profile_pic = $imagePath;
            $employee->mobile_number = $request['mobile_number'];
            $employee->parents_name = $request['parents_name'];
            $employee->current_address = $request['current_address'];
            $employee->parmanent_address = $request['parmanent_address'];
            $employee->adhar_number = $request['adhar_number'];
            $employee->date_of_birth = $request['date_of_birth'];
            $employee->gender = $request['gender'];
            $employee->emergency_contact_no = $request['emergency_contact_no'];
            $employee->email = $request['email'];
            $employee->roles_id = $request['roles_id'];
            $employee->age = $request['age'];
            $employee->highest_qualification = $request['highest_qualification'];
            $employee->save();

            return redirect()->route('home')->with('new_emp', 'New Employee Added Successfully');

        } catch (\Throwable $th) {
            throw $th;
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
            return view('fullEmp', compact('employee'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method edit
     * Show the form for editing the specified resource.
     *
     * @param string $employeeId [explicite description]
     *
     * @return 
     */
    public function edit(string $employeeId)
    {
        try {
            $roles = Role::all();
            $emp = Employee::find($employeeId);
            return view('editEmp', compact('emp', 'roles'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method update
     * Update the specified resource in storage.
     *
     * @param Request $request [explicite description]
     * @param string $employeeId [explicite description]
     *
     * @return 
     */
    public function update(EmployeeDetails $request, string $employeeId)
    {
        try {
            $imagePath = $request->file('profile_pic')->store('images', 'public');

            $employee = Employee::find($employeeId);
            $employee->name = $request['name'];
            $employee->profile_pic = $imagePath;
            $employee->mobile_number = $request['mobile_number'];
            $employee->parents_name = $request['parents_name'];
            $employee->current_address = $request['current_address'];
            $employee->parmanent_address = $request['parmanent_address'];
            $employee->adhar_number = $request['adhar_number'];
            $employee->date_of_birth = $request['date_of_birth'];
            $employee->gender = $request['gender'];
            $employee->emergency_contact_no = $request['emergency_contact_no'];
            $employee->email = $request['email'];
            $employee->roles_id = $request['roles_id'];
            $employee->age = $request['age'];
            $employee->highest_qualification = $request['highest_qualification'];
            $employee->save();

            return redirect()->route('home')->with('update_emp', 'Employee Updated Successfully');

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Method destroy
     * Remove the specified resource from storage.
     *After the Delete part is done send the user to the root page.
     
     * @param string $employeeId [explicite description]
     *
     * @return void
     */
    public function destroy(string $employeeId)
    {
        try {
            $employee = Employee::find($employeeId);
            if (!is_null($employee)) {
                $employee->delete();
            }

            return redirect()->route('home');
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