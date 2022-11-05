<?php

namespace App\Http\Controllers\Admin;

use App\Files;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sales;
use App\ServiceHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ImeiChangeController extends Controller
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
        $outlet = DB::table('outlets')
            ->select('outlets.store_name')
            ->where('outlets.id', Auth::user()->store_id)
            ->get();

        $params = [
            'title' => 'IMEI Change',
            'outlet_name' => $outlet
        ];

        return view('admin/imeichange/index')->with($params);
    }
    }

    public function get_details_by_imei(Request $request)
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

        $params = [
            'title' => 'IMEI Change',
            'search_results' => $search_result,
            'days' => $days,
            'outlet_name' => $outlet
        ];

        return view('admin/imeichange/index')->with($params);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $imei_change = Sales::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'new_imei' => 'required|digits:15'
        ]);

        if ($validator->fails()) {
            return redirect()->route('imeichange.index')->with('msg_warning', "The IMEI number must be 15 digits.");
        } else {
            $imei_change->imei = $request->input('new_imei');

            $imei_change->save();
            ServiceHistory::where('imei', $request->input('old_imei'))->update(array('imei' => $request->input('new_imei')));
            Files::where('imei', $request->input('old_imei'))->update(array('imei' => $request->input('new_imei')));

            return redirect()->route('imeichange.index')->with('msg', "The IMEI number $imei_change->imei has successfully been updated.");
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
        //
    }
}
