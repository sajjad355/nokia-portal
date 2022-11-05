<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ImportExport;

class ImportCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import codes from stored csv files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         //set the path for the csv files
    $path = base_path("resources/pending-files/*.csv"); 
    
    //run 2 loops at a time 
    foreach (array_slice(glob($path),0,2) as $file) {
        
        //read the data into an array
        $data = array_map('str_getcsv', file($file));

        //loop over the data
        foreach($data as $row) {

            //insert the record or update if the email already exists
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

        //delete the file
        unlink($file);
    }
    }
}
