<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        $params = [
            'title' => 'Roles Listing',
            'roles' => $roles,
        ];

        return view('admin.roles.roles_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        $params = [
            'title' => 'Create Role',
            'permissions' => $permissions
        ];

        return view('admin.roles.roles_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        //dd($request->input('permission'));

        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        // Permission::create([
        //     'permission_id' => $request->input('permission'),
        //     'role_id'=>$role->id
        // ]);

        // $user = new User();

        // $user->roles()->attach([$role->id]);
        // $user->permissions()->attach([$role->id]);
        // $permission = $request->input('permission');
        // foreach ($request->input('permission') as $key => $value) {
        //     $role->permissions()->attach([$value]);
        // }
        // foreach ($request->input('permission') as $key => $value) {
        // Permission::insert([
        //     'permission_id' => $value,
        //     'role_id'=>$role->id,
        // ]);
        // }

        // $role->permissions()->attach([$permission]);

        return redirect()->route('roles.index')->with('success', "The role $role->name has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $roles = Role::findOrFail($id);

            $params = [
                'title' => 'Details',
                'roles' => $roles,
            ];

            return view('admin.roles.roles_view')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);
            // $permissions = Permission::all();
            // $role_permissions = $role->permissions()->get()->pluck('id')->toArray();

            $params = [
                'title' => 'Edit Role',
                'roles' => $role,
            ];

            return view('admin.roles.roles_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);

            $this->validate($request, [
                'role_name' => 'required',
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $role->name = $request->input('role_name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');

            $role->save();

            // DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
            // // Attach permission to role
            // foreach ($request->input('permission_id') as $key => $value) {
            //     $role->attachPermission($value);
            // }

            return redirect()->route('roles.index')->with('msg', "The role $role->name has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);

            //$role->delete();

            // Force Delete
            // $role->users()->sync([]); // Delete relationship data
            // $role->permissions()->sync([]); // Delete relationship data

            // $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

            return redirect()->route('roles.index')->with('success', "The Role $role->name has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
