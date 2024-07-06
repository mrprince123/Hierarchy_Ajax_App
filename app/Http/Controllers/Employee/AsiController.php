<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Assign;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class AsiController extends Controller
{
    /**
     * Method hierarchy
     *
     * @return 
     */
    public function hierarchy()
    {
        $assign = Employee::all()->where('roles_id', 1);
        return view('Employee.hierarchy', compact('assign'));
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

            $TLData = array();
            foreach ($specificEmployee as $value) {
                $tlId = $value->employee_id; // 3, 4

                // Send the Employee which is under this role employee only
                $TLEmployee = Employee::all()->where('id', $tlId);
                array_push($TLData, $TLEmployee);
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
            $TMdata = [];
            foreach ($specificEmployeeTM as $value) {
                $id = $value->employee_id;
                $data2 = Employee::all()->where('id', $id);
                // Send the Team Member Data
                array_push($TMdata, $data2);
            }
            return response()->json([$TMdata], 200);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
