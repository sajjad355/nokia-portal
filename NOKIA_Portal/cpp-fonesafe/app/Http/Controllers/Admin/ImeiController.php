<?php

namespace App\Http\Controllers\Admin;

use App\Imei;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ImeiController extends Controller
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
            $imeis = DB::table('imeis')->select('*')->get();

            $get_storeName = DB::table('imeis')
                ->select('outlets.store_name')
                ->join('outlets', 'outlets.id', '=', 'imeis.sale_by')
                ->get();

            $data = array();
            if (count($get_storeName) > 0) {
                foreach ($imeis as $imei_key => $imei) {
                    foreach ($get_storeName as $store_key => $name) {
                        $data[$imei_key]['id'] = $imei->id;
                        $data[$imei_key]['imei'] = $imei->imei;
                        $data[$imei_key]['brand'] = $imei->brand;
                        $data[$imei_key]['model'] = $imei->model;
                        $data[$imei_key]['device_price'] = $imei->device_price;
                        $data[$imei_key]['status'] = $imei->status;
                        $data[$imei_key]['sale_date'] = $imei->sale_date;
                        if ($imei->sale_by == 0) {
                            $data[$imei_key]['sale_by'] = $imei->sale_by;
                        } else {
                            $data[$imei_key]['sale_by'] = $name->store_name;
                        }
                        $data[$imei_key]['created_at'] = $imei->created_at;
                        $data[$imei_key]['updated_at'] = $imei->updated_at;
                    }
                }
            } else {
                foreach ($imeis as $imei_key => $imei) {
                    $data[$imei_key]['id'] = $imei->id;
                    $data[$imei_key]['imei'] = $imei->imei;
                    $data[$imei_key]['brand'] = $imei->brand;
                    $data[$imei_key]['model'] = $imei->model;
                    $data[$imei_key]['device_price'] = $imei->device_price;
                    $data[$imei_key]['status'] = $imei->status;
                    $data[$imei_key]['sale_date'] = $imei->sale_date;
                    $data[$imei_key]['sale_by'] = $imei->sale_by;
                    $data[$imei_key]['created_at'] = $imei->created_at;
                    $data[$imei_key]['updated_at'] = $imei->updated_at;
                }
            }


            $params = [
                'title' => 'Import IMEI',
                'imeis' => $data
            ];
            return view('admin.imei_import.index')->with($params);
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
            'imei_import' => 'required|mimes:txt'
        ]);

        $file = fopen($_FILES['imei_import']['tmp_name'], 'r');
        while (!feof($file)) {
            $content = trim(fgets($file));
            $carray = explode('|', $content);
            if (count($carray) > 3) {
                return back()->with('msg', 'File not formated properly. Please download the sample file');
            } else {
                list($brand, $model, $imei) = $carray;
                Imei::updateOrCreate([
                    'imei' => $imei
                ], [
                    'brand' => $brand,
                    'model' => $model,
                    // 'device_price' => $device_price,
                    'status' => 1,
                    'sale_date' => 'None',
                    'sale_by' => 0
                ]);
            }
        }
        return back()->with('msg', 'IMEI imported successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Imei  $imei
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $imeis = DB::table('imeis')->select('*')->where('imeis.id', $id)->get();

            $get_storeName = DB::table('imeis')
                ->select('outlets.store_name')
                ->join('outlets', 'outlets.id', '=', 'imeis.sale_by')
                ->get();

            $data = array();
            foreach ($imeis as $imei_key => $imei) {
                foreach ($get_storeName as $store_key => $name) {
                    $data[$imei_key]['id'] = $imei->id;
                    $data[$imei_key]['imei'] = $imei->imei;
                    $data[$imei_key]['model'] = $imei->model;
                    $data[$imei_key]['device_price'] = $imei->device_price;
                    $data[$imei_key]['status'] = $imei->status;
                    $data[$imei_key]['sale_date'] = $imei->sale_date;
                    if ($imei->sale_by == 0) {
                        $data[$imei_key]['sale_by'] = $imei->sale_by;
                    } else {
                        $data[$imei_key]['sale_by'] = $name->store_name;
                    }
                    $data[$imei_key]['created_at'] = $imei->created_at;
                    $data[$imei_key]['updated_at'] = $imei->updated_at;
                }
            }

            echo '<pre>';print_r($data);die;

            $params = [
                'title' => 'View Details',
                'imeis' => $data,
            ];

            return view('admin.imei_import.view')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imei  $imei
     * @return \Illuminate\Http\Response
     */
    public function edit(Imei $imei)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imei  $imei
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imei $imei)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imei  $imei
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imei $imei)
    {
        //
    }
}
