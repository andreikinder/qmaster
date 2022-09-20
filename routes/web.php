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

//
//    $batch = [
//        [
//            new \App\Jobs\PullRepo('project1'),
//            new \App\Jobs\RunTests('project1'),
//            new \App\Jobs\Deploy('project1'),
//        ],
//        [
//            new \App\Jobs\PullRepo('project2'),
//            new \App\Jobs\RunTests('project2'),
//            new \App\Jobs\Deploy('project2'),
//        ]
//
//
//    ];
//
//    Bus::batch($batch)
//        ->allowFailures()
//        ->dispatch();
    //\App\Jobs\SendEmail::dispatch();

    //\App\Jobs\Deploy::dispatch();


    \Illuminate\Support\Facades\DB::transaction(function (){

        $user = \App\Models\User::create(['email' =>  'test@gmai.com']);

        \App\Jobs\SendEmail::dispatch($user)->afterCommit();
    });

    return view('welcome');
});
