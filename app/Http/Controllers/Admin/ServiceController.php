<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Service;
use App\PhoneModel;
use App\PhoneBrands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ServiceController extends Controller
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
        $services = Service::all();

        $params = [
            'title' => 'Service List',
            'services' => $services
        ];

        return view('admin/service/list')->with($params);
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
            'title' => 'Add Service',
            'services' => Service::all()
        ];
        return view('admin/service/create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'brand_name' => 'required|unique:phone_brands,brand_name'
        // ]);
        $service=$request->input('service_type');

        $services = Service::create([
            'service_type' => $request->input('service_type')
        ]);

        return redirect()->route('service.index')->with('msg', "The service $service has successfully been added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhoneModel  $phoneModel
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     try {
    //         $phone_brand = DB::table('phone_brands')->select('phone_brands.*', 'users.name')
    //             ->join('users', 'users.id', '=', 'phone_brands.added_by')
    //             ->where('phone_brands.id', $id)
    //             ->get();

    //         $params = [
    //             'title' => 'Brand Details',
    //             'phone_brands' => $phone_brand,
    //         ];

    //         return view('admin.phone_brands.view')->with($params);
    //     } catch (ModelNotFoundException $ex) {
    //         if ($ex instanceof ModelNotFoundException) {
    //             return response()->view('errors.' . '404');
    //         }
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhoneModel  $phoneModel
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     try {
    //         $phone_brand = PhoneBrands::findOrFail($id);

    //         $params = [
    //             'title' => 'Edit Brand',
    //             'phone_brand' => $phone_brand
    //         ];

    //         return view('admin.phone_brands.edit')->with($params);
    //     } catch (ModelNotFoundException $ex) {
    //         if ($ex instanceof ModelNotFoundException) {
    //             return response()->view('errors.' . '404');
    //         }
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhoneModel  $phoneModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $phone_brand = PhoneBrands::findOrFail($id);

            $this->validate($request, [
                'brand_name' => 'required'
            ]);

            $phone_brand->brand_name = $request->input('brand_name');
            $phone_brand->status = $request->input('status');

            $phone_brand->save();

            return redirect()->route('phone_brands.index')->with('msg', "The brand $phone_brand->brand_name has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhoneModel  $phoneModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            return redirect()->route('service.index')->with('msg', "The Service $service->service_type has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
