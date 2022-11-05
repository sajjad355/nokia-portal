<?php

namespace App\Jobs;

use App\ImportExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dump('Processing this file:------', $this->file);

        Redis::throttle('upload-csv')->allow(1)->every(20)->then(function(){

            $data = array_map('str_getcsv', file($this->file));

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
            //dump('Done with this file:------', $this->file);
            unlink($this->file);
        }, function(){
            return $this->release(10);
        });
        
    }
}
