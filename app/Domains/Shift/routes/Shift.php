<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/shift')->group(function () {
       Route::get('/', function(){
           return 'test';
       });

    Route::controller(\App\Domains\Shift\Http\Controllers\ShiftController::class)->as('shift.')->group(function(){
        Route::post('/assign-shift','assignShift')->name('create');
        Route::put('/update/assigned-shift','updateAssignedShift')->name('update');
        Route::get('/assigned-shifts/filter/{year}/{month}/{date}','getShiftsByDate')->name('shiftsByDate');
        Route::get('/assigned-shifts/worker/{id}','getShiftsByWorker')->name('shiftsByWorker');
    });
});
