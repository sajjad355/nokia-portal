<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Http\Controllers\Controller;
use App\Outlet;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a=Auth::user()->updated_at;
        $date1 =  Carbon::now();
        $days = $date1->diffInDays($a);
        if($days>180){
           // Auth::logout();
            return redirect('/changed_password');
        }
        else{
        $users = DB::table('users')
            ->select('users.*', 'outlets.store_name', 'roles.display_name')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->leftjoin('outlets', 'outlets.id', '=', 'users.store_id')
            ->get();

        $params = [
            'title' => 'Users List',
            'users' => $users,
        ];

        return view('admin.users.users_list')->with($params);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $stores = Outlet::all();

        $params = [
            'title' => 'Create User',
            'roles' => $roles,
            'stores' => $stores,
        ];

        return view('admin.users.users_create')->with($params);
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'store_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'store_id' => $request->input('store_id'),
        ]);

        $role = Role::find($request->input('role_id'));

        $user->attachRole($role);

        return redirect()->route('users.index')->with('msg', "The user $user->name has successfully been created.");
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
            $users = DB::table('users')
                ->select('users.*', 'outlets.store_name', 'roles.display_name')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->leftjoin('outlets', 'outlets.id', '=', 'users.store_id')
                ->where('users.id', '=', $id)
                ->get();

            $params = [
                'title' => 'Confirm Delete Record',
                'users' => $users,
            ];

            return view('admin.users.users_view')->with($params);
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
            $users = DB::table('users')
                ->select('users.*', 'outlets.store_name', 'roles.display_name', 'roles.id as role_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->leftjoin('outlets', 'outlets.id', '=', 'users.store_id')
                ->where('users.id', '=', $id)
                ->get();

            $roles = Role::all();
            $stores = Outlet::all();
            // $roles = Role::with('permissions')->get();
            // $permissions = Permission::all();

            $params = [
                'title' => 'Edit User',
                'users' => $users,
                'roles' => $roles,
                'stores' => $stores,
            ];

            return view('admin.users.users_edit')->with($params);
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
            $user = User::findOrFail($id);

            $this->validate($request, [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|',
                'store_id' => 'required',
                'role_id' => 'required',
            ]);

            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->store_id = $request->input('store_id');

            $user->save();

            // Update role of the user
            $roles = $user->roles;

            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }

            $role = Role::find($request->input('role_id'));

            $user->attachRole($role);

            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);

            return redirect()->route('users.index')->with('msg', "The user $user->name has successfully been updated.");
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
            $user = User::findOrFail($id);

            // Detach from Role
            $roles = $user->roles;

            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }

            $user->delete();
            // if($user->store_id != null){
            //     Outlet::where('id', '=', $user->store_id)->delete();
            // }

            return redirect()->route('users.index')->with('msg', "The user $user->name has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function get_bulk_user_creation_view()
    {
        $params = [
            'title' => 'Create Bulk User'
        ];

        return view('admin.users.bulk_user_creation')->with($params);
    }

    public function bulk_user_creation(Request $request)
    {

        $this->validate($request, [
            'upload_user' => 'required|mimes:txt'
        ]);

        $file = fopen($_FILES['upload_user']['tmp_name'], 'r');
        while (!feof($file)) {
            $content = trim(fgets($file));
            $carray = explode('|', $content);
            // echo '<pre>'; print_r($carray);die;
            if (count($carray) > 7) {
                return back()->with('msg', 'File not formated properly. Please download the sample file');
            } else {
                list($store_name, $user_id, $password, $store_address, $contact_number, $area, $role) = $carray;

                //auto generated store code
                $last_code = DB::table('outlets')->latest('store_code')->first();
                if (!empty($last_code)) {
                    $new_store_code =  str_pad((int) $last_code->store_code + 1, 4, 0, STR_PAD_LEFT);
                } else {
                    $new_store_code = '0001';
                }

                $store = Outlet::updateOrCreate([
                    'store_name' => $store_name
                ], [
                    'store_code' => $new_store_code,
                    'address' => $store_address,
                    'district' => $area,
                    'contact_details' => $contact_number
                ]);

                // generate random 8 char password from below chars
                // $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                // $password = substr($random, 0, 8);

                $user = User::updateOrCreate([
                    'username' => $user_id
                ], [
                    'name' => $store_name,
                    'password' => Hash::make($password),
                    'store_id' => $store->id
                ]);

                $find_role = Role::find($role);

                $user->attachRole($find_role);
            }
        }
        return back()->with('msg', 'Data imported successfully.');
    }
}
