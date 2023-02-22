<?php

declare(strict_types=1);


use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\RegionController;
use Illuminate\Support\Facades\Route;

Route::get('/regions', [RegionController::class, 'index']);
Route::get('/search', [HospitalController::class, 'search']);
Route::get('/hospital/{id}', [HospitalController::class, 'one'])->where([
    'id' => '[\d]+',
]);
