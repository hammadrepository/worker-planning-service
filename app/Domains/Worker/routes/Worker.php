<?php

use Illuminate\Support\Facades\Route;

Route::prefix('worker')->group(function () {
       Route::get('/', function(){
           return 'test';
       });

       Route::controller(\App\Domains\Worker\Http\Controllers\WorkerController::class)->as('worker.')->group(function(){
           Route::post('/create','store')->name('create');
       });
});
