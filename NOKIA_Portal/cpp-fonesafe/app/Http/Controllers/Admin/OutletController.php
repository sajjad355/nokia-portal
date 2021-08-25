<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class OutletController extends Controller
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
        $outlet = Outlet::all();
        $params = [
            'title' => 'Store List',
            'outlet' => $outlet,
        ];
        return view('admin.store.index')->with($params);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //auto generated store code
        $last_code = DB::table('outlets')->latest('store_code')->first();
        if (!empty($last_code)) {
            $new_store_code =  str_pad((int) $last_code->store_code + 1, 4, 0, STR_PAD_LEFT);
        } else {
            $new_store_code = '0001';
        }

        $get_file_url = base_path().Storage::url('district_area.json');
        // echo  $get_file_url;die;
        //read data from file and show combo
        // $file = fopen(storage_path("whatever/file.txt"), "r");
        // while(!feof($file)){
        //     $content = fgets($file);
        //     $carray = explode('|',$content);
        //     list($fscode,$tier) = $carray;
        // }

        $params = [
            'title' => 'Create new store',
            'store_code' => $new_store_code,
            'file_location' => $get_file_url
        ];
        return view('admin.store.create')->with($params);
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
            'store_code' => 'required',
            'store_name' => 'required',
            'address' => 'required',
            'district' => 'required',
            'contact_details' => 'required|digits:11|numeric',
        ]);

        $outlet = Outlet::create([
            'store_code' => $request->input('store_code'),
            'store_name' => $request->input('store_name'),
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'area' => $request->input('area'),
            'contact_details' => $request->input('contact_details'),
        ]);

        return redirect()->route('outlet.index')->with('msg', "The store $outlet->store_name has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $outlet = Outlet::findOrFail($id);

            $params = [
                'title' => 'View Details',
                'outlet' => $outlet,
            ];

            return view('admin.store.view')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $outlet = Outlet::findOrFail($id);

            $params = [
                'title' => 'Edit Store',
                'outlet' => $outlet,
            ];

            return view('admin.store.edit')->with($params);
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
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $outlet = Outlet::findOrFail($id);

            $this->validate($request, [
                'store_code' => 'required',
                'store_name' => 'required',
                'address' => 'required',
                'district' => 'required',
                'contact_details' => 'required',
            ]);

            $outlet->store_code = $request->input('store_code');
            $outlet->store_name = $request->input('store_name');
            $outlet->address = $request->input('address');
            $outlet->district = $request->input('district');
            $outlet->area = $request->input('area');
            $outlet->contact_details = $request->input('contact_details');

            $outlet->save();

            return redirect()->route('outlet.index')->with('msg', "The store $outlet->store_name has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $outlet = Outlet::findOrFail($id);

            $outlet->delete();

            User::where('store_id', $id)->update(array('store_id' => NULL));

            return redirect()->route('outlet.index')->with('msg', "The Store $outlet->store_name has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
