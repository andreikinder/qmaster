<?php

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

//    $chain = [
//        new \App\Jobs\PullRepo(),
//        new \App\Jobs\RunTests(),
//        new \App\Jobs\Deploy()
//    ];
//
//    Bus::chain($chain)->dispatch();

    $batch = [
        new \App\Jobs\PullRepo('project1'),
        new \App\Jobs\PullRepo('project2'),
        new \App\Jobs\PullRepo('project3'),
    ];

    Bus::batch($batch)
        ->allowFailures()
        ->dispatch();
    //\App\Jobs\SendEmail::dispatch();

    return view('welcome');
});
