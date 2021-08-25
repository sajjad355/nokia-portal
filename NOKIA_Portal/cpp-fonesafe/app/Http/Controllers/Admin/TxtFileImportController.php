<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Fscodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TxtFileImportController extends Controller
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
        try {
            $fscodes = DB::table('fscodes')->select('*')->get();

            $get_storeName = DB::table('fscodes')
                ->select('outlets.store_name')
                ->join('outlets', 'outlets.id', '=', 'fscodes.sale_by')
                ->get();

            $data = array();
            if (count($get_storeName) > 0) {
                foreach ($fscodes as $fs_key => $fscode) {
                    foreach ($get_storeName as $store_key => $name) {
                        $data[$fs_key]['id'] = $fscode->id;
                        $data[$fs_key]['fscode'] = $fscode->fscode;
                        $data[$fs_key]['tier'] = $fscode->tier;
                        $data[$fs_key]['status'] = $fscode->status;
                        $data[$fs_key]['sale_date'] = $fscode->sale_date;
                        if ($fscode->sale_by == 0) {
                            $data[$fs_key]['sale_by'] = $fscode->sale_by;
                        } else {
                            $data[$fs_key]['sale_by'] = $name->store_name;
                        }
                        $data[$fs_key]['created_at'] = $fscode->created_at;
                        $data[$fs_key]['updated_at'] = $fscode->updated_at;
                    }
                }
            } else {
                foreach ($fscodes as $fs_key => $fscode) {
                    $data[$fs_key]['id'] = $fscode->id;
                    $data[$fs_key]['fscode'] = $fscode->fscode;
                    $data[$fs_key]['tier'] = $fscode->tier;
                    $data[$fs_key]['status'] = $fscode->status;
                    $data[$fs_key]['sale_date'] = $fscode->sale_date;
                    $data[$fs_key]['sale_by'] = $fscode->sale_by;
                    $data[$fs_key]['created_at'] = $fscode->created_at;
                    $data[$fs_key]['updated_at'] = $fscode->updated_at;
                }
            }


            $params = [
                'title' => 'Import Codes',
                'fscodes' => $data
            ];
            return view('admin.txtfileimport.index')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'upload_code' => 'required|mimes:txt'
        ]);

        $file = fopen($_FILES['upload_code']['tmp_name'], 'r');
        while (!feof($file)) {
            $content = trim(fgets($file));
            $carray = explode('|', $content);
            if (count($carray) > 2) {
                return back()->with('msg', 'File not formated properly. Please download the sample file');
            } else {
                list($fscode, $tier) = $carray;
                Fscodes::updateOrCreate([
                    'fscode' => $fscode
                ], [
                    'tier' => $tier,
                    'status' => 1,
                    'sale_date' => 'None',
                    'sale_by' => 0
                ]);
            }
        }
        return back()->with('msg', 'Data imported successfully.');
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
            $fscodes = DB::table('fscodes')->select('*')->where('fscodes.id', $id)->get();

            $get_storeName = DB::table('fscodes')
                ->select('outlets.store_name')
                ->join('outlets', 'outlets.id', '=', 'fscodes.sale_by')
                ->get();

            $data = array();
            foreach ($fscodes as $fs_key => $fscode) {
                foreach ($get_storeName as $store_key => $name) {
                    $data[$fs_key]['id'] = $fscode->id;
                    $data[$fs_key]['fscode'] = $fscode->fscode;
                    $data[$fs_key]['tier'] = $fscode->tier;
                    $data[$fs_key]['status'] = $fscode->status;
                    $data[$fs_key]['sale_date'] = $fscode->sale_date;
                    if ($fscode->sale_by == 0) {
                        $data[$fs_key]['sale_by'] = $fscode->sale_by;
                    } else {
                        $data[$fs_key]['sale_by'] = $name->store_name;
                    }
                    $data[$fs_key]['created_at'] = $fscode->created_at;
                    $data[$fs_key]['updated_at'] = $fscode->updated_at;
                }
            }

            // echo '<pre>';print_r($data);die;

            $params = [
                'title' => 'View Details',
                'fscodes' => $data,
            ];

            return view('admin.txtfileimport.view')->with($params);
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
            $data = Fscodes::findOrFail($id);

            $params = [
                'title' => 'Edit record',
                'data' => $data,
            ];

            return view('admin.txtfileimport.edit')->with($params);
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
            $data = Fscodes::findOrFail($id);

            $this->validate($request, [
                'fscode' => 'required',
                'tier' => 'required',
                'status' => 'required'
            ]);

            $data->fscode = $request->input('fscode');
            $data->tier = $request->input('tier');
            $data->status = $request->input('status');
            $data->save();

            return redirect()->route('txtimport.index')->with('msg', "The Fscode $data->fscode has successfully been updated.");
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
            $data = Fscodes::findOrFail($id);

            $data->delete();

            return redirect()->route('txtimport.index')->with('msg', "The Fscode $data->fscode has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy_all(Request $request)
    {
        try {
            Fscodes::truncate();

            return redirect()->route('txtimport.index')->with('msg', "All records has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
