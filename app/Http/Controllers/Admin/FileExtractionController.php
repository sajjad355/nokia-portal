<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class FileExtractionController extends Controller
{

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
             $params = [
            'title' => 'Data Extraction'
        ];
        return view('admin.fileExtraction.extract_file')->with($params);
    }
    }

    public function fileExtraction(Request $request)
    {
        try {

            $this->validate($request, [
                'from_date' => 'required',
                'to_date' => 'required'
            ]);

            $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
            $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59

            if ($from_date != null && $to_date != null) {
                $get_data = DB::table('sales')
                    ->select('sales.*', 'outlets.store_name', 'fscodes.tier')
                    ->join('fscodes', 'fscodes.fscode', '=', 'sales.fs_code')
                    ->join('outlets', 'outlets.id', '=', 'sales.store_id')
                    ->whereBetween('sales.created_at', [$from_date, $to_date])
                    ->get();
            }
            if ($get_data->count() > 0) {
                $data = array();
                foreach ($get_data as $key => $value) {
                    $data[$key]['record_type'] = 'APP';
                    $data[$key]['ext_source_code'] = 'FIX';
                    $data[$key]['ext_campign'] = 1006;
                    $data[$key]['payment_type'] = 'BP COLLECTION';
                    $data[$key]['card_number'] = '';
                    $data[$key]['card_expiry_date'] = '';
                    $data[$key]['external_product'] = $value->tier;
                    $data[$key]['rate'] = '';
                    $data[$key]['pacchold'] = '';
                    $data[$key]['title'] = $value->title;
                    $data[$key]['forename'] = '';
                    $data[$key]['surname'] = $value->customer_name;
                    $data[$key]['dob'] = $value->date_of_birth;
                    $data[$key]['sex'] = $value->gender;
                    $data[$key]['company_name'] = '1000Fix';
                    $data[$key]['home_tel'] = '';
                    $data[$key]['work_tel'] = '';
                    $data[$key]['mobile_tel'] = $value->mobile;
                    $data[$key]['email'] = $value->email;
                    $data[$key]['address_line_1'] = $value->address;
                    $data[$key]['address_line_2'] = '';
                    $data[$key]['address_line_3'] = '';
                    $data[$key]['town'] = $value->district;
                    $data[$key]['post_code'] = 9876;
                    $data[$key]['state'] = '';
                    $data[$key]['country'] = 'BANGLADESH';
                    $data[$key]['pan_number'] = '';
                    $data[$key]['ext_pol_num'] = '';
                    $data[$key]['person_2_title'] = '';
                    $data[$key]['person_2_forename'] = '';
                    $data[$key]['person_2_surname'] = '';
                    $data[$key]['person_2_dob'] = '';
                    $data[$key]['mobile_type'] = 'PHONE';
                    $data[$key]['mobile_brand'] = $value->brand;
                    $data[$key]['mobile_model'] = $value->model;
                    $data[$key]['imei_number'] = $value->imei;
                    $data[$key]['dealer_name'] = $value->store_name;
                    $data[$key]['invoice_date'] = $value->created_at;
                }

                $result = array();
                foreach ($data as $key => $val) {
                    $result[$key] = preg_replace( "/\r|\n/", "", implode('|', $val) )."\n";
                }
                $result[] = array_unshift($result, "H\n");
                $result[count($result)-1] = "T";
                
                Storage::put('public/extract.txt', $result);
                $filename = 'extract.txt';
                return response()->download(storage_path("app/public/{$filename}"));
            }else{
                return back()->with('msg', 'No data available in this date range');
            }
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
