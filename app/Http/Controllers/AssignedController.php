<?php

namespace App\Http\Controllers;

use App\Http\Requests\Assign as RequestsAssign;
use App\Models\Assign;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class AssignedController extends Controller
{
    /**
     * Method allData
     * Show all the resource in storage.
     *
     * @return void
     */
    public function allData()
    {
        $assign = Assign::all();
        return view('assingTable', compact('assign'));
    }


    /**
     * Method hierarchy
     *
     * @return void
     */
    public function hierarchy()
    {
        $assign = Employee::all()->where('roles_id', 1);
        return view('hierarchy', compact('assign'));
    }


    /**
     * Method index
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $assigned = Assign::all();
        $employee = Employee::all();
        $role = Role::all();
        return view('assigned', compact('assigned', 'employee', 'role'));
    }


    /**
     * Method create
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('assigned');
    }


    /**
     * Method store
     * Store a newly created resource in storage.
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function store(RequestsAssign $request)
    {
        try {

            // $request->validate([
            //     'employee_id' => 'required|unique:assigns',
            //     'position_id' => 'required',
            //     'under_employee_id' => 'required'
            // ]);

            if ($request['employee_id'] == $request['under_employee_id']) {
                // $request->session()->push('emp_same', 'You cannot Assign Same Employee under same employee');
                return redirect('/assign')->with('emp_error_msg', 'You cannot Assign Same Employee under same employee');
            } else {
                $assign = new Assign();
                $assign->employee_id = $request['employee_id'];
                $assign->position_id = $request['position_id'];
                $assign->under_employee_id = $request['under_employee_id'];
                $assign->save();

                return redirect('/assign')->with('new_assign', 'The Employee Role Has Been assigned');
            }

        } catch (\Throwable $th) {
            throw $th;
        }

    }


    /**
     * Method show
     * Display the specified resource.
     *
     * @param string $assignId [explicite description]
     *
     * @return void
     */
    public function show(string $assignId)
    {

        try {
            $assign = Assign::find($assignId);
            return view('/', compact('assign'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method edit
     * Show the form for editing the specified resource.
     *
     * @param string $assignId [explicite description]
     *
     * @return void
     */
    public function edit(string $assignId)
    {
        try {
            $assign = Assign::find($assignId);
            $allEmployee = Employee::all();
            // dd($employee);
            $editRole = Role::all();
            return view('assingEdit', compact('assign', 'allEmployee', 'editRole'));
        } catch (\Throwable $th) {
            //throw $th;
        }

    }


    /**
     * Method update
     * Update the specified resource in storage.
     *
     * @param Request $request [explicite description]
     * @param string $assignId [explicite description]
     *
     * @return void
     */
    public function update(Request $request, string $assignId)
    {

        try {

            $request->validate([
                'employee_id' => 'required',
                'position_id' => 'required',
                'under_employee_id' => 'required'
            ]);

            $assign = Assign::find($assignId);
            $assign->employee_id = $request['employee_id'];
            $assign->position_id = $request['position_id'];
            $assign->under_employee_id = $request['under_employee_id'];
            $assign->save();

            return redirect('/assign/data')->with('update_emp_msg', 'The Employee Has been updated with new Role under new Employee');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method destroy
     * Remove the specified resource from storage.
     *
     * @param string $assignId [explicite description]
     *
     * @return void
     */
    public function destroy(string $assignId)
    {
        try {
            $assign = Assign::find($assignId);
            if (!is_null($assign)) {
                $assign->delete();
            }

            return redirect()->back()->with('assign_role_delete', 'Employee Role Assigned Data Deleted Successfully');

        } catch (\Throwable $th) {
            //throw $th;
        }

    }


    /**
     * Method getUnderEmployee
     * Here I am Taking the Id of the Floor Manager and giving back the data of the Team Leader.
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getUnderEmployee(Request $request)
    {
        try {
            $roleId = $request['roleId'];
            $specificEmployee = Assign::all()->where('under_employee_id', $roleId);
            // dd($specificEmployee);

            $TLData = array();
            foreach ($specificEmployee as $value) {
                $tlId = $value->employee_id; // 3, 4

                // Send the Employee which is under this role employee only
                $TLEmployee = Employee::all()->where('id', $tlId);
                array_push($TLData, $TLEmployee);
                // dd($TLEmployee);
            }
            return response()->json([$TLData], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Method getTeamMemberData
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getTeamMemberData(Request $request)
    {
        try {
            $roleId = $request['teamMemberId']; //This id is comming from the Client Side
            $specificEmployeeTM = Assign::where('under_employee_id', $roleId)->get();
            // dd($specificEmployeeTM);

            $TMdata = [];

            foreach ($specificEmployeeTM as $value) {
                $id = $value->employee_id;
                $data2 = Employee::all()->where('id', $id);
                // dd($data2);
                // Send the Team Member Data
                array_push($TMdata, $data2);
            }
            return response()->json([$TMdata], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
