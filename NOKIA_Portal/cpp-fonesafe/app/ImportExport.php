<?php

namespace App;

use App\Jobs\ProcessCsvUpload;
use Illuminate\Database\Eloquent\Model;

class ImportExport extends Model
{

    protected $guarded = [];
    public function importToDb()
    {
        $path = resource_path('pending-files/*.txt');
        $files = glob($path);

        foreach ($files as $file) {
            $data = array_map('str_getcsv', file($file));

            foreach ($data as $row) {
                ImportExport::updateOrCreate([
                    'SN' => $row[0]
                ], [
                    'Variable_code' => $row[1],
                    'Industry_aggregation_NZSIOC' => $row[2],
                    'Industry_code_NZSIOC'=>$row[3],
                    'Industry_name_NZSIOC'=>$row[4],
                    'Units'=>$row[5],
                    'Year'=>$row[6],
                    'Variable_name'=>$row[7],
                    'Variable_category'=>$row[8],
                    'Value'=>$row[9],
                    'Industry_code_ANZSIC06'=>$row[10]
                ]);
            }
            unlink($file);
        }
    }
}
