<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class Deploy implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('deployments' )
            ->allow(10)
            ->every(60)
            ->block(10)
            ->then(function (){
                info('Started Deploying ...');

                sleep(2);

                info('Finished Deploying');
            });
//        Cache::lock('deployments')->block( 10, function (){
//            info('Started Deploying ...');
//
//            sleep(5);
//
//            info('Finished Deploying');
//            }
//        );

    }
}
