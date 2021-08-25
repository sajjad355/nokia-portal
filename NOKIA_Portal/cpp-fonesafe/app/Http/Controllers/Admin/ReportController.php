<?php

namespace App\Http\Controllers\Admin;


use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sales;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\User;
use Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Fscodes;
use App\Files;
use App\ActivationHistory;

class ReportController extends Controller
{
      public function imei_wise_delete()
    {
        $params = [
            'title' => 'IMEI Wise Delete Report'
        ];

        return view('report/imei_wise_delete')->with($params);
    }


public function imei_wise_delete_report(Request $request)
{

    $this->validate($request, [
        'imei_number' => 'required|string|min:10'
    ]);

    $imei = $request->input('imei_number');
    if (!empty($imei)) {
        $serach = DB::table('sales')
            ->select('sales.*', 'outlets.store_code', 'service_histories.created_at as service_date_1', 'service_histories.delivery_date as service_date_2', 'roles.display_name')
            ->join('outlets', 'outlets.id', '=', 'sales.store_id')
            ->join('users', 'users.store_id', '=', 'outlets.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->leftjoin('service_histories', 'service_histories.imei', '=', 'sales.imei')
            ->where('sales.imei', 'LIKE', "%{$imei}%")
            ->groupBy('sales.imei')
            ->orderByDesc('sales.id')
            ->get();
    }

    $user = User::find(Auth::user()->id);
    if ($user->hasRole('servicepoint')) {
        $log = [
            'userId' => Auth::user()->id,
            'storeId' => Auth::user()->store_id,
            'description' => 'Search report by IMEI ' . $imei
        ];

        $orderLog = new Logger('servicecenter');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
        $orderLog->info('serviceCenter', $log);
        Log::channel('searchdatewise')->info('serviceCenter', $log);

    } else if ($user->hasRole('salescenter')) {
        $log = [
            'userId' => Auth::user()->id,
            'storeId' => Auth::user()->store_id,
            'description' => 'Search report by IMEI ' . $imei
        ];

        $orderLog = new Logger('salescenter');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
        $orderLog->info('salesCenter', $log);
        Log::channel('searchdatewise')->info('salesCenter', $log);

    } else if ($user->hasRole('callcenter')) {
        $log = [
            'userId' => Auth::user()->id,
            'storeId' => Auth::user()->store_id,
            'description' => 'Search report by IMEI ' . $imei
        ];

        $orderLog = new Logger('callcenter');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
        $orderLog->info('callCenter', $log);
        Log::channel('searchdatewise')->info('callCenter', $log);

    } else {
        $log = [
            'userId' => Auth::user()->id,
            'storeId' => Auth::user()->store_id,
            'description' => 'Search report by IMEI ' . $imei
        ];

        $orderLog = new Logger('admin');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
        $orderLog->info('admin', $log);
        Log::channel('searchdatewise')->info('admin', $log);

    }

    $params = [
        'title' => 'IMEI Wise Report',
        'search_results' => $serach,
        'imei' => $imei
    ];

    return view('report/imei_wise_delete')->with($params);
}
    public function store_wise()
    {
        $outlets = Outlet::all();

        $params = [
            'title' => 'Store Wise Report',
            'outlets' => $outlets
        ];

        return view('report/store_wise')->with($params);
    }

    public function store_wise_report(Request $request)
    {
        // $this->validate($request, [
        //     'store' => 'required'
        // ]);
        $from_date = null;
        $to_date = null;
        $outlets = Outlet::all();
        if ($request->store != null && $request->input('from_date') != null && $request->input('to_date') != null) {
            // echo 'hi';die;
            $store = $request->store;
            $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
            $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59

            $get_store_fscode = DB::table('sales')
                ->select('fs_code')
                ->where('store_id', $store)
                ->whereBetween('created_at', [$from_date, $to_date])
                ->get();
        } else if ($request->store != null) {
            $get_store_fscode = DB::table('sales')
                ->select('fs_code')
                ->where('store_id', $request->store)
                ->get();
        } else if ($request->input('from_date') != null && $request->input('to_date') != null) {
            $request->store = 0;
            $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
            $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59

            $get_store_fscode = DB::table('sales')
                ->select('fs_code')
                ->whereBetween('created_at', [$from_date, $to_date])
                ->get();
        } else {
            return back()->with('msg', 'Please select at least one parameter');
        }

        $fscodes = array();
        foreach ($get_store_fscode as $key => $fs) {
            $fscodes[$key] = $fs->fs_code;
        }
        $fscode_list = "'" . implode("','", $fscodes) . "'";

        $sold_fs = DB::select('SELECT tier,COUNT(tier) as total_sold FROM fscodes WHERE fscode IN(' . $fscode_list . ') GROUP BY tier');
        $available_fs = DB::select('SELECT tier,COUNT(*) as available_fs FROM fscodes WHERE STATUS = 1 GROUP BY tier');
        $result = array();
        foreach ($sold_fs as $key => $s) {
            foreach ($available_fs as $k => $a) {
                $result[$k]['tier'] = $a->tier;
                if ($result[$k]['tier'] == $s->tier) {
                    $result[$k]['sold'] = $s->total_sold;
                }
                $result[$k]['available'] = $a->available_fs;
            }
        }

        $available_fs_bar = array();
        foreach ($available_fs as $key => $available) {
            $available_fs_bar[$key]['label'] = $available->tier;
            $available_fs_bar[$key]['y'] = $available->available_fs;
            $available_fs_bar[$key]['indexLabel'] = 'In hand-' . $available->available_fs;
        }

        $sold_fs_bar = array();
        foreach ($available_fs as $key => $a) {
            if ($sold_fs == true) {
                foreach ($sold_fs as $k => $s) {
                    $sold_fs_bar[$key]['label'] = $a->tier;
                    if ($sold_fs_bar[$key]['label'] == $s->tier) {
                        $sold_fs_bar[$key]['y'] = $s->total_sold;
                        $sold_fs_bar[$key]['indexLabel'] = 'Sold-' . $s->total_sold;
                    }
                }
            } else {
                $sold_fs_bar[$key]['label'] = $a->tier;
                $sold_fs_bar[$key]['y'] = 0;
                $sold_fs_bar[$key]['indexLabel'] = 'Sold-0';
            }
        }

        $params = [
            'title' => 'Store Wise Report',
            'results' => $result,
            'outlets' => $outlets,
            'store_id' => $request->store,
            'sold_bar' => json_encode($sold_fs_bar, JSON_NUMERIC_CHECK),
            'available_bar' => json_encode($available_fs_bar, JSON_NUMERIC_CHECK),
            'from_date' => $from_date,
            'to_date' => $to_date
        ];

        return view('report/store_wise')->with($params);
    }

    // Starts
    public function total_sale()
    {
        $outlets = Outlet::all();
        $products = json_decode('[{ "product_name": "Screen Damage Protection" }, { "product_name": "Extended Warranty" }]');

        $params = [
            'title' => 'Total Sale Report',
            'outlets' => $outlets,
            'products' => $products
        ];

        return view('report/total_sale')->with($params);
    }

    public function total_sale_report(Request $request)
    {
        $products = json_decode('[{ "product_name": "Screen Damage Protection" }, { "product_name": "Extended Warranty" }]');
        $from_date = null;
        $to_date = null;
        
        if ($request->input('service_type') != null && $request->input('from_date') != null && $request->input('to_date') != null) {
            $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
            $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59
            $result = DB::select('SELECT tier AS Tier, COUNT(*) AS SalesCount, SUM(fs_mrp) AS MRP, SUM(drp) AS DRP
            FROM sales
            LEFT JOIN phone_models ON sales.model = phone_models.model_name
            LEFT JOIN fscodes ON fscodes.fscode = sales.fs_code
            WHERE sales.created_at >= "'.$from_date.'"
            AND sales.created_at <= "'.$to_date.'"
            AND sales.service_type <= "'.$request->input('service_type').'"
            GROUP BY tier;');
        } else {
            return back()->with('msg', 'Please select service type, from date and to date.');
        }

        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);

        if($request->input('service_type') === 'Screen Damage Protection') {
            foreach ($result as $key => $available) {

                if($result[$key]['Tier'] == 'T1') {
                    $result[$key]['MRP'] = 390 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 250 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 390;
                    $result[$key]['DRP_i'] = 250;
                }
                elseif($result[$key]['Tier'] == 'T2') {
                    $result[$key]['MRP'] = 550 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 375 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 550;
                    $result[$key]['DRP_i'] = 375;
                }
                elseif($result[$key]['Tier'] == 'T3') {
                    $result[$key]['MRP'] = 740 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 500 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 740;
                    $result[$key]['DRP_i'] = 500;
                }
                elseif($result[$key]['Tier'] == 'T4') {
                    $result[$key]['MRP'] = 995 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 700 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 995;
                    $result[$key]['DRP_i'] = 700;
                }
                elseif($result[$key]['Tier'] == 'T5') {
                    $result[$key]['MRP'] = 1630 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 1185 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 1630;
                    $result[$key]['DRP_i'] = 1185;
                }
                elseif($result[$key]['Tier'] == 'T6') {
                    $result[$key]['MRP'] = 2920 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 2463 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 2920;
                    $result[$key]['DRP_i'] = 2463;
                }
                elseif($result[$key]['Tier'] == 'T7') {
                    $result[$key]['MRP'] = 3920 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 3343 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 3920;
                    $result[$key]['DRP_i'] = 3343;
                }
                elseif($result[$key]['Tier'] == 'T8') {
                    $result[$key]['MRP'] = 5180 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 4399 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 5180;
                    $result[$key]['DRP_i'] = 4399;
                }
                else {
    
                }
            }
        }
        else {
            foreach ($result as $key => $available) {

                if($result[$key]['Tier'] == 'T1') {
                    $result[$key]['MRP'] = 450 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 270 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 450;
                    $result[$key]['DRP_i'] = 270;
                }
                elseif($result[$key]['Tier'] == 'T2') {
                    $result[$key]['MRP'] = 650 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 426 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 650;
                    $result[$key]['DRP_i'] = 426;
                }
                elseif($result[$key]['Tier'] == 'T3') {
                    $result[$key]['MRP'] = 850 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 565 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 850;
                    $result[$key]['DRP_i'] = 565;
                }
                elseif($result[$key]['Tier'] == 'T4') {
                    $result[$key]['MRP'] = 1150 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 782 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 1150;
                    $result[$key]['DRP_i'] = 782;
                }
                elseif($result[$key]['Tier'] == 'T5') {
                    $result[$key]['MRP'] = 1850 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 1348 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 1850;
                    $result[$key]['DRP_i'] = 1348;
                }
                elseif($result[$key]['Tier'] == 'T6') {
                    $result[$key]['MRP'] = 2920 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 2463 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 2920;
                    $result[$key]['DRP_i'] = 2463;
                }
                elseif($result[$key]['Tier'] == 'T7') {
                    $result[$key]['MRP'] = 3920 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 3343 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 3920;
                    $result[$key]['DRP_i'] = 3343;
                }
                elseif($result[$key]['Tier'] == 'T8') {
                    $result[$key]['MRP'] = 5180 * $result[$key]['SalesCount'];
                    $result[$key]['DRP'] = 4399 * $result[$key]['SalesCount'];
                    $result[$key]['MRP_i'] = 5180;
                    $result[$key]['DRP_i'] = 4399;
                }
                else {
    
                }
            }
        }

        $params = [
            'title' => 'Total Sale Report',
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
            'results' => $result,
            'products' => $products,
            'service_type' => $request->input('service_type'),
        ];

        return view('report/total_sale')->with($params);
    }
    // ends

    public function date_wise()
    {
        $params = [
            'title' => 'Date Wise Report'
        ];

        return view('report/date_wise')->with($params);
    }


    public function date_wise_report_search(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
        $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59
        // DB::enableQueryLog();
        if ($from_date != null && $to_date != null) {
            $search_result = Db::table('sales')
                ->select('sales.*', 'outlets.store_code', 'outlets.store_name', 'roles.display_name')
                ->join('outlets', 'outlets.id', '=', 'sales.store_id')
                ->join('users', 'users.store_id', '=', 'outlets.id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereBetween('sales.created_at', [$from_date, $to_date])
                ->groupBy('sales.imei')
                ->orderByDesc('sales.id')
                ->get();
        }
        // dd(DB::getQueryLog());
        $user = User::find(Auth::user()->id);
        if ($user->hasRole('servicepoint')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise sales report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('servicecenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('serviceCenter', $log);
            Log::channel('searchdatewise')->info('serviceCenter', $log);

        } else if ($user->hasRole('salescenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise sales report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('salescenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('salesCenter', $log);
            Log::channel('searchdatewise')->info('salesCenter', $log);

        } else if ($user->hasRole('callcenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise sales report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('callcenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('callCenter', $log);
            Log::channel('searchdatewise')->info('callCenter', $log);

        } else {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise sales report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('admin');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('admin', $log);
            Log::channel('searchdatewise')->info('admin', $log);

        }


        $params = [
            'title' => 'Date Wise Report',
            'search_results' => $search_result,
            'from_date' => $from_date,
            'to_date' => $to_date
        ];

        return view('report/date_wise')->with($params);
    }


    public function date_wise_log()
    {
        $params = [
            'title' => 'Date Wise Log',
            'date' => '',
            'name' =>'',
            'error'=>'',
            'logData' =>array()
        ];

        return view('report/date_wise_log')->with($params);
    }



    public function date_wise_log_report_search(Request $request)
    {



        $filename = $request->input('log');
        $reqdate = $request->input('from_date');

        $date1=date_create($reqdate);
        $date=date_format($date1,"Y-m-d");
        $fname='';
        $logData=array();
        $err='';

        if($filename=="SMS_Log")
        {
            if(file_exists(storage_path().'/logs/'.$fname)) {

                $fname="smsdatewise-".$date.".log";
                $logData1 = file_get_contents(storage_path().'/logs/'.$fname);
                $logData = preg_split('/\n+/', $logData1);    

            } else {
                
                $err="The file does not exist";
            }
        }

        else if ($filename=="Search_Log")
        {
            if(file_exists(storage_path().'/logs/'.$fname)) {

            $fname="searchdatewise-".$date.".log";
            $logData1 = file_get_contents(storage_path().'/logs/'.$fname);
            $logData = preg_split('/\n+/', $logData1);
            }

            else {
                
                $err="The file does not exist";
            }

    
        }
        else{

        }



        $params = [
            'title' => 'Date Wise Log',
            'date' =>$date,
            'name' =>$fname,
            'logData' =>$logData
        ];

        return view('report/date_wise_log')->with($params);
    }

   

    public function imei_wise()
    {
        $params = [
            'title' => 'IMEI Wise Report'
        ];

        return view('report/imei_wise')->with($params);
    }

    public function imei_wise_report(Request $request)
    {

        $this->validate($request, [
            'imei_number' => 'required|string|min:10'
        ]);

        $imei = $request->input('imei_number');
        if (!empty($imei)) {
            $serach = DB::table('sales')
                ->select('sales.*', 'outlets.store_code', 'service_histories.created_at as service_date_1', 'service_histories.delivery_date as service_date_2', 'roles.display_name')
                ->join('outlets', 'outlets.id', '=', 'sales.store_id')
                ->join('users', 'users.store_id', '=', 'outlets.id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->leftjoin('service_histories', 'service_histories.imei', '=', 'sales.imei')
                ->where('sales.imei', 'LIKE', "%{$imei}%")
                ->groupBy('sales.imei')
                ->orderByDesc('sales.id')
                ->get();
        }

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('servicepoint')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search report by IMEI ' . $imei
            ];

            $orderLog = new Logger('servicecenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('serviceCenter', $log);
            Log::channel('searchdatewise')->info('serviceCenter', $log);

        } else if ($user->hasRole('salescenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search report by IMEI ' . $imei
            ];

            $orderLog = new Logger('salescenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('salesCenter', $log);
            Log::channel('searchdatewise')->info('salesCenter', $log);

        } else if ($user->hasRole('callcenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search report by IMEI ' . $imei
            ];

            $orderLog = new Logger('callcenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('callCenter', $log);
            Log::channel('searchdatewise')->info('callCenter', $log);

        } else {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search report by IMEI ' . $imei
            ];

            $orderLog = new Logger('admin');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('admin', $log);
            Log::channel('searchdatewise')->info('admin', $log);

        }

        $params = [
            'title' => 'IMEI Wise Report',
            'search_results' => $serach,
            'imei' => $imei
        ];

        return view('report/imei_wise')->with($params);
    }

    public function head_office()
    {
        $available_fs = DB::select('SELECT tier,COUNT(fscode) AS available FROM fscodes WHERE STATUS = 1 GROUP BY tier');
        $sold_fs = DB::select('SELECT tier,COUNT(fscode) AS sold FROM fscodes WHERE STATUS = 3 GROUP BY tier');

        $available_fs_bar = array();
        foreach ($available_fs as $key => $available) {
            $available_fs_bar[$key]['label'] = $available->tier;
            $available_fs_bar[$key]['y'] = $available->available;
            $available_fs_bar[$key]['indexLabel'] = 'In hand-' . $available->available;
        }

        $sold_fs_bar = array();
        foreach ($available_fs as $key => $a) {
            if ($sold_fs == true) {
                foreach ($sold_fs as $k => $s) {
                    $sold_fs_bar[$key]['label'] = $a->tier;
                    if ($sold_fs_bar[$key]['label'] == $s->tier) {
                        $sold_fs_bar[$key]['y'] = $s->sold;
                        $sold_fs_bar[$key]['indexLabel'] = 'Sold-' . $s->sold;
                    }
                }
            } else {
                $sold_fs_bar[$key]['label'] = $a->tier;
                $sold_fs_bar[$key]['y'] = 0;
                $sold_fs_bar[$key]['indexLabel'] = 'Sold-0';
            }
        }

        $result = array();
        foreach ($available_fs as $key => $a) {
            if ($sold_fs == true) {
                foreach ($sold_fs as $k => $s) {
                    $result[$key]['tier'] = $a->tier;
                    if ($result[$key]['tier'] == $s->tier) {
                        $result[$key]['sold'] = $s->sold;
                    }
                    $result[$key]['available'] = $a->available;
                }
            } else {
                $result[$key]['tier'] = $a->tier;
                $result[$key]['available'] = $a->available;
                $result[$key]['sold'] = 0;
            }
        }
        // echo '<pre>'; print_r($sold_fs_bar);die;
        $params = [
            'title' => 'Dashboard',
            'headline' => 'Tier wise FS status',
            'results' => $result,
            'available_bar' => json_encode($available_fs_bar, JSON_NUMERIC_CHECK),
            'sold_bar' => json_encode($sold_fs_bar, JSON_NUMERIC_CHECK)
        ];

        return view('report/head_office')->with($params);
    }

    public function display_image(Request $request)
    {
        $sales_id = $request->salesid;
        $get_image = DB::select('SELECT f.* FROM files f JOIN sales s ON s.`id`=f.`sales_id` WHERE f.`status`=1 AND s.`id`=' . $sales_id . '');
        $image_data = array();
        $data = array();
        foreach ($get_image as $key => $image) {
            $image_data[$key] = Image::make($image->file_location . $image->file_name)->exif();
            foreach ($image_data as $k => $val) {
                $data[$key] = '<img src="' . $image->file_location . $image->file_name . '" alt="Bad Format" class="img-fluid img-thumbnail"><br>' . '<p class="text-center">Date Created: ' . date("Y-m-d H:i:s", $val['FileDateTime']) . '</p><br>';
            }
        }

        // echo '<pre>'; print_r($image_data);

        return response()->json($data);
    }

    //insurance sales report
    public function insurance_sales()
    {
        $params = [
            'title' => 'Sales Report'
        ];

        return view('report/insurance_sales')->with($params);
    }

    public function insurance_sales_report(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
        $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59

        if ($from_date != null && $to_date != null) {
            $search_result = Db::table('sales')
                ->select('sales.*', 'roles.display_name')
                ->join('users', 'users.store_id', '=', 'sales.store_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereBetween('sales.created_at', [$from_date, $to_date])
                ->groupBy('sales.imei')
                ->orderByDesc('sales.id')
                ->get();
        }

        $params = [
            'title' => 'Sales Report',
            'search_results' => $search_result,
            'from_date' => $from_date,
            'to_date' => $to_date
        ];

        return view('report/insurance_sales')->with($params);
    }

    public function insurance_service()
    {
        $params = [
            'title' => 'Service/Claim Report'
        ];

        return view('report/insurance_service')->with($params);
    }

    public function insurance_service_report(Request $request)
    {

        $this->validate($request, [
            'imei_number' => 'required|string|min:10'
        ]);

        $imei = $request->input('imei_number');
        // DB::enableQueryLog();
        if (!empty($imei)) {
            $serach = DB::select("SELECT DISTINCT service_histories.imei, `sales`.`customer_name`,sales.`mobile`,sales.`email`,sales.`address`,sales.`created_at` AS sales_date, `outlets`.`store_code`,roles.`display_name` AS store_type, `service_histories`.*, `outlets`.`store_name` AS service_center_name, 
                                (SELECT outlets.`store_name` FROM outlets JOIN sales ON sales.`store_id`=outlets.`id` WHERE sales.`imei`=service_histories.imei) AS sales_center_name
                                FROM `service_histories` 
                                INNER JOIN `outlets` ON `outlets`.`id` = `service_histories`.`store_id` 
                                INNER JOIN users ON users.`store_id`=outlets.`id`
                                INNER JOIN role_user ON role_user.`user_id`=users.`id`
                                INNER JOIN roles ON roles.`id`=role_user.`role_id`
                                INNER JOIN `sales` ON `sales`.`imei` = `service_histories`.`imei` 
                                WHERE `service_histories`.`imei` LIKE '%{$imei}%' ORDER BY service_histories.`id` DESC");
        }
        // dd(DB::getQueryLog());

        // echo '<pre>'; print_r($serach);die;

        $params = [
            'title' => 'Service/Claim Report',
            'search_results' => $serach,
            'imei' => $imei
        ];

        return view('report/insurance_service')->with($params);
    }

    public function ins_display_image(Request $request)
    {
        $service_imei = $request->serviceImei;
        $get_image = DB::select('SELECT f.* FROM files f JOIN service_histories sh ON sh.`imei`=f.imei WHERE f.`status` IN(1,2,3) AND sh.imei=' . $service_imei . '');
        $image_data = array();
        $data = array();
        foreach ($get_image as $key => $image) {
            $image_data[$key] = Image::make($image->file_location . $image->file_name)->exif();
            foreach ($image_data as $k => $val) {
                $data[$key] = '<img src="' . $image->file_location . $image->file_name . '" alt="Bad Format" class="img-fluid img-thumbnail"><br>' . '<p class="text-center">Date Created: ' . date("Y-m-d H:i:s", $val['FileDateTime']) . '</p><br>';
            }
        }

        // echo '<pre>'; print_r($data);

        return response()->json($data);
    }

    public function get_date_wise_claim_report()
    {
        $user = User::find(Auth::user()->id);
        if ($user->hasRole(['supadmin', 'admin'])) {
            $params = [
                'title' => 'Service Report'
            ];
        } else {
            $params = [
                'title' => 'Date Wise Service Report'
            ];
        }

        return view('report/date_wise_claim_report')->with($params);
    }

    public function date_wise_claim_report_search(Request $request)
    {

        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $from_date =  Carbon::parse($request->input('from_date'))->startOfDay();    //00:00:00
        $to_date = Carbon::parse($request->input('to_date'))->endOfDay();   //23:59:59

        $from_date_string = "'" . $from_date . "'";
        $to_date_string = "'" . $to_date . "'";

        // DB::enableQueryLog();
        if ($from_date != null && $to_date != null) {
            $search_result = DB::select('SELECT service_histories.imei, `sales`.`customer_name`, sales.`mobile`, sales.`email`, sales.`address`, sales.`created_at` AS sales_date, roles.`display_name` AS store_type, `service_histories`.*, `outlets`.`store_code`, `outlets`.`store_name` AS service_center_name, 
                                (SELECT outlets.`store_name` FROM outlets JOIN sales ON sales.`store_id`=outlets.`id` WHERE sales.`imei`=service_histories.imei) AS sales_center_name
                                FROM `service_histories` 
                                INNER JOIN `outlets` ON `outlets`.`id` = `service_histories`.`store_id` 
                                INNER JOIN users ON users.`store_id`=outlets.`id`
                                INNER JOIN role_user ON role_user.`user_id`=users.`id`
                                INNER JOIN roles ON roles.`id`=role_user.`role_id`
                                INNER JOIN `sales` ON `sales`.`imei` = `service_histories`.`imei` 
                                WHERE `service_histories`.`created_at` BETWEEN ' . $from_date_string . ' AND ' . $to_date_string . ' group by service_histories.imei ORDER BY service_histories.`id` DESC');
        }

        // dd(DB::getQueryLog());
        // echo '<pre>';print_r($search_result);die;

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('servicepoint')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise claim report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('servicecenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('serviceCenter', $log);
            Log::channel('searchdatewise')->info('serviceCenter', $log);
 
        } else if ($user->hasRole('salescenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise claim report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('salescenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('salesCenter', $log);
            Log::channel('searchdatewise')->info('salesCenter', $log);

        } else if ($user->hasRole('callcenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise claim report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('callcenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('callCenter', $log);
            Log::channel('searchdatewise')->info('callCenter', $log);

        } else {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Date wise claim report. Date range between ' . $from_date . ' and ' . $to_date
            ];

            $orderLog = new Logger('admin');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('admin', $log);
            Log::channel('searchdatewise')->info('admin', $log);

        }

        // $user = User::find(Auth::user()->id);
        if ($user->hasRole(['supadmin', 'admin'])) {
            $params = [
                'title' => 'Service Report',
                'search_results' => $search_result,
                'from_date' => $from_date,
                'to_date' => $to_date
            ];
        } else {
            $params = [
                'title' => 'Date Wise Service Report',
                'search_results' => $search_result,
                'from_date' => $from_date,
                'to_date' => $to_date
            ];
        }

        return view('report/date_wise_claim_report')->with($params);
    }

    // public function reject_sale($id)
    // {
    //     Sales::find($id)->delete();
    //     return redirect(route('report.insurance_sales_report'))->with('successMsg', 'Successfully Deleted');
    // }

    public function delete_sale($fscode, $imei)
    {
        $message = 'Sale record has been deleted!';
        Fscodes::where('fscode', $fscode)->update(array('status' => 1, 'sale_by' => 0, 'sale_date' => ''));
        Sales::where('fs_code', $fscode)->delete();
        Files::where('imei', $imei)->delete();
        ActivationHistory::where('imei', $imei)->delete();
        return back()->with('msg', $message);
        // return redirect(route('home'));
        // return redirect()->route('ins_sales')->with('jsAlert', $message);
    }

    public function delete_sales($imei)
    {
        $message = 'Sale record has been deleted!';
        //Fscodes::where('fscode', $fscode)->update(array('status' => 1, 'sale_by' => 0, 'sale_date' => ''));
        Sales::where('imei', $imei)->delete();
        Files::where('imei', $imei)->delete();
        ActivationHistory::where('imei', $imei)->delete();
        return back()->with('msg', $message);
        // return redirect(route('home'));
        // return redirect()->route('ins_sales')->with('jsAlert', $message);
    }
}
