<?php

namespace App\Http\Controllers\Admin;

use App\BongoTvCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class BongoTvCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $bongoCodes = DB::table('bongo_tv_codes')->select('*')->get();

            $getUsageInfo = DB::table('bongo_tv_codes')->select('bongo_tv_codes.*', 'sales.mobile')
                ->join('sales', 'sales.imei', '=', 'bongo_tv_codes.imei')
                ->get();

            $data = array();
            if (count($getUsageInfo) > 0) {
                foreach ($bongoCodes as $bongoCodes_key => $codes) {
                    foreach ($getUsageInfo as $usage_key => $info) {
                        $data[$bongoCodes_key]['id'] = $codes->id;
                        $data[$bongoCodes_key]['bongo_tv_code'] = $codes->bongo_tv_code;
                        $data[$bongoCodes_key]['status'] = $codes->status;
                        $data[$bongoCodes_key]['use_date'] = $codes->use_date;
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
                    $data[$bongoCodes_key]['bongo_tv_code'] = $codes->bongo_tv_code;
                    $data[$bongoCodes_key]['status'] = $codes->status;
                    $data[$bongoCodes_key]['use_date'] = $codes->use_date;
                    $data[$bongoCodes_key]['imei'] = $codes->imei;
                    $data[$bongoCodes_key]['mobile'] = 'None';
                    $data[$bongoCodes_key]['created_at'] = $codes->created_at;
                    $data[$bongoCodes_key]['updated_at'] = $codes->updated_at;
                }
            }

            $params = [
                'title' => 'Import Bongo TV Codes',
                'bongoTvCodes' => $data
            ];
            return view('admin.bongoTvCode.index')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
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
            'bongoTvCodes' => 'required|mimes:txt'
        ]);

        $file = fopen($_FILES['bongoTvCodes']['tmp_name'], 'r');
        while (!feof($file)) {
            $content = trim(fgets($file));
            $carray = explode('|', $content);
            if (empty($carray)) {
                return back()->with('msg', 'File not formated properly. Please download the sample file');
            } else {
                foreach ($carray as $code) {
                    BongoTvCode::create([
                        'bongo_tv_code' => $code,
                        'status' => 0
                    ]);
                }
            }
        }
        return back()->with('msg', 'Bongo TV Codes imported successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BongoTvCode  $bongoTvCode
     * @return \Illuminate\Http\Response
     */
    public function show(BongoTvCode $bongoTvCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BongoTvCode  $bongoTvCode
     * @return \Illuminate\Http\Response
     */
    public function edit(BongoTvCode $bongoTvCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BongoTvCode  $bongoTvCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BongoTvCode $bongoTvCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BongoTvCode  $bongoTvCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(BongoTvCode $bongoTvCode)
    {
        //
    }

    public function destroy_unusedCodes(Request $request)
    {
        try {
            $check_unused_codes = DB::table('bongo_tv_codes')->where('status', 0)->get();
            if ($check_unused_codes->count() > 0) {
                DB::table('bongo_tv_codes')->where('status', 0)->delete();

                return redirect()->route('bongoTvCodes.index')->with('msg', "All Unused Bongo TV Codes has successfully been cleaned.");
            } else {
                return redirect()->route('bongoTvCodes.index')->with('msg', "No Unused Bongo TV Codes to clean");
            }
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
