<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\ImportExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $import_export = ImportExport::all();

        $params = [
            'title' => 'Uploaded List',
            'import_export' => $import_export
        ];
        return view('admin.importexport.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $params = [
            'title' => 'Import New Codes'
        ];
        return view('admin.importexport.import_excel')->with($params);
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
            'upload_code' => 'required|mimes:csv,txt'
        ]);

        $file = file($request->file('upload_code')->getRealPath());
        $data = array_slice($file, 1);

        $parts = (array_chunk($data, 5000));
        $i = 1;
        foreach ($parts as $part) {
            $filename = resource_path('pending-files/' . date('y-m-d-H-i-s') . $i . '.csv');
            file_put_contents($filename, $part);
            $i++;
        }
        (new ImportExport())->importToDb();
        session()->flash('status', 'queued for importing');

        return redirect()->route('import.index')->with('msg', 'Excel data imported successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImportExport  $importExport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = ImportExport::findOrFail($id);

            $params = [
                'title' => 'View Details',
                'data' => $data,
            ];

            return view('admin.importexport.view')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImportExport  $importExport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = ImportExport::findOrFail($id);

            $params = [
                'title' => 'Edit record',
                'data' => $data,
            ];

            return view('admin.importexport.edit')->with($params);
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
     * @param  \App\ImportExport  $importExport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = ImportExport::findOrFail($id);

            $this->validate($request, [
                'sn' => 'required',
                'column_1' => 'required',
                'column_2' => 'required',
                'column_3' => 'required',
                'column_4' => 'required',
                'column_5' => 'required',
                'column_6' => 'required',
                'column_7' => 'required',
                'column_8' => 'required',
                'column_9' => 'required',
                'column_10' => 'required',
            ]);

            $data->SN = $request->input('sn');
            $data->Variable_code = $request->input('column_1');
            $data->Industry_aggregation_NZSIOC = $request->input('column_2');
            $data->Industry_code_NZSIOC = $request->input('column_3');
            $data->Industry_name_NZSIOC = $request->input('column_4');
            $data->Units = $request->input('column_5');
            $data->Year = $request->input('column_6');
            $data->Variable_name = $request->input('column_7');
            $data->Variable_category = $request->input('column_8');
            $data->Value = $request->input('column_9');
            $data->Industry_code_ANZSIC06 = $request->input('column_10');

            $data->save();

            return redirect()->route('import.index')->with('msg', "The record $data->Variable_code has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImportExport  $importExport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = ImportExport::findOrFail($id);

            $data->delete();

            return redirect()->route('import.index')->with('msg', "The record $data->Variable_code has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy_all(Request $request)
    {
        try {
            ImportExport::truncate();

            return redirect()->route('import.index')->with('msg', "All records has successfully been deleted.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
