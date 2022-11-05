<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Fsecure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FSecureController extends Controller
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
            $bongoCodes = DB::table('fsecure')->select('*')->get();

            $getUsageInfo = DB::table('fsecure')->select('fsecure.*', 'sales.mobile')
                ->join('sales', 'sales.imei', '=', 'fsecure.imei')
                ->get();

            $data = array();
            if (count($getUsageInfo) > 0) {
                foreach ($bongoCodes as $bongoCodes_key => $codes) {
                    foreach ($getUsageInfo as $usage_key => $info) {
                        $data[$bongoCodes_key]['id'] = $codes->id;
                        $data[$bongoCodes_key]['fsecure_code'] = $codes->fsecure_code;
                        $data[$bongoCodes_key]['status'] = $codes->status;
                        $data[$bongoCodes_key]['service_type'] = $codes->service_type;
                        $data[$bongoCodes_key]['used_at'] = $codes->used_at;
                        $data[$bongoCodes_key]['imei'] = $codes->imei;
                        if ($codes->imei == null) {
                            $data[$bongoCodes_key]['mobile'] = 'None';
                        } else {
                            $data[$bongoCodes_key]['mobile'] = $info->mobile;
                        }
                        $data[$bongoCodes_key]['created_at'] = $codes->created_at;
                        $data[$bongoCodes_key]['updated_at'] = $codes->updated_at;
                    }
                }
            } else {
                foreach ($bongoCodes as $bongoCodes_key => $codes) {
                    $data[$bongoCodes_key]['id'] = $codes->id;
                    $data[$bongoCodes_key]['fsecure_code'] = $codes->fsecure_code;
                    $data[$bongoCodes_key]['status'] = $codes->status;
                    $data[$bongoCodes_key]['service_type'] = $codes->service_type;
                    $data[$bongoCodes_key]['used_at'] = $codes->used_at;
                    $data[$bongoCodes_key]['imei'] = $codes->imei;
                    $data[$bongoCodes_key]['mobile'] = 'None';
                    $data[$bongoCodes_key]['created_at'] = $codes->created_at;
                    $data[$bongoCodes_key]['updated_at'] = $codes->updated_at;
                }
            }

            $params = [
                'title' => 'Import F-Secure Codes',
                'fSecureCodes' => $data
            ];
            return view('admin.fsecure.index')->with($params);
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
                list($fsecure_code, $service_type) = $carray;
                Fsecure::updateOrCreate([
                    'fsecure_code' => $fsecure_code
                ], [
                    'service_type' => $service_type,
                    'status' => 0,
                    // 'used_at' => ''
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
            $fscodes = DB::table('fsecure')->select('*')->where('fscodes.id', $id)->get();

            $get_storeName = DB::table('fsecure')
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
            $data = FSecure::findOrFail($id);

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
            $data = FSecure::findOrFail($id);

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
            $data = FSecure::findOrFail($id);

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
            FSecure::truncate();

            return redirect()->route('txtimport.index')->with('msg', "All records has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy_unusedCodes(Request $request)
    {
        try {
            $check_unused_codes = DB::table('fsecure')->where('status', 0)->get();
            if ($check_unused_codes->count() > 0) {
                DB::table('fsecure')->where('status', 0)->delete();

                return redirect()->route('fsecure.index')->with('msg', "All Unused F-Secure Codes has successfully been cleaned.");
            } else {
                return redirect()->route('fsecure.index')->with('msg', "No Unused Bongo TV Codes to clean");
            }
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
