<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TierController extends Controller
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
        $tiers = DB::table('tiers')->select('tiers.*', 'users.name')->join('users', 'users.id', '=', 'tiers.added_by')->get();

        $params = [
            'title' => 'Tier List',
            'tiers' => $tiers
        ];

        return view('admin/tiers/tiers_list')->with($params);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $params = [
            'title' => 'Create Tier'
        ];

        return view('admin/tiers/tiers_create')->with($params);
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
            'tier' => 'required|unique:tiers,tier',
            'price_range_start' => 'required',
            'price_range_end' => 'required',
            // 'service_type' => 'required',
            // 'mrp' => 'required',
            // 'commission' => 'required'
        ]);

        $tier = Tier::create([
            'tier' => $request->input('tier'),
            'price_range_start' => $request->input('price_range_start'),
            'price_range_end' => $request->input('price_range_end'),
            // 'service_type' => $request->input('service_type'),
            // 'mrp' => $request->input('mrp'),
            // 'commission' => $request->input('commission'),
            'status' => 1,
            'added_by' => Auth::user()->id
        ]);

        return redirect()->route('tiers.index')->with('msg', "The tier $tier->tier has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tiers = DB::table('tiers')->select('tiers.*', 'users.name')
                ->join('users', 'users.id', '=', 'tiers.added_by')
                ->where('tiers.id', $id)
                ->get();

            $params = [
                'title' => 'Tier Details',
                'tier' => $tiers,
            ];

            return view('admin.tiers.tiers_view')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tiers = Tier::findOrFail($id);

            $params = [
                'title' => 'Edit Tier',
                'tier' => $tiers,
            ];

            return view('admin.tiers.tiers_edit')->with($params);
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
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tiers = Tier::findOrFail($id);

            $this->validate($request, [
                'tier' => 'required',
                'price_range_start' => 'required',
                'price_range_end' => 'required',
                // 'service_type' => 'required',
                // 'mrp' => 'required',
                // 'commission' => 'required'
            ]);

            $tiers->tier = $request->input('tier');
            $tiers->price_range_start = $request->input('price_range_start');
            $tiers->price_range_end = $request->input('price_range_end');
            // $tiers->service_type = $request->input('service_type');
            // $tiers->mrp = $request->input('mrp');
            // $tiers->commission = $request->input('commission');
            $tiers->status = $request->input('status');

            $tiers->save();

            return redirect()->route('tiers.index')->with('msg', "The tier $tiers->tier has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tier = Tier::findOrFail($id);

            $tier->delete();

            return redirect()->route('tiers.index')->with('msg', "The tier $tier->tier has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
