<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filename = 'sample.txt';
        return response()->download(storage_path("app/public/{$filename}"));

    }

    public function imei_sample()
    {
        $filename = 'sample_IMEI.txt';
        return response()->download(storage_path("app/public/{$filename}"));

    }

    public function bulk_user_creation_sample()
    {
        $filename = 'sample_bulk_user_creation.txt';
        return response()->download(storage_path("app/public/{$filename}"));

    }

    public function bongoTvCodesSample()
    {
        $filename = 'bongo_tv_codes_sample.txt';
        return response()->download(storage_path("app/public/{$filename}"));

    }

    public function fsecureSample()
    {
        $filename = 'fsecure_codes_sample.txt';
        return response()->download(storage_path("app/public/{$filename}"));

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
        //
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
