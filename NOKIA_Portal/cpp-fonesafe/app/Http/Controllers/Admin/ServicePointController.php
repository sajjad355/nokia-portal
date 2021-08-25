<?php

namespace App\Http\Controllers\Admin;

use App\ActivationHistory;
use App\BongoTvCode;
use App\Files;
use App\ServicePoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ReceiveDeliveryHistory;
use App\Sale;
use App\Sales;
use App\ServiceHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\User;
use Intervention\Image\Facades\Image;
use SslWireless\SslWirelessSms;
use Tzsk\Otp\Facades\Otp;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ServicePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = DB::table('outlets')
            ->select('outlets.store_name')
            ->where('outlets.id', Auth::user()->store_id)
            ->get();

        $params = [
            'title' => 'EERNA',
            'outlet_name' => $outlet
        ];

        return view('servicepoint.index')->with($params);
    }

    public function search(Request $request)
    {

        $this->validate($request, [
            'imei_number' => 'required|string|regex:/^[a-zA-Z0-9_\-]*$/|max:15|min:15'
        ]);

        $imei = $request->input('imei_number');
        if (!empty($imei)) {
            $serach = DB::table('sales')->select('*')->where('imei', '=', "$imei")->get();
        }

        $search_result = array();
        foreach ($serach as $result) {
            $search_result = $result;
        }

        $days = 0;
        if (!empty($search_result)) {
            $now = date('Y-m-d H:i:s');
            $fdate = $search_result->created_at;
            $tdate = $now;
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
        }

        $outlet = DB::table('outlets')
            ->select('outlets.store_name')
            ->where('outlets.id', Auth::user()->store_id)
            ->get();


        if (!empty($imei)) {
            $get_history = DB::table('service_histories')->select('*')->where('imei', '=', "$imei")->get();
        }

        $delivery_status = '';
        foreach ($get_history as $history) {
            $delivery_status = $history->status;
        }

        $get_activation_history = $get_history = DB::table('activation_histories')
            ->select('*', 'outlets.store_name')
            ->join('outlets', 'outlets.id', '=', 'activation_histories.store_id')
            ->where('imei', '=', "$imei")
            ->where('status', '=', 1)
            ->get();

        $activation_status = '';
        foreach ($get_activation_history as $activation_history) {
            $activation_status = $activation_history->status;
        }

        $get_receive_history = DB::table('receive_delivery_histories')->select('receive_delivery_histories.created_at', 'outlets.store_name')
            ->join('outlets', 'outlets.id', '=', 'receive_delivery_histories.store_id')
            ->where('imei', '=', "$imei")
            ->where('status', '=', 2)
            ->get();

        $get_delivery_history = DB::table('receive_delivery_histories')->select('receive_delivery_histories.created_at', 'outlets.store_name')
            ->join('outlets', 'outlets.id', '=', 'receive_delivery_histories.store_id')
            ->where('imei', '=', "$imei")
            ->where('status', '=', 3)
            ->get();


        if (!empty($imei)) {
            $get_sale_center_info = DB::table('sales')
                ->select('sales.store_id', 'roles.name')
                ->join('users', 'users.store_id', '=', 'sales.store_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('imei', '=', "$imei")
                ->get();
        }

        $info_result = array();
        foreach ($get_sale_center_info as $sale_center_info) {
            if ($sale_center_info->name == 'servicepoint') {
                $info_result = 1;
            } else {
                $info_result = 0;
            }
        }

        if (!empty($imei)) {
            $get_purchase_history = DB::table('sales')
                ->select('sales.store_id', 'outlets.store_name')
                ->join('outlets', 'outlets.id', '=', 'sales.store_id')
                ->where('imei', '=', "$imei")
                ->get();
        }

        $purchase_center = array();
        foreach ($get_purchase_history as $purchase_history) {
            $purchase_center = $purchase_history->store_name;
        }

        if (!empty($imei)) {
            $get_bongoTvCode_history = DB::table('bongo_tv_codes')
                ->select('bongo_tv_code')
                ->where('imei', '=', $imei)
                ->get();
        }

        $bongoTvCodes_array = array();
        foreach ($get_bongoTvCode_history as $key => $codes) {
            $bongoTvCodes_array[$key] = $codes->bongo_tv_code;
        }

        if (count($bongoTvCodes_array) > 0) {
            $bongoTvCodes = implode(' | ', $bongoTvCodes_array);
        } else {
            $bongoTvCodes = '';
        }
        // echo '<pre>';print_r($bongoTvCodes);die;

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('servicepoint')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search by IMEI ' . $imei
            ];

            $orderLog = new Logger('servicecenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('serviceCenter', $log);
        } else if ($user->hasRole('salescenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search by IMEI ' . $imei
            ];

            $orderLog = new Logger('salescenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('salesCenter', $log);
        } else if ($user->hasRole('callcenter')) {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search by IMEI ' . $imei
            ];

            $orderLog = new Logger('callcenter');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('callCenter', $log);
        } else {
            $log = [
                'userId' => Auth::user()->id,
                'storeId' => Auth::user()->store_id,
                'description' => 'Search by IMEI ' . $imei
            ];

            $orderLog = new Logger('admin');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
            $orderLog->info('admin', $log);
        }

        $params = [
            'title' => 'Huawei mobile Don’t Worry',
            'search_results' => $search_result,
            'days' => $days,
            'outlet_name' => $outlet,
            'deliveryStatus' => $delivery_status,
            'receive_history' => $get_receive_history,
            'delivery_history' => $get_delivery_history,
            'sale_center' => $info_result,
            'purchase_center_name' => $purchase_center,
            'activation_status' => $activation_status,
            'activation_history' => $get_activation_history,
            'bongo_tv_codes' => $bongoTvCodes
        ];

        if ($days <= '365' && $delivery_status == 2) {
            return view('servicepoint.delivery')->with($params);
        } elseif ($days <= '365' && $delivery_status == 3) {
            return view('servicepoint.delivery')->with($params);
        } elseif ($days > '365' && $days <= '730' && $delivery_status == 2) {
            return view('servicepoint.delivery')->with($params);
        } elseif ($days > '365' && $days <= '730' && $delivery_status == 3) {
            return view('servicepoint.index')->with($params);
        } else {
            return view('servicepoint.index')->with($params);
        }
    }

    public function search_by_phone_number(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|string|digits:11'
        ]);

        $user = User::find(Auth::user()->id);

        $phone = $request->input('phone_number');

        if (!empty($phone)) {
            $search = DB::table('sales')->select('*')->where('mobile', '=', "$phone")->orWhere('emergency_contact', '=', "$phone")->get();

            $outlet = DB::table('outlets')
                ->select('outlets.store_name')
                ->where('outlets.id', Auth::user()->store_id)
                ->get();

            if ($search->count() > 0) {
                if ($user->hasRole('servicepoint')) {
                    $unique_secret = 'jklsothnb0ksmfj.gkqmdp0spntxp;12aslpelmc';
                    $otp = Otp::generate($unique_secret);

                    // username, password, sid provided by sslwireless
                    $username = env("SMS_USERNAME", null);
                    $password = env("SMS_PASSWORD", null);
                    $sid = env("SMS_SID", null);

                    if (isset($otp)) {
                        $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                        // // You can change the api url if needed. i.e.
                        // $SslWirelessSms->setUrl('new_url');
                        // $SslWirelessSms->send($request->mobile, 'Thank you for purchase. Your Fscode is: ' . $request->fs_code . '.MRP(including VAT) TK ' . $request->mrp . '');
                        $SslWirelessSms->send($phone, 'Your OTP is ' . $otp . '. This OTP will be expired within 3 minutes.');
                        // dd($output);
                    }

                    $params = [
                        'title' => 'Huawei mobile Don’t Worry',
                        'phone_number' => $phone,
                        'outlet_name' => $outlet,
                        'otp' => $otp
                    ];

                    $log = [
                        'userId' => Auth::user()->id,
                        'storeId' => Auth::user()->store_id,
                        'description' => 'Search by phone number ' . $phone
                    ];

                    $orderLog = new Logger('servicecenter');
                    $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
                    $orderLog->info('serviceCenter', $log);

                    return view('servicepoint.otpVerify')->with($params);
                } else {

                    $params = [
                        'title' => 'Huawei mobile Don’t Worry',
                        'outlet_name' => $outlet,
                        'search_results' => $search,
                    ];

                    $log = [
                        'userId' => Auth::user()->id,
                        'storeId' => Auth::user()->store_id,
                        'description' => 'Search by phone number ' . $phone
                    ];

                    $orderLog = new Logger('callcenter');
                    $orderLog->pushHandler(new StreamHandler(storage_path('logs/search.log')), Logger::INFO);
                    $orderLog->info('callCenter', $log);

                    return view('servicepoint.search_by_phone')->with($params);
                }
            } else {

                $params = [
                    'title' => 'Huawei mobile Don’t Worry',
                    'phone_number' => $phone,
                    'outlet_name' => $outlet,
                    'search_results' => $search,
                ];

                return view('servicepoint.search_by_phone')->with($params);
            }
        }
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required|numeric|digits:4'
        ]);

        $otp = $request->input('otp');
        $phone = $request->input('phone_number');

        $unique_secret = 'jklsothnb0ksmfj.gkqmdp0spntxp;12aslpelmc';
        $valid = Otp::match($otp, $unique_secret);

        if ($valid == true) {

            if (!empty($phone)) {
                $search = DB::table('sales')->select('*')->where('mobile', '=', "$phone")->orWhere('emergency_contact', '=', "$phone")->get();
            }

            $outlet = DB::table('outlets')
                ->select('outlets.store_name')
                ->where('outlets.id', Auth::user()->store_id)
                ->get();

            $params = [
                'title' => 'Huawei mobile Don’t Worry',
                'outlet_name' => $outlet,
                'search_results' => $search,
            ];

            return view('servicepoint.search_by_phone')->with($params);
        } else {

            $outlet = DB::table('outlets')
                ->select('outlets.store_name')
                ->where('outlets.id', Auth::user()->store_id)
                ->get();

            $params = [
                'title' => 'Huawei mobile Don’t Worry',
                'outlet_name' => $outlet,
                'phone_number' => $phone
            ];

            $request->session()->flash('invalidOtpMsg', 'Not verified. Please try again.');

            return view('servicepoint.index')->with($params);
        }
    }

    public function search_by_serviceType(Request $request)
    {

        $this->validate($request, [
            'service_type' => 'required'
        ]);

        $service_type = $request->input('service_type');
        if (!empty($service_type)) {
            $search = DB::table('sales')->select('*')->where('service_type', '=', "$service_type")->get();
        }

        $outlet = DB::table('outlets')
            ->select('outlets.store_name')
            ->where('outlets.id', Auth::user()->store_id)
            ->get();

        $params = [
            'title' => 'Huawei mobile Don’t Worry',
            'outlet_name' => $outlet,
            'search_results' => $search,
        ];


        return view('servicepoint.search_by_service_type')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('servicepoint')) {
            $this->validate($request, [
                'fs_code' => 'required',
                'image' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'fs_code' => 'required'
            ]);
        }

        if (Auth::user()->store_id != null) {

            if ($user->hasRole('servicepoint')) {
                $service_history = ServiceHistory::create([
                    'store_id' => Auth::user()->store_id,
                    'imei' => $request->input('imei_number'),
                    'model' => $request->input('model'),
                    'price' => $request->input('price'),
                    'fs_code' => $request->input('fs_code'),
                    'purchase_date' => $request->input('purchase_date'),
                    'status' => 2,      //handset receive
                ]);

                ReceiveDeliveryHistory::create([
                    'store_id' => Auth::user()->store_id,
                    'imei' => $request->input('imei_number'),
                    'status' => 2,      //handset receive
                ]);

                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $key => $image) {
                        $extension = $image->getClientOriginalExtension();
                        $name = $image->getClientOriginalName();
                        $filename = time() . '_' . $name;
                        $fileLocation = 'uploads/services/';
                        $new_img = Image::make($image->getRealPath())->resize(600, 600);
                        // save file with medium quality
                        $new_img->save($fileLocation . $filename, 90);
                        // $image->move($fileLocation, $filename);
                        $data[$key]['file_name'] = $filename;
                        $data[$key]['file_for'] = 'receive';
                        $data[$key]['file_type'] = 'image';
                        $data[$key]['upload_by'] = Auth::user()->id;
                        $data[$key]['status'] = 2;  //2=service taken
                        $data[$key]['file_location'] = $fileLocation;
                        $data[$key]['sales_id'] = $service_history->id; //last inserted id
                        $data[$key]['imei'] = $request->input('imei_number'); //requested IMEI number
                        $data[$key]['created_at'] = Carbon::now();
                        $data[$key]['updated_at'] = Carbon::now();
                    }
                    Files::insert($data);
                }

                if (isset($_POST)) {
                    // username, password, sid provided by sslwireless
                    $username = env("SMS_USERNAME", null);
                    $password = env("SMS_PASSWORD", null);
                    $sid = env("SMS_SID", null);

                    if ($request->mobile_number != null) {
                        $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                        // // You can change the api url if needed. i.e.
                        // $SslWirelessSms->setUrl('new_url');
                        // $SslWirelessSms->send($request->mobile, 'Thank you for purchase. Your Fscode is: ' . $request->fs_code . '.MRP(including VAT) TK ' . $request->mrp . '');
                      
/*                          $service_type=DB::table('sales')
                        ->select('service_type')
                        ->Where('imei', $request->imei_number);  */
                       /* $service_type="18 Months Warranty";

                        if($service_type=="Screen Damage Protection")
                        {
                            $output= $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been received at ($request->service_center_name) for repair under Eerna Protect Screen Protection Plan. Thank you");
                        }
         
                        elseif($service_type=="Entended Warranty")
                        {
                            $output= $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been received at ($request->service_center_name) for repair under Eerna Protect Extended Warranty plan. Thank you") ;
                        }
                        elseif($service_type=="18 Months Warranty")
                        {
                            $output= $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been received at ($request->service_center_name) for repair under Eerna Protect Extended Warranty plan. Thank you. ") ;

                        } 
                        */
                        
                        
                        $output = $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been receive at ($request->service_center_name) for repair. Thank you");
                        // dd($output);

                        $log = [
                            'userId' => Auth::user()->id,
                            'description' => $output
                        ];

                        $orderLog = new Logger('handsetreceive');
                        $orderLog->pushHandler(new StreamHandler(storage_path('logs/sms.log')), Logger::INFO);
                        $orderLog->info('serviceCenter', $log);
                    }
                }

                return back()->with('msg', "The phone with IMEI $service_history->imei has successfully been received.");
            } else {
                $activation_history = ActivationHistory::create([
                    'store_id' => Auth::user()->store_id,
                    'imei' => $request->input('imei_number'),
                    'model' => $request->input('model'),
                    'price' => $request->input('price'),
                    'fs_code' => $request->input('fs_code'),
                    'purchase_date' => $request->input('purchase_date'),
                    'status' => 1,      //activation for call center
                ]);

                $get_bongoTvCodes = DB::table('bongo_tv_codes')->select('bongo_tv_code')->where('status', 0)->limit(3)->get();
                $bongoTvCodes = array();
                foreach ($get_bongoTvCodes as $key => $codes) {
                    $bongoTvCodes[$key] = $codes->bongo_tv_code;
                }
                $smsBongoTvCodes = implode('|', $bongoTvCodes);
                // DB::enableQueryLog();
                BongoTvCode::whereIn('bongo_tv_code', $bongoTvCodes)->update(array('status' => 1, 'use_date' => Carbon::now(), 'imei' => $request->input('imei_number')));
                // echo '<pre>'; print_r($smsBongoTvCodes);die;
                // dd(DB::getQueryLog());

                if (isset($_POST)) {
                    // username, password, sid provided by sslwireless
                    $username = env("SMS_USERNAME", null);
                    $password = env("SMS_PASSWORD", null);
                    $sid = env("SMS_SID", null);

                    if ($request->mobile_number != null) {
                        $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                        // // You can change the api url if needed. i.e.
                        // $SslWirelessSms->setUrl('new_url');
                        // $SslWirelessSms->send($request->mobile, 'Thank you for purchase. Your Fscode is: ' . $request->fs_code . '.MRP(including VAT) TK ' . $request->mrp . '');
                       // $output = $SslWirelessSms->send($request->mobile_number, "Your Huawei Don/'t worry membership for 01 year is now active. Bongo TV codes are: " . $smsBongoTvCodes . ". Thank you.");
                        // dd($output);

                        $log = [
                            'userId' => Auth::user()->id,
                            'description' => $output
                        ];

                        $orderLog = new Logger('activation');
                        $orderLog->pushHandler(new StreamHandler(storage_path('logs/sms.log')), Logger::INFO);
                        $orderLog->info('callCenter', $log);
                    }
                }

                return back()->with('msg', "The phone with IMEI $activation_history->imei has successfully been activated.");
            }
        } else {
            return back()->with('msg', "Please login as a service center");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServicePoint  $servicePoint
     * @return \Illuminate\Http\Response
     */
    public function show(ServicePoint $servicePoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServicePoint  $servicePoint
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicePoint $servicePoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServicePoint  $servicePoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicePoint $servicePoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServicePoint  $servicePoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePoint $servicePoint)
    {
        //
    }

    public function handset_delivery(Request $request)
    {
        $this->validate($request, [
            'imei_number' => 'required|string|digits:15',
            'image' => 'required',
        ]);

        $get_history = DB::table('service_histories')->select('id')->where('imei', '=', "$request->imei_number")->get();
        $history_id = '';
        foreach ($get_history as $history) {
            $history_id = $history->id;
        }

        ServiceHistory::where('imei', $request->imei_number)->update(array('status' => 3, 'delivery_date' => Carbon::now()));

        ReceiveDeliveryHistory::create([
            'store_id' => Auth::user()->store_id,
            'imei' => $request->input('imei_number'),
            'status' => 3,      //handset delivered
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $filename = time() . '_' . $name;
                $fileLocation = 'uploads/delivery/';
                $new_img = Image::make($image->getRealPath())->resize(600, 600);
                // save file with medium quality
                $new_img->save($fileLocation . $filename, 90);
                // $image->move($fileLocation, $filename);
                $data[$key]['file_name'] = $filename;
                $data[$key]['file_for'] = 'delivery';
                $data[$key]['file_type'] = 'image';
                $data[$key]['upload_by'] = Auth::user()->id;
                $data[$key]['status'] = 3;  //3=handset delivered
                $data[$key]['file_location'] = $fileLocation;
                $data[$key]['sales_id'] = $history_id; //updated history id
                $data[$key]['imei'] = $request->imei_number; //requested IMEI number
                $data[$key]['created_at'] = Carbon::now();
                $data[$key]['updated_at'] = Carbon::now();
            }
            Files::insert($data);

            if (isset($_POST)) {
                // username, password, sid provided by sslwireless
                $username = env("SMS_USERNAME", null);
                $password = env("SMS_PASSWORD", null);
                $sid = env("SMS_SID", null);

                if ($request->mobile_number != null) {
                    $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                    // // You can change the api url if needed. i.e.
                    // $SslWirelessSms->setUrl('new_url');
                    // $SslWirelessSms->send($request->mobile, 'Thank you for purchase. Your Fscode is: ' . $request->fs_code . '.MRP(including VAT) TK ' . $request->mrp . '');
                  
/*                          $service_type=DB::table('sales')
                        ->select('service_type')
                        ->Where('imei', $request->imei_number);   */
/*
                    $service_type="18 Months Warranty";
                    if($service_type=="Screen Damage Protection")
                    {
                      $output=  $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired under Eerna Protect Screen Protection Plan & delivered. Thank you.");
                    }
     
                    elseif($service_type=="Entended Warranty")
                    {
                      $output=  $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired under Eerna Protect Extended Warranty plan & delivered. Thank you.") ;
                    }
                    elseif($service_type=="18 Months Warranty")
                    {
                      $output=  $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired under Eerna Protect Extended Warranty plan & delivered. Thank you.") ;

                    } 
                    
                    */
                    $output = $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired & delivered. Thank you.");
                    // dd($output);

                    $log = [
                        'userId' => Auth::user()->id,
                        'description' => $output
                    ];

                    $orderLog = new Logger('handsetdelivery');
                    $orderLog->pushHandler(new StreamHandler(storage_path('logs/sms.log')), Logger::INFO);
                    $orderLog->info('serviceCenter', $log);
                }
            }

            return back()->with('msg', "The phone has successfully been delivered.");
        }
    }

    public function disclaimer_service()
    {
        session()->put('disclaimer', 'accept');
        return redirect()->route('servicepoint.index');
    }

    public function send_early_notification(Request $request)
    {
        if (isset($_POST)) {

            // username, password, sid provided by sslwireless
            $username = env("SMS_USERNAME", null);
            $password = env("SMS_PASSWORD", null);
            $sid = env("SMS_SID", null);

            if ($request->mobile_number != null && $request->imei_number != null) {
                $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                // // You can change the api url if needed. i.e.
                // $SslWirelessSms->setUrl('new_url');
                // $SslWirelessSms->send($request->mobile, 'Thank you for purchase. Your Fscode is: ' . $request->fs_code . '.MRP(including VAT) TK ' . $request->mrp . '');
              
              /*    $service_type=DB::table('sales')
                 ->select('service_type')
                        ->Where('imei', $request->imei_number);  
                $service_type="18 Months Warranty"; 
                if($service_type=="Screen Damage Protection")
                {
                    $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired and is ready for delivery. Please collect your handset from (Service center name). Thank you");
                }
 
                elseif($service_type=="Entended Warranty")
                {
                    $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired and is ready for delivery. Please collect your handset from (Service center name). Thank you") ;
                }
                elseif($service_type=="18 Months Warranty")
                {
                    $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) has been repaired and is ready for delivery. Please collect your handset from (Service center name). Thank you") ;
                } */
                

                $SslWirelessSms->send($request->mobile_number, "Your device (IMEI: $request->imei_number) is ready for delivery. Please collect your handset from (Service center name). Thank you.");
                // dd($output);
            }

            return back()->with('msg', "Notification Sent.");
        }
        return back()->with('msg', "Notification Sent.");
    }

    public function display_sales_image(Request $request)
    {
        $imei = $request->imei;
        $get_image = DB::select('SELECT f.* FROM files f WHERE f.`status`=1 AND f.imei=' . $imei . '');
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
}
