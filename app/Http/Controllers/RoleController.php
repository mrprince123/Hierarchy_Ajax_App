<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role as RequestsRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    /**
     * Method index
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        try {
            $roles = Role::all();
            return view('role', compact('roles'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    /**
     * Method create
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        try {
            return view('role');
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
     * @return void
     */
    public function store(RequestsRole $request)
    {
        try {
            // $request->validate([
            //     'role_name' => 'required|unique:roles',
            //     'role_priority' => 'required|unique:roles'
            // ]);

            $role = new Role();
            $role->role_name = $request['role_name'];
            $role->role_priority = $request['role_priority'];
            $role->save();

            return redirect('/role')->with('new_role', 'New Role Created Succesfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Method show
     * Display the specified resource.
     *
     * @param string $roleId [explicite description]
     *
     * @return void
     */
    public function show(string $roleId)
    {
        try {
            $role = Role::find($roleId);
            return view('role', compact('role'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Method edit
     * Show the form for editing the specified resource.
     *
     * @param string $roleId [explicite description]
     *
     * @return void
     */
    public function edit(string $roleId)
    {
        try {
            $role = Role::find($roleId);
            return view('', compact('role'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Method update
     * Update the specified resource in storage.
     *
     * @param Request $request [explicite description]
     * @param string $roleId [explicite description]
     *
     * @return void
     */
    public function update(Request $request, string $roleId)
    {
        try {

            $request->validate([
                'role_name' => 'required',
                'role_priority' => 'required'
            ]);

            $role = Role::find($roleId);
            $role->role_name = $request['role_name'];
            $role->role_priority = $request['role_priority'];
            $role->save();

            return redirect(''); // Return it to anywhere.

        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Method destroy
     *Remove the specified resource from storage.

     * @param string $roleId [explicite description]
     *
     * @return void
     */
    public function destroy(string $roleId)
    {
        try {
            $role = Role::find($roleId);
            if (!is_null($role)) {
                $role->delete();
            }
            return redirect(''); // Redirect it to anywhere
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
